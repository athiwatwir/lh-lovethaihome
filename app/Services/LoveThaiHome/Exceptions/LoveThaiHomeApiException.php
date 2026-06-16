<?php

namespace App\Services\LoveThaiHome\Exceptions;

use Exception;
use Throwable;

class LoveThaiHomeApiException extends Exception
{
    public function __construct(
        string $message,
        public readonly ?int $statusCode = null,
        public readonly ?array $responseBody = null,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $statusCode ?? 0, $previous);
    }
}
