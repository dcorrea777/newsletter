<?php

declare(strict_types=1);

namespace App\Usecase\CreateMessage;

use App\Events\CreateNewsletter;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Message;
use App\Models\Newsletter;
use App\Usecase\CommandInterface;
use App\Usecase\InputModelInterface;
use App\Usecase\ViewModelInterface;

class CreateMessageCommand implements CommandInterface
{
    public function handler(InputModelInterface $input): ViewModelInterface
    {
        $newsletter = Newsletter::find($input->newsletterId);

        if ($newsletter === null) {
            throw ResourceNotFoundException::create('Newsletter not found');
        }

        $message = Message::create($input->toArray());

        event(new CreateNewsletter($newsletter));

        return ViewModel::create([
            'id'            => $message->id,
            'subject'       => $message->subject,
            'content'       => $message->content,
            'newsletter_id' => $message->newsletter_id,
        ]);
    }
}
