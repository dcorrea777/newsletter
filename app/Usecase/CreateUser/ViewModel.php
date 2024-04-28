<?php

declare(strict_types=1);

namespace App\Usecase\CreateUser;

use App\Usecase\ViewModelInterface;

class ViewModel implements ViewModelInterface
{
    public readonly string $name;

    public readonly string $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['email'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name'  => $this->name,
            'email' => $this->email,
        ];
    }
}
