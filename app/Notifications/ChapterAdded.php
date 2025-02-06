<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ChapterAdded extends Notification
{
    use Queueable;
    public $chapter;
    public function __construct($chapter)
    {
        $this->chapter = $chapter;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase(object $notifiable): array
{
    return [
        'message' => 'A new chapter has been added to a story!',
        'url' => route('stories.show', ['story' => $this->chapter->story_id]),
     ];
}

public function toBroadcast(object $notifiable): BroadcastMessage
{
    return new BroadcastMessage([
        'message' => 'A new chapter has been added to a story!',
        'action_url' => route('stories.show', ['story' => $this->chapter->story_id]),
    ]);
}
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
   {
    return [
        'message' => 'You have a new chapter update!',
        'story_id' => $this->story->id,
        'chapter_id' => $this->chapter->id,
        'url' => route('chapters.show', [$this->story->id, $this->chapter->id]),
    ];
}
}
