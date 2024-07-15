<?php

namespace App\Exceptions;

/**
 * Not Enough Inventory Exception.
 */
class NotEnoughInventoryException extends \Exception
{
    /**
     * @param $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = 'Not Enough Inventory', int $code = 400, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
