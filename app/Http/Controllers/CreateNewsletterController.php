<?php

namespace App\Http\Controllers;

use App\Usecase\CreateNewsletter\CreateNewletterCommand;
use App\Usecase\CreateNewsletter\InputModel;
use Illuminate\Http\Request;

class CreateNewsletterController extends Controller
{
    private CreateNewletterCommand $usecase;

    public function __construct(CreateNewletterCommand $usecase)
    {
        $this->usecase = $usecase;
    }

    public function __invoke(Request $request)
    {
        $input = InputModel::fromRequest($request);

        $view = $this->usecase->handler($input);

        return response()->json($view, 201);
    }
}
