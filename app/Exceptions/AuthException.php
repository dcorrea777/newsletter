<?php

namespace App\Exceptions;

use Throwable;

class AuthException extends ApplicationException
{
    public function __construct(string $message, int $code = 400, Throwable $previous= null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function invalidUsernameAndPassword(): self
    {
        return new self('Invalid username and password', 400);
    }
}
