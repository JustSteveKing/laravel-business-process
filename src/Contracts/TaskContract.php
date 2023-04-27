<?php

declare(strict_types=1);

namespace JustSteveKing\BusinessProcess\Contracts;

use Closure;

interface TaskContract
{
    public function __invoke(ProcessPayload $payload, Closure $next): mixed;
}
