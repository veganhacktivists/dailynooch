<?php

namespace App\Console\Commands;

use App\Models\BackpackUser;
use App\Models\FeedSource;
use App\Models\Quote;
use App\Role;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SeedProduction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed:prod';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the production database with records';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->seedRoles();
        $this->seedFirstUser();
        $this->seedCustomData();
    }

    private function seedRoles()
    {
        /*
         * Feel free to add your own additional roles, but
         * DO NOT change/remove the admin role. It is
         * required for the admin panel to work.
         */
        $roles = [
            [
                'id' => 1,
                'name' => 'admin',
                'guard_name' => 'backpack',
            ],
        ];

        $this->info('Creating roles:');

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['id' => $role['id']],
                $role
            );

            $this->line("* `{$role['name']}` role created");
        }
    }

    private function seedFirstUser()
    {
        $this->info('Creating the initial admin user!');

        $name = $this->ask('Name', 'Admin User');

        $defaultEmail = 'admin@'.preg_replace('/https?:\/\//', '', config('app.url'));
        do {
            $email = $this->ask('Email', $defaultEmail);
        } while (!filter_var($email, FILTER_VALIDATE_EMAIL));

        do {
            $password = $this->secret('Password');
        } while (!$password);

        $user = [
            'id' => 1,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ];

        try {
            DB::transaction(function () use ($user) {
                $user = BackpackUser::updateOrCreate(
                    ['id' => $user['id']],
                    $user
                );

                if (!isset($user->email_verified_at)) {
                    $user->email_verified_at = time();
                    $user->save();
                }

                $user->assignRole('admin');
            });

            $this->info('User successfully created');
        } catch (QueryException $e) {
            $this->error($e->getMessage());
            $this->seedFirstUser();
        }
    }

    private function seedCustomData()
    {
        $this->seedQuotes();
        $this->info('Quotes successfully created');
        $this->seedFeedSources();
        $this->info('Feed Sources successfully created');
    }

    private function seedQuotes()
    {
        if (Quote::count() > 0) {
            return;
        }

        $quotesJson = File::get('database/data/quotes.json');
        $quotes = json_decode($quotesJson);
        $newQuotes = [];
        foreach ($quotes as $quote) {
            $newQuote = [
                'author' => $quote->Author,
                'text' => $quote->Text,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            array_push($newQuotes, $newQuote);
        }
        Quote::insert($newQuotes);
    }

    private function seedFeedSources()
    {
        if (FeedSource::count() > 0) {
            return;
        }

        $feedSourcesJson = File::get('database/data/feed-sources.json');
        $feedSources = collect(json_decode($feedSourcesJson, true));
        $newFeedSources = $feedSources->map(function ($feedSource) {
            $feedSource['created_at'] = $feedSource['updated_at'] = now();

            return $feedSource;
        });

        FeedSource::insert($newFeedSources->toArray());
    }
}
