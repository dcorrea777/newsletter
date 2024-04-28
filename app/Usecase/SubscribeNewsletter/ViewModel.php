<?php

declare(strict_types=1);

namespace App\Usecase\SubscribeNewsletter;

use App\Usecase\ViewModelInterface;

class ViewModel implements ViewModelInterface
{
    public $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['email']);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'data' => ['email' => $this->email],
        ];
    }

}
