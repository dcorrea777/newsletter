<?php

namespace App\Http\Controllers;

use App\Usecase\SubscribeNewsletter\InputModel;
use App\Usecase\SubscribeNewsletter\SubscribeNewsletterCommand;
use Illuminate\Http\Request;

class CreateSubscriptionController extends Controller
{
    private SubscribeNewsletterCommand $usecase;

    public function __construct(SubscribeNewsletterCommand $usecase)
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
