<?php

declare(strict_types=1);

namespace App\Usecase\CreateMessage;

use App\Usecase\ViewModelInterface;

class ViewModel implements ViewModelInterface
{
    public $id;

    public $subject;

    public $content;

    public $newsletterId;

    public function __construct($id, $subject, $content, $newsletterId)
    {
        $this->id = $id;
        $this->subject = $subject;
        $this->content = $content;
        $this->newsletterId = $newsletterId;
    }

    public static function create(array $data): self
    {
        return new self(
            $data['id'],
            $data['subject'],
            $data['content'],
            $data['newsletter_id'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'data' => [
                'id'            => $this->id,
                'subject'       => $this->subject,
                'content'       => $this->content,
                'newsletter_id' => $this->newsletterId,
            ],
        ];
    }
}
