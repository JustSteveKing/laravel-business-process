<?php

declare(strict_types=1);

use JustSteveKing\BusinessProcess\Process;
use JustSteveKing\BusinessProcess\Tests\Stubs\CountPayload;
use JustSteveKing\BusinessProcess\Tests\Stubs\CountProcess;

it('can create a new process', function (): void {
    expect(new CountProcess())->toBeInstanceOf(Process::class);
});

it('runs the process', function (): void {
    $process = new CountProcess();

    expect(
        $process->run(
            payload: new CountPayload(
                count: 1,
            ),
        )
    )->toBeInstanceOf(CountPayload::class)->count->toEqual(2);
});
