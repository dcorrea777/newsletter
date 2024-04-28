<?php

declare(strict_types=1);

namespace App\Usecase;

interface InputModelInterface
{
    public function throwAnExceptionWhenItFails(): void;

    public function toArray(): array;
}
