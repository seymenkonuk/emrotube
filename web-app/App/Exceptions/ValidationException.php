<?php
// ============================================================================
// File:    ValidationException.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Exceptions;


use Exception;


class ValidationException extends Exception
{
    protected array $errors;
    protected array $values;
    protected string $redirectUri;

    public function __construct(array $errors, array $values, string $redirectUri, string $message = "Doğrulama hatası")
    {
        parent::__construct($message);
        $this->errors = $errors;
        $this->values = $values;
        $this->redirectUri = $redirectUri;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }
}
