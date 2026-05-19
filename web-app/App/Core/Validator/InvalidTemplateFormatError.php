<?php
// ============================================================================
// File:    InvalidTemplateFormatError.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Core\Validator;


use Exception;


class InvalidTemplateFormatError extends Exception
{
    public function __construct(string $message = "Şablon veri geçerli formatta değil!")
    {
        parent::__construct($message);
    }
}
