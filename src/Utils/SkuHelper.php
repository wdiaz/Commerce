<?php

namespace App\Utils;

class SkuHelper
{
    public static function isSku(string $query): bool
    {
        return 1 === preg_match('/^[A-Z0-9]{10}$|^\d{10}$/', $query);
    }
}
