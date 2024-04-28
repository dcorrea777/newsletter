<?php

declare(strict_types=1);

namespace App\Usecase\CreateNewsletter;

use App\Usecase\InputModelInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InputModel implements InputModelInterface
{
    public $name;

    public $topic_id;

    public $description;

    public function __construct($name = null, $description = null, $topic_id = null)
    {
        $this->name         = $name;
        $this->description  = $description;
        $this->topic_id     = $topic_id;

        $this->throwAnExceptionWhenItFails();
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name', null),
            $request->input('description', null),
            $request->input('topic_id', null),
        );
    }
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'topic_id' => $this->topic_id,
            'description' => $this->description,
        ];
    }

    public function throwAnExceptionWhenItFails(): void
    {
        $data = ['name' => $this->name, 'topic_id' => $this->topic_id];

        $rules = ['name' => ['required'], 'topic_id' => ['required']];

        if (Validator::make($data, $rules)->fails()) {
            throw new Exception('Validation Error');
        }
    }
}
