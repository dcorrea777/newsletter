<?php

namespace App\Http\Controllers;

use App\Usecase\CreateUser\CreateUserCommand;
use App\Usecase\CreateUser\InputModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateUserController extends Controller
{
    private CreateUserCommand $usecase;

    public function __construct(CreateUserCommand $usecase)
    {
        $this->usecase = $usecase;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $input = InputModel::fromRequest($request);

        $view = $this->usecase->handler($input);

        return response()->json($view, 201);
    }
}
