<?php

declare(strict_types=1);

namespace App\Usecase\SubscribeNewsletter;

use App\Usecase\InputModelInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InputModel implements InputModelInterface
{
    public $email;

    public $newsletterId;

    public function __construct($email = null, $newsletterId = null)
    {
        $this->email         = $email;
        $this->newsletterId  = $newsletterId;

        $this->throwAnExceptionWhenItFails();
    }

    public static function fromRequest(Request $request, string $id): self
    {
        return new self(
            $request->input('email', null),
            $id,
        );
    }
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'newsletter_id' => $this->newsletterId,
        ];
    }

    public function throwAnExceptionWhenItFails(): void
    {
        $data   = ['email' => $this->email, 'newsletter_id' => $this->newsletterId];
        $rules  = ['email' => ['required', 'email'], 'newsletter_id' => ['required']];

        if (Validator::make($data, $rules)->fails()) {
            throw new Exception('Validation Error');
        }
    }
}
