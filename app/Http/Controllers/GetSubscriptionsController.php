<?php

namespace App\Http\Controllers;

use App\Usecase\GetSubscribers\GetSubscribersCommand;
use App\Usecase\GetSubscribers\InputModel;
use Illuminate\Http\Request;

class GetSubscriptionsController extends Controller
{
    private GetSubscribersCommand $usecase;

    public function __construct(GetSubscribersCommand $usecase)
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
