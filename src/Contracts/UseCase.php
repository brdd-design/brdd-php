<?php

declare(strict_types=1);

namespace Brdd\Contracts;

use Brdd\Contexts\ExecutionContext;

/**
 * The orchestrator interface.
 * A UseCase coordinates services but does not execute business logic directly.
 * 
 * @template I Input DTO Type
 * @template O Output/Result DTO Type
 */
interface UseCase
{
    /**
     * Executes the orchestration logic.
     *
     * @param I $inputData The raw request payload or internal DTO.
     * @return ExecutionContext<O> The resulting execution context containing data, errors, setters, and effects.
     */
    public function execute($inputData): ExecutionContext;
}
