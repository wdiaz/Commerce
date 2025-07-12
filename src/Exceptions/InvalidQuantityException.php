<?php

namespace App\Exceptions;

class InvalidQuantityException extends \Exception
{

    /**
     * @param $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = 'Invalid Quantity', int $code = 404, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}