<?php

namespace App\Notifications\Student;

use MailVariable;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;
use URL;

class ConfirmEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param $notifiable
     * @return MailMessage
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('VietSeeds - Xác thực thông tin ứng tuyển')
            ->from('seeds.recruitment@vietseeds.org')->replyTo('noreply@vietseeds.org')
            ->view('student.emails.confirm', [
                'link' => URL::signedRoute('student.confirm', ['email' => $notifiable->email]),
            ]);
    }
}
