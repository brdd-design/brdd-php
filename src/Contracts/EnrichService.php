<?php

declare(strict_types=1);

namespace Brdd\Contracts;

/**
 * Protocol for services that query and aggregate additional data needed for the UseCase.
 * EnrichServices MUST NOT contain business logic or validations.
 * 
 * @template I Input DTO Type
 * @template E Enriched Data Output Type
 */
interface EnrichService
{
    /**
     * Enriches the input data by fetching dependencies.
     *
     * @param I $inputData
     * @return E
     */
    public function enrich($inputData);
}
