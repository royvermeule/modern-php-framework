<?php

declare(strict_types=1);

namespace Src\core;

final class Config
{
    public static string $appRoot = __DIR__ . '/../';

    /**
     * @return array<string, scalar>
     * @throws \Exception
     */
    public static function getLocalConfig(): array
    {
        $directory = self::$appRoot . 'local-config.php';
        if (!file_exists($directory)) {
            throw new \Exception('local-config.php not found');
        }
        /** @var array<string, scalar> $localConfig */
        $localConfig = require $directory;
        return $localConfig;
    }

    /**
     * @return scalar
     * @throws \Exception
     * @throws \InvalidArgumentException
     */
    public static function getFromLocalConfig(string $key): mixed
    {
        $localConfig = self::getLocalConfig();
        if (!array_key_exists($key, $localConfig)) {
            throw new \InvalidArgumentException("Key $key not found in local-config.php");
        }
        return $localConfig[$key];
    }
}
