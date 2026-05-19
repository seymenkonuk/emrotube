<?php
// ============================================================================
// File:    SubscribeScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\Notification;


use Seymen\PhpMvcTemplate\Config\ValidationConfig;
use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class SubscribeScheme
{
    public static function Body()
    {
        return [
            "csrf_token" => Validator::create()
                ->str()
                ->min(ValidationConfig::CSRF_TOKEN_MIN_LEN)
                ->max(ValidationConfig::CSRF_TOKEN_MAX_LEN)
                ->insertRegexRule(ValidationConfig::CSRF_TOKEN_REGEX_ERROR, ValidationConfig::CSRF_TOKEN_REGEX_RULE)
                ->require(),
            "data" => Validator::create()
                ->str()
                ->require(),
        ];
    }
}
