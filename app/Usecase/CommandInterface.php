<?php

declare(strict_types=1);

namespace App\Usecase;

use App\Usecase\InputModelInterface;
use App\Usecase\ViewModelInterface;

interface CommandInterface
{
    public function handler(InputModelInterface $input): ViewModelInterface;
}
