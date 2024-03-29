<?php

namespace App\Models;

use App\User;
use Backpack\CRUD\app\Models\Traits\InheritsRelationsFromParentModel;
use Backpack\CRUD\app\Notifications\ResetPasswordNotification;

class BackpackUser extends User
{
    use InheritsRelationsFromParentModel;

    protected $table = 'users';

    /**
     * @var string
     */
    private $email;

    /**
     * Send the password reset notification.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Get the e-mail address where password reset links are sent.
     */
    public function getEmailForPasswordReset(): string
    {
        return $this->email;
    }
}
