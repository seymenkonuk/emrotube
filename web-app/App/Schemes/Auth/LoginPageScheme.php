<?php
// ============================================================================
// File:    LoginPageScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\Auth;


use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class LoginPageScheme
{
    public static function Query()
    {
        return [
            "redirect_uri" => Validator::create()
                ->str()
                ->optional(),
        ];
    }
}
