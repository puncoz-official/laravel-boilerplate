<?php

namespace App\Core\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class VerifyEmail
 * @package App\Core\Notifications\Auth
 */
class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure $callback
     *
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed $notifiable
     *
     * @return array|string
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ( static::$toMailCallback ) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        $message = new MailMessage();
        $message->subject('Verify Email Address');
        $message->line('Please click the button below to verify your email address.');
        $message->action('Verify Email Address', $this->verificationUrl($notifiable));
        $message->line('If you did not create an account, no further action is required.');

        return $message;
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed $notifiable
     *
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return signed_route('auth.verification.verify', time_now()->addMinute(60), ['id' => $notifiable->getKey()]);
    }
}
