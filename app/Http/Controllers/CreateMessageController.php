<?php

namespace App\Http\Controllers;

use App\Usecase\CreateMessage\CreateMessageCommand;
use App\Usecase\CreateMessage\InputModel;
use Illuminate\Http\Request;

class CreateMessageController extends Controller
{
    private CreateMessageCommand $usecase;

    public function __construct(CreateMessageCommand $usecase)
    {
        $this->usecase = $usecase;
    }

    public function __invoke(Request $request, string $id)
    {
        $input = InputModel::fromRequest($request, $id);

        $view = $this->usecase->handler($input);

        return response()->json($view, 201);
    }
}
