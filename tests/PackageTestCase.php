<?php

declare(strict_types=1);

namespace JustSteveKing\BusinessProcess\Tests;

use Illuminate\Foundation\Application;
use JustSteveKing\BusinessProcess\Providers\PackageServiceProvider;
use Orchestra\Testbench\TestCase;

abstract class PackageTestCase extends TestCase
{
    /**
     * @param Application $app
     * @return array<int,class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            PackageServiceProvider::class,
        ];
    }
}
