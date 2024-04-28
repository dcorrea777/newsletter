<?php

declare(strict_types=1);

namespace App\Usecase\GetMessages;

use App\Usecase\InputModelInterface;

class InputModel implements InputModelInterface
{
    public $newsletterId;

    public function __construct($newsletterId = null)
    {
        $this->newsletterId = $newsletterId;

        $this->throwAnExceptionWhenItFails();
    }

    public static function create(string $id): self
    {
        return new self($id);
    }

    public function toArray(): array
    {
        return ['newsletter_id' => $this->newsletterId];
    }

    public function throwAnExceptionWhenItFails(): void
    {
        //
    }
}
