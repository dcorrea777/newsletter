<?php

declare(strict_types=1);

namespace App\Usecase\CreateUser;

use App\Models\User;
use App\Usecase\CommandInterface;
use App\Usecase\InputModelInterface;
use App\Usecase\ViewModelInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUserCommand implements CommandInterface
{
    public function handler(InputModelInterface $input): ViewModelInterface
    {
        $myPassword = Hash::make(Str::password(16, true, true, false, false));

        //@todo Apenas usuário admin deve poder criar um usuário

        User::create([
            'name'      => $input->name,
            'email'     => $input->email,
            'password'  => $myPassword,
        ]);

        return ViewModel::fromArray([
            'name'      => $input->name,
            'email'     => $input->email,
            'is_admin'  => $input->isAdmin
        ]);
    }
}
