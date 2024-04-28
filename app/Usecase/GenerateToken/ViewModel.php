<?php

declare(strict_types=1);

namespace App\Usecase\GenerateToken;

use App\Usecase\ViewModelInterface;

class ViewModel implements ViewModelInterface
{
    public readonly string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public static function fromArray(array $data): self
    {
        return new self((string)$data['token']);
    }

    public function jsonSerialize(): mixed
    {
        return ['token' => $this->token];
    }
}
