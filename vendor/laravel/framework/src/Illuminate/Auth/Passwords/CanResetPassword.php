<?php

namespace Illuminate\Auth\Passwords;
use App\Notifications\ForgotPasswordNotification;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

trait CanResetPassword
{
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {

        if(config('auth.use_custom_template')=='on')
        {
            $this->notify(new ForgotPasswordNotification($token));
        }
        else
        {
            $this->notify(new ResetPasswordNotification($token));
        }
    }
}
