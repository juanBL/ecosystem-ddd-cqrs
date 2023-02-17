<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector;
use Rector\Php81\Rector\Property\ReadOnlyPropertyRector;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets(
        [
            SetList::CODE_QUALITY,
            SetList::DEAD_CODE,
            SetList::TYPE_DECLARATION,
            SetList::PHP_82,
        ]
    );

    $rectorConfig->paths(
        [
            __DIR__ . '/src',
            __DIR__ . '/tests',
            __DIR__ . '/apps/api/backend/src',
        ]
    );

    $rectorConfig->skip(
        [
            // paths @todo
            // Rules @todo
            RemoveUnusedPromotedPropertyRector::class,
            ReadOnlyPropertyRector::class,
        ]
    );

    $rectorConfig->autoloadPaths(
        [
            'apps/bootstrap.php',
        ]
    );

    // symfony container
    $path             = __DIR__ . '/apps/api/backend/var/cache';
    $kernel_dev_file  = $path . '/dev/App_Apps_Api_Backend_ApiBackendKernelDevDebugContainer.xml';
    $kernel_test_file = $path . '/test/App_Apps_Api_Backend_ApiBackendKernelTestDebugContainer.xml';
    if (file_exists($kernel_dev_file)) {
        $container = $kernel_dev_file;
    } elseif (file_exists($kernel_test_file)) {
        $container = $kernel_test_file;
    } else {
        print sprintf('Symfony container path does not exist. Current path is: %s' . PHP_EOL, $kernel_dev_file);
        exit();
    }
    $rectorConfig->symfonyContainerXml($container);

    // php-stan
    $rectorConfig->phpstanConfig(getcwd() . '/phpstan.neon');
};