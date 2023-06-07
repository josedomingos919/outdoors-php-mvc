<?php

namespace App\Core;

abstract class Pagination
{
    const SIZE = 5;

    public static function getStart(int $page): int
    {
        return ($page - 1) * self::SIZE;
    }

    public static function getEnd(): int
    {
        return self::SIZE;
    }
}
