<?php

namespace App\Utils;

/**
 * Allows search to redirect to product page directly.
 */
class SkuHelper
{
    /**
     * @param string $query
     *
     * @return bool
     */
    public static function isSku(string $query): bool
    {
        return 1 === preg_match('/^[A-Z0-9]{10}$|^\d{10}$/', $query);
    }
}
