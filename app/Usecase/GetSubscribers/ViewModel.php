<?php

declare(strict_types=1);

namespace App\Usecase\GetSubscribers;

use App\Usecase\ViewModelInterface;

class ViewModel implements ViewModelInterface
{
    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public static function create(array $data): self
    {
        return new self($data);
    }

    public function jsonSerialize(): mixed
    {
        return ['data' => $this->data];
    }
}
