<?php

declare(strict_types=1);

namespace App\Usecase\GenerateToken;

use App\Usecase\InputModelInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InputModel implements InputModelInterface
{
    public readonly ?string $email;

    public ?string $password;

    public function __construct($email = null, $password = null) 
    {
        $this->email    = $email;
        $this->password = $password;

        $this->throwAnExceptionWhenItFails();
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('email'),
            $request->input('password'),
        );
    }

    public function toArray(): array
    {
        return ['email' => $this->email];
    }

    public function throwAnExceptionWhenItFails(): void
    {
        $data = [
            'email'     => $this->email,
            'password'  => $this->password,
        ];

        $rules = [
            'password'  => ['required'],
            'email'     => ['required', 'email'],
        ];

        if (Validator::make($data, $rules)->fails()) {
            throw new Exception('Validation Error');
        }
    }
}
