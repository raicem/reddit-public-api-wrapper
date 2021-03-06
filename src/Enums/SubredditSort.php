<?php

namespace RedditWrapper\Enums;

final class SubredditSort
{
    public const HOT = 'hot';
    public const NEW = 'new';
    public const CONTROVERSIAL = 'controversial';
    public const TOP = 'top';
    public const RISING = 'rising';

    /**
     * Determines if the give value is a valid SubredditSort value. It uses
     * ReflectionClass to get the classes constant values.
     */
    public static function isValid(string $parameter): bool
    {
        $constants = (new \ReflectionClass(self::class))->getConstants();

        return in_array($parameter, $constants);
    }

    public static function isNotValid(string $parameter): bool
    {
        return !self::isValid($parameter);
    }
}
