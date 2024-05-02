<?php

declare(strict_types=1);

namespace App\Usecase\SubscribeNewsletter;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Newsletter;
use App\Models\Subscription;
use App\Usecase\CommandInterface;
use App\Usecase\InputModelInterface;
use App\Usecase\ViewModelInterface;

class SubscribeNewsletterCommand implements CommandInterface
{
    /**
     * @param InputModel $input
     * @return ViewModel
     */
    public function handler(InputModelInterface $input): ViewModelInterface
    {
        $newsletter = Newsletter::find($input->newsletterId);

        if ($newsletter === null) {
            throw ResourceNotFoundException::create('Newsletter not found');
        }

        $subscription = Subscription::create($input->toArray());

        return ViewModel::fromArray(['email' => $subscription->email]);
    }
}
