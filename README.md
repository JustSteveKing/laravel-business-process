# Laravel Business Process

<!-- BADGES_START -->
[![Latest Version][badge-release]][packagist]
[![Software License][badge-license]][license]
[![Run Tests](https://github.com/JustSteveKing/laravel-business-process/actions/workflows/tests.yml/badge.svg)](https://github.com/JustSteveKing/laravel-business-process/actions/workflows/tests.yml)
[![PHP Version][badge-php]][php]
[![Total Downloads][badge-downloads]][downloads]

[badge-release]: https://img.shields.io/packagist/v/juststeveking/laravel-business-process.svg?style=flat-square&label=release
[badge-license]: https://img.shields.io/packagist/l/juststeveking/laravel-business-process.svg?style=flat-square
[badge-php]: https://img.shields.io/packagist/php-v/juststeveking/laravel-business-process.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/juststeveking/laravel-business-process.svg?style=flat-square&colorB=mediumvioletred

[packagist]: https://packagist.org/packages/juststeveking/laravel-business-process
[license]: https://github.com/juststeveking/laravel-business-process/blob/main/LICENSE
[php]: https://php.net
[downloads]: https://packagist.org/packages/juststeveking/laravel-business-process
<!-- BADGES_END -->

Laravel Business Process is a simple and clean way to run business process using a Laravel Pipeline, in a structured and type-safe way.

## Installation

```shell
composer require juststeveking/laravel-business-process
```

## Usage

To get started with this package, all you need to do is create a new process class:

```php
use JustSteveKing\BusinessProcess\Process;

final class PurchaseProduct extends Process
{
    protected array $tasks = [
        CheckStockLevel::class,
        ProcessOrder::class,
        DecreaseStockLevel::class,
        NotifyWarehouse::class,
        EmailCustomer::class,
    ];
}
```

Our process class registers the tasks that need to be completed for this process to run, each task must implement the `TaskContract` interface that comes with this package.

```php
use JustSteveKing\BusinessProcess\Contracts\TaskContract;

final class CheckStockLevel implements TaskContract
{
    public function __invoke(ProcessPayload $payload, Closure $next): mixed
    {
        // perform your logic here with the passed in payload.
        
        return $next($payload);
    }
}
```

Your tasks are standard classes that the `Pipeline` class from Laravel would expect.

The payload is a class that implements `ProcessPayload` interface, signalling that it is a payload for a process. They are simple plain old PHP classes with no requirements to add methods.

```php
use JustSteveKing\BusinessProcess\Contracts\ProcessPayload;

final class PurchaseProductPayload implements ProcessPayload
{
    public function __construct(
        // add whatever public properties you need here
        public int $product,
        public int $user,
        public int $order,
    ) {}
}
```

Finally, we can call this process within our controller/job/cli wherever you need to.

```php
final class PurchaseController
{
     public function __construct(
        private readonly PurchaseProduct $process,
     ) {}
     
     public function __invoke(PurchaseRequest $request, int $product): JsonResponse
     {
        try {
            $this->process->run(
                payload: $request->payload(),
            );
        } catch (Throwable $exception) {
            // Handle exception
        }
        
        // return response.
     }
}
```
## Testing

To run the test:

```bash
composer run test
```

## Credits

- [Steve McDougall](https://github.com/JustSteveKing)
- [All Contributors](../../contributors)

## LICENSE

The MIT License (MIT). Please see [License File](./LICENSE) for more information.

