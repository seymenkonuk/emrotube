<?php
// ============================================================================
// File:    TemplateException.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Core;


use Exception;


class TemplateException extends Exception
{
    public function __construct(string $message = "Template Not Found")
    {
        parent::__construct($message);
    }
}
