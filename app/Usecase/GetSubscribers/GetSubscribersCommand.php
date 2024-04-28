<?php

declare(strict_types=1);

namespace App\Usecase\GetSubscribers;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Newsletter;
use App\Models\Subscription;
use App\Usecase\CommandInterface;
use App\Usecase\InputModelInterface;
use App\Usecase\ViewModelInterface;

class GetSubscribersCommand implements CommandInterface
{
    public function handler(InputModelInterface $input): ViewModelInterface
    {
        $newsletter = Newsletter::find($input->newsletterId);

        if ($newsletter === null) {
            throw ResourceNotFoundException::create('Newsletter not found');
        }

        $subscription = Subscription::where('newsletter_id', '=', $newsletter->id)->get();

        return ViewModel::create($subscription->toArray());
    }
}
