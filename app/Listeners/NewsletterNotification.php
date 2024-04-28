<?php

namespace App\Listeners;

use App\Events\CreateNewsletter;
use App\Mail\Newsletter as NewsletterMail;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewsletterNotification
{
    private Mailer $mailer;

    /**
     * Create the event listener.
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     */
    public function handle(CreateNewsletter $event): void
    {
        $newsletter = $event->newsletter;
        $subscriptions = $newsletter->subscribers()->get();

        foreach ($subscriptions as $subscription) {
            $this->mailer->to($subscription->email)->send(new NewsletterMail($newsletter));
        }
    }
}
