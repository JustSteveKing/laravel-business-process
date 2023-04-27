<?php

declare(strict_types=1);

namespace JustSteveKing\BusinessProcess\Tests\Stubs;

use JustSteveKing\BusinessProcess\Contracts\ProcessPayload;

final class CountPayload implements ProcessPayload
{
    public function __construct(
        public int $count,
    ) {
    }
}
