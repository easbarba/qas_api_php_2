<?php

class ErrorHandler
{
    public static function handleException(Throwable $exception): void
    {
        echo json_encode(
            [
            "code" => $exception->getCode(),
            "messge" => $exception->getMessage(),
            "file" => $exception->getFile()
            ]
        );
    }
}
