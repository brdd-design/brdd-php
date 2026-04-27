<?php

declare(strict_types=1);

namespace Brdd\Contexts;

/**
 * Encapsulates validation results and errors.
 */
class ValidationContext
{
    /** @var BRDDError[] */
    private array $errors = [];

    /**
     * Factory method to build a new context.
     */
    public static function build(): self
    {
        return new self();
    }

    /**
     * Adds an error to the context.
     *
     * @param string $code
     * @param string $message
     * @return void
     */
    public function addError(string $code, string $message): void
    {
        $this->errors[] = new BRDDError($code, $message);
    }

    /**
     * Checks if there are any validation errors.
     *
     * @return bool
     */
    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    /**
     * Returns the list of errors.
     *
     * @return BRDDError[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
