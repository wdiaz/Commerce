<?php

namespace App\Exceptions;

/**
 * Merchant Not Found Exception.
 */
class MerchantNotFoundException extends \Exception
{
    /**
     * @param $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = 'Merchant not found', int $code = 404, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
