<?php

declare(strict_types=1);

namespace App\Usecase\CreateMessage;

use App\Usecase\InputModelInterface;
use Illuminate\Http\Request;

class InputModel implements InputModelInterface
{
    public $subject;

    public $content;

    public $newsletterId;

    public function __construct($subject = null, $content = null, $newsletterId = null)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->newsletterId = $newsletterId;

        $this->throwAnExceptionWhenItFails();
    }

    public static function fromRequest(Request $request, string $id): self
    {
        return new self(
            $request->input('subject'),
            $request->input('content'),
            $id,
        );
    }

    public function toArray(): array
    {
        return [
            'subject' => $this->subject,
            'content' => $this->content,
            'newsletter_id' => $this->newsletterId
        ];
    }

    public function throwAnExceptionWhenItFails(): void
    {
        //
    }
}
