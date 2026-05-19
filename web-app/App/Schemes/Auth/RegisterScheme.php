<?php
// ============================================================================
// File:    RegisterScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\Auth;


use Seymen\PhpMvcTemplate\Config\ValidationConfig;
use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class RegisterScheme
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
            "username" => Validator::create()
                ->str()
                ->min(ValidationConfig::USERNAME_MIN_LEN)
                ->max(ValidationConfig::USERNAME_MAX_LEN)
                ->insertRegexRule(ValidationConfig::USERNAME_REGEX_ERROR, ValidationConfig::USERNAME_REGEX_RULE)
                ->require(),
            "email" => Validator::create()
                ->email()
                ->min(ValidationConfig::EMAIL_MIN_LEN)
                ->max(ValidationConfig::EMAIL_MAX_LEN)
                ->insertRegexRule(ValidationConfig::EMAIL_REGEX_ERROR, ValidationConfig::EMAIL_REGEX_RULE)
                ->require(),
            "password" => Validator::create()
                ->str()
                ->min(ValidationConfig::PASSWORD_MIN_LEN)
                ->max(ValidationConfig::PASSWORD_MAX_LEN)
                ->insertRegexRule(ValidationConfig::PASSWORD_REGEX_ERROR, ValidationConfig::PASSWORD_REGEX_RULE)
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

    public static function Query()
    {
        return [
            "redirect_uri" => Validator::create()
                ->str()
                ->optional(),
        ];
    }
}
