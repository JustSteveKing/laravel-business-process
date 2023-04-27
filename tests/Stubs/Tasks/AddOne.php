<?php

declare(strict_types=1);

namespace JustSteveKing\BusinessProcess\Tests\Stubs\Tasks;

use Closure;
use JustSteveKing\BusinessProcess\Contracts\ProcessPayload;
use JustSteveKing\BusinessProcess\Contracts\TaskContract;
use JustSteveKing\BusinessProcess\Tests\Stubs\CountPayload;

final class AddOne implements TaskContract
{
    /**
     * @param CountPayload|ProcessPayload $payload
     * @param Closure $next
     * @return mixed
     */
    public function __invoke(CountPayload|ProcessPayload $payload, Closure $next): mixed
    {
        ++ $payload->count;

        return $next($payload);
    }
}
