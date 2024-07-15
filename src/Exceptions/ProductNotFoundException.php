<?php

namespace App\Exceptions;

/**
 * Product Not Found Exception.
 */
class ProductNotFoundException extends \Exception
{
    /**
     * @param $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = 'Product not found', int $code = 404, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
