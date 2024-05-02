<?php

declare(strict_types=1);

namespace App\Usecase\CreateNewsletter;

use App\Exceptions\AccessDeniedException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Newsletter;
use App\Models\Topic;
use App\Usecase\CommandInterface;
use App\Usecase\InputModelInterface;
use App\Usecase\ViewModelInterface;
use Illuminate\Support\Facades\Auth;

class CreateNewletterCommand implements CommandInterface
{
    /**
     * @param InputModel $input
     * @return ViewModel
     */
    public function handler(InputModelInterface $input): ViewModelInterface
    {
        if (!Auth::user()->is_admin) {
            throw AccessDeniedException::create();
        }

        $topic = Topic::find($input->topic_id);

        if ($topic === null) {
            throw ResourceNotFoundException::create('Topic not found');
        }

        $newsletter = Newsletter::create($input->toArray());

        return ViewModel::fromArray([
            'name'          => $newsletter->name,
            'description'   => $newsletter->description,
            'topic_id'      => $newsletter->topic_id,
        ]);
    }
}
