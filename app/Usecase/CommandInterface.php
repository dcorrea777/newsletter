<?php

declare(strict_types=1);

namespace App\Usecase;

use App\Usecase\InputModelInterface;
use App\Usecase\ViewModelInterface;

interface CommandInterface
{
    /**
     * @param InputModelInterface $input
     * @return ViewModelInterface
     */
    public function handler(InputModelInterface $input): ViewModelInterface;
}
