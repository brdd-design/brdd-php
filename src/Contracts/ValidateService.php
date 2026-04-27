<?php

declare(strict_types=1);

namespace Brdd\Contracts;

use Brdd\Contexts\ValidationContext;

/**
 * Protocol for services dedicated exclusively to pure business logic validation.
 * ValidateServices MUST NOT fetch data; they evaluate pre-enriched data.
 * 
 * @template E Enriched Data Input Type
 */
interface ValidateService
{
    /**
     * Evaluates rules against enriched data and returns a ValidationContext.
     *
     * @param E $enrichedData
     * @return ValidationContext
     */
    public function validate($enrichedData): ValidationContext;
}
