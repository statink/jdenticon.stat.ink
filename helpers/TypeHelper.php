<?php

declare(strict_types=1);

namespace app\helpers;

use TypeError;
use yii\base\Application;

use function is_object;

final class TypeHelper
{
    public static function app(mixed $value): Application
    {
        return self::instanceOf($value, Application::class);
    }

    /**
     * @template T of object
     * @param class-string<T> $class
     * @return T
     */
    public static function instanceOf(mixed $value, string $class): object
    {
        return is_object($value) && $value instanceof $class
            ? $value
            : throw new TypeError('The value is unexpected object');
    }
}
