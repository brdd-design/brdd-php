<?php

declare(strict_types=1);

namespace Brdd\Contexts;

/**
 * Standardized error object for BRDD.
 */
class BRDDError
{
    public function __construct(
        public readonly string $code,
        public readonly string $message
    ) {}
}
