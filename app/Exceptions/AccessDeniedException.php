<?php

namespace App\Exceptions;

use Throwable;

class AccessDeniedException extends ApplicationException
{
    public function __construct(string $message, int $code = 403, Throwable $previous= null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function create(): self
    {
        return new self('Access denied', 403);
    }
}
