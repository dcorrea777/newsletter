<?php

declare(strict_types=1);

namespace App\Usecase\CreateNewsletter;

use App\Usecase\ViewModelInterface;

class ViewModel implements ViewModelInterface
{
    public $name;

    public $topic_id;

    public $description;

    public function __construct($name, $topic_id, $description)
    {
        $this->name         = $name;
        $this->topic_id     = $topic_id;
        $this->description  = $description;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['topic_id'],
            $data['description'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'data' => [
                'name'          => $this->name,
                'description'   => $this->description,
                'topic_id'      => $this->topic_id,
            ],
        ];
    }

}
