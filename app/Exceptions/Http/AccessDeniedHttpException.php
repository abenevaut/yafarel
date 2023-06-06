<?php

namespace App\Exceptions\Http;

class AccessDeniedHttpException extends HttpException
{
    public function __construct(string $message = 'Access denied', ?Throwable $previous = null)
    {
        parent::__construct($message, 403, $previous);
    }
}
