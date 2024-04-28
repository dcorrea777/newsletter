<?php

namespace App\Http\Controllers;

use App\Usecase\GenerateToken\GenerateTokenCommand;
use App\Usecase\GenerateToken\InputModel;
use Illuminate\Http\Request;

class GenerateTokenController extends Controller
{
    private GenerateTokenCommand $usecase;

    public function __construct(GenerateTokenCommand $usecase)
    {
        $this->usecase = $usecase;
    }

    public function __invoke(Request $request)
    {
        $input = InputModel::fromRequest($request);

        $view = $this->usecase->handler($input);

        return response()->json($view, 200);
    }
}
