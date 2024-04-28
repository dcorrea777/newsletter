<?php

declare(strict_types=1);

namespace App\Usecase\CreateUser;

use App\Usecase\InputModelInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InputModel implements InputModelInterface
{
    public readonly ?string $name;

    public readonly ?string $email;

    public readonly ?string $isAdmin;

    public function __construct($name = null, $email = null, $isAdmin = null) 
    {
        $this->name     = $name;
        $this->email    = $email;
        $this->isAdmin  = $isAdmin;

        $this->throwAnExceptionWhenItFails();
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->input('email'),
            $request->input('is_admin'),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    public function throwAnExceptionWhenItFails(): void
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email'],
        ];

        if (Validator::make($data, $rules)->fails()) {
            throw new Exception('Validation Error');
        }
    }
}
