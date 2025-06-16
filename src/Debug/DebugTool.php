<?php

namespace App\Debug;

class DebugTool
{
    public static function dump(...$arguments): void
    {
        if (!self::isDevelopment()) {
            return;
        }

        echo '<br>------------------------------<br>';
        self::printFile(__FUNCTION__);
        foreach ($arguments as $argument) {
            self::formatDump($argument);
        }
        echo '<br>------------------------------<br>';
    }

    public static function dd(...$arguments): void
    {
        if (!self::isDevelopment()) {
            return;
        }

        self::dump($arguments);
        die;
    }

    private static function printFile($function): void
    {
        $key = array_search($function, array_column(debug_backtrace(), 'function'));
        echo debug_backtrace()[$key]['file'].' : '.debug_backtrace()[$key]['line'];
    }

    private static function formatDump($argument): void
    {
        echo '<pre>';
        var_dump($argument);
        echo '</pre>';
    }

    private static function isDevelopment(): bool
    {
        return $_ENV['APP_MODE'] === 'dev' || $_ENV['APP_MODE'] === 'development';
    }
}