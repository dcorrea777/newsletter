<?php

declare(strict_types=1);

namespace App\Usecase\GenerateToken;

use App\Exceptions\AuthException;
use App\Usecase\CommandInterface;
use App\Usecase\InputModelInterface;
use App\Usecase\ViewModelInterface;
use Illuminate\Support\Facades\Auth;

class GenerateTokenCommand implements CommandInterface
{
    /**
     * @param InputModel $input
     * @return ViewModel
     */
    public function handler(InputModelInterface $input): ViewModelInterface
    {
        $data = ['email' => $input->email, 'password' => $input->password];

        if (! Auth::attempt($data)) {
            throw AuthException::invalidUsernameAndPassword();
        }

        $user = Auth::user();
        $token = $user->createToken('MyApp');

        return ViewModel::fromArray(['token' => $token->plainTextToken]);
    }
}
