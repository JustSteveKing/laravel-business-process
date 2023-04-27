<?php

declare(strict_types=1);

namespace JustSteveKing\BusinessProcess\Tests\Stubs;

use JustSteveKing\BusinessProcess\Process;
use JustSteveKing\BusinessProcess\Tests\Stubs\Tasks\AddOne;

final class CountProcess extends Process
{
    protected array $tasks = [
        AddOne::class,
    ];
}
