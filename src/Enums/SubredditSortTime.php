<?php

namespace RedditWrapper\Enums;

final class SubredditSortTime
{
    public const HOUR = 'hour';
    public const DAY = 'day';
    public const WEEK = 'week';
    public const MONTH = 'month';
    public const YEAR = 'year';
    public const ALL = 'all';

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
