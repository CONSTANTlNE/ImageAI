<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Throwable;

class ErrorOccurred extends Notification
{
    use Queueable;

    protected $message;
    protected $file;
    protected $line;
    protected $code;
    protected $trace;

    /**
     * Create a new notification instance.
     */
    public function __construct(Throwable $exception)
    {
        $this->message = $exception->getMessage();
        $this->file = $exception->getFile();
        $this->line = $exception->getLine();
        $this->code = $exception->getCode();
        $this->trace = $exception->getTraceAsString();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Error Notification')
            ->line('An error occurred in IMAGE-AI:')
            ->line('Message: ' . $this->message)
            ->line('File: ' . $this->file)
            ->line('Line: ' . $this->line)
            ->line('Code: ' . $this->code)
            ->line('Stack Trace:')
            ->line($this->trace);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
