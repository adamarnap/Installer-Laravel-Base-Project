<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ServiceException extends Exception
{
    protected array $context;

    public function __construct(
        string $message = 'Service error',
        int $code = 409,
        array $context = [],
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->context = $context;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
