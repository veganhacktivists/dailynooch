<?php

namespace App\Console\Commands\Widget;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;

class WidgetMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:widget {name : The name of the widget}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new widget';

    /**
     * Create a new widget command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param \App\Console\Commands\Widget\WidgetCreator $creator
     *
     * @return mixed
     */
    public function handle(WidgetCreator $creator, Composer $composer)
    {
        $widgetName = trim($this->argument('name'));
        $fileEventMessages = $creator->create($widgetName);

        foreach ($fileEventMessages as $fileEventMessage) {
            $this->line($fileEventMessage);
        }

        $composer->dumpAutoloads();
    }
}
