<?php

namespace App\Http\Controllers;

use App\Usecase\GetMessages\GetMessagesCommand;
use App\Usecase\GetMessages\InputModel;
use Illuminate\Http\Request;

class GetMessagesController extends Controller
{
    private GetMessagesCommand $usecase;

    public function __construct(GetMessagesCommand $usecase)
    {
        $this->usecase = $usecase;
    }

    public function __invoke(Request $request, string $id)
    {
        $input = InputModel::create($id);

        $view = $this->usecase->handler($input);

        return response()->json($view, 200);
    }
}
