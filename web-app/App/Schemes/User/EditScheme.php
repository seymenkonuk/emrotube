<?php
// ============================================================================
// File:    EditScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\User;


use Seymen\PhpMvcTemplate\Config\ValidationConfig;
use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class EditScheme
{
    public static function Body()
    {
        return [
            "name" => Validator::create()
                ->str()
                ->min(ValidationConfig::NAME_MIN_LEN)
                ->max(ValidationConfig::NAME_MAX_LEN)
                ->insertRegexRule(ValidationConfig::NAME_REGEX_ERROR, ValidationConfig::NAME_REGEX_RULE)
                ->require(),
            "surname" => Validator::create()
                ->str()
                ->min(ValidationConfig::SURNAME_MIN_LEN)
                ->max(ValidationConfig::SURNAME_MAX_LEN)
                ->insertRegexRule(ValidationConfig::SURNAME_REGEX_ERROR, ValidationConfig::SURNAME_REGEX_RULE)
                ->require(),
            "country" => Validator::create()
                ->str()
                ->insertAllowValues(ValidationConfig::COUNTRIES)
                ->require(),
            "csrf_token" => Validator::create()
                ->str()
                ->min(ValidationConfig::CSRF_TOKEN_MIN_LEN)
                ->max(ValidationConfig::CSRF_TOKEN_MAX_LEN)
                ->insertRegexRule(ValidationConfig::CSRF_TOKEN_REGEX_ERROR, ValidationConfig::CSRF_TOKEN_REGEX_RULE)
                ->require(),
        ];
    }

    public static function Params()
    {
        return [
            "user_code" => Validator::create()
                ->str()
                ->min(ValidationConfig::CODE_MIN_LEN)
                ->max(ValidationConfig::CODE_MAX_LEN)
                ->insertRegexRule(ValidationConfig::CODE_REGEX_ERROR, ValidationConfig::CODE_REGEX_RULE)
                ->require(),
        ];
    }
}
