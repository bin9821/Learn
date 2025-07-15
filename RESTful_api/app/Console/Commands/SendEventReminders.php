<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Notifications\EventReminderNotification;
use Illuminate\Console\Command;
use Str;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 
        '找今天到明天所有跟事件有關的參與者有幾個並且寄信去通知每個參與者'; 
        //try using a Chinese description 

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $event = Event::with('attendees.user')
            ->whereBetween('start_time', [now(), now()->addDay()])
            ->get();
        $eventCount = $event->count();
        $eventLabel = Str::plural('event', $eventCount);
        
        $event->each(
            fn($event) => $event->attendees->each(
                fn($attendee) => $attendee->user->notify(
                    new EventReminderNotification($event)
                )
            )
        );
        $this->info("Found {$eventCount} {$eventLabel}");
    }
}
