<?php

declare(strict_types=1);

namespace JustSteveKing\BusinessProcess;

use Illuminate\Support\Facades\Pipeline;
use JustSteveKing\BusinessProcess\Contracts\ProcessPayload;
use JustSteveKing\BusinessProcess\Contracts\TaskContract;

abstract class Process
{
    /**
     * @var array<int,class-string<TaskContract>>
     */
    protected array $tasks = [];

    /**
     * @param ProcessPayload $payload
     * @return mixed
     */
    public function run(ProcessPayload $payload): mixed
    {
        return Pipeline::send(
            passable: $payload,
        )->through(
            pipes: $this->tasks,
        )->thenReturn();
    }
}
