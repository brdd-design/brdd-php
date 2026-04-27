<?php

declare(strict_types=1);

namespace Brdd\Contracts;

/**
 * Protocol for client services that wrap external domain calls (APIs, Webhooks, ERPs, etc).
 * 
 * @template D Payload Data Type
 * @template R External Result Type
 */
interface ClientService
{
    /**
     * Calls the external service and maps internal data to the external format.
     *
     * @param D $payload
     * @return R
     */
    public function call($payload);
}
