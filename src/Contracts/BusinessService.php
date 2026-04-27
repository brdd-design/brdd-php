<?php

declare(strict_types=1);

namespace Brdd\Contracts;

/**
 * Protocol for services executing pure core business operations and state mutations.
 * 
 * @template E Enriched Data Input Type
 * @template R Business Result Type
 */
interface BusinessService
{
    /**
     * Executes the main business logic and returns a result.
     *
     * @param E $contextData
     * @return R
     */
    public function execute($contextData);
}
