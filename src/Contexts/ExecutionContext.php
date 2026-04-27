<?php

declare(strict_types=1);

namespace Brdd\Contexts;

/**
 * The central state object returned by UseCases.
 * Encapsulates the ValidationContext, setters, effects, and resulting data.
 * 
 * @template T Return Data Type
 */
class ExecutionContext
{
    public const PRE_EFFECT = 'PRE';
    public const POST_EFFECT = 'POST';

    private ValidationContext $validationContext;
    private string $useCaseCode;
    
    /** @var array<string, mixed> */
    private array $setters = [];
    
    /** @var array<array{type: string, code: string, callable: callable}> */
    private array $effects = [];
    
    /** @var T|null */
    private mixed $data = null;

    private function __construct(string $useCaseCode, ValidationContext $validationContext)
    {
        $this->useCaseCode = $useCaseCode;
        $this->validationContext = $validationContext;
    }

    /**
     * Factory method to build the ExecutionContext.
     *
     * @param string $useCaseCode
     * @param ValidationContext $validationContext
     * @return self
     */
    public static function build(string $useCaseCode, ValidationContext $validationContext): self
    {
        return new self($useCaseCode, $validationContext);
    }

    /**
     * Registers a side effect to be executed by the framework/middleware.
     *
     * @param string $type self::PRE_EFFECT or self::POST_EFFECT
     * @param string $code Unique code for the effect
     * @param callable $callable The closure or callable to execute
     * @return void
     */
    public function addEffect(string $type, string $code, callable $callable): void
    {
        $this->effects[] = [
            'type' => $type,
            'code' => $code,
            'callable' => $callable,
        ];
    }

    /**
     * Records a state mutation (Setter) for auditing and narrative purposes.
     *
     * @param string $code
     * @param mixed $value
     * @return void
     */
    public function addSetter(string $code, mixed $value): void
    {
        $this->setters[$code] = $value;
    }

    /**
     * Sets the resulting domain data payload.
     *
     * @param T $data
     * @return void
     */
    public function setData(mixed $data): void
    {
        $this->data = $data;
    }

    /**
     * Retrieves the data payload.
     *
     * @return T|null
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    public function getValidationContext(): ValidationContext
    {
        return $this->validationContext;
    }

    public function getUseCaseCode(): string
    {
        return $this->useCaseCode;
    }

    /**
     * Returns the registered setters.
     *
     * @return array<string, mixed>
     */
    public function getSetters(): array
    {
        return $this->setters;
    }

    /**
     * Returns the registered effects.
     *
     * @return array<array{type: string, code: string, callable: callable}>
     */
    public function getEffects(): array
    {
        return $this->effects;
    }

    /**
     * Quick helper to check if execution has validation errors.
     *
     * @return bool
     */
    public function hasErrors(): bool
    {
        return $this->validationContext->hasErrors();
    }
}
