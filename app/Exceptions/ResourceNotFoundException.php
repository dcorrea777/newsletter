<?php

namespace App\Exceptions;

use Throwable;

class ResourceNotFoundException extends ApplicationException
{
    public function __construct(string $message, int $code = 400, Throwable $previous= null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function create(string $string, int $code = 400): self
    {
        return new self($string, $code);
    }
}
