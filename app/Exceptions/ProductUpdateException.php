<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class ProductUpdateException extends Exception
{
    public function __construct(string $message = 'Product update failed', int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
