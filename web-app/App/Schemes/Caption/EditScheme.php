<?php
// ============================================================================
// File:    EditScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\Caption;


use Seymen\PhpMvcTemplate\Config\ValidationConfig;
use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class EditScheme
{
    public static function Body()
    {
        return [
            "language_code" => Validator::create()
                ->str()
                ->min(ValidationConfig::LANGUAGE_CODE_MIN_LEN)
                ->max(ValidationConfig::LANGUAGE_CODE_MAX_LEN)
                ->insertRegexRule(ValidationConfig::LANGUAGE_CODE_REGEX_ERROR, ValidationConfig::LANGUAGE_CODE_REGEX_RULE)
                ->require(),
            "language_name" => Validator::create()
                ->str()
                ->min(ValidationConfig::NAME_MIN_LEN)
                ->max(ValidationConfig::NAME_MAX_LEN)
                ->insertRegexRule(ValidationConfig::NAME_REGEX_ERROR, ValidationConfig::NAME_REGEX_RULE)
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
            "caption_code" => Validator::create()
                ->str()
                ->min(ValidationConfig::CODE_MIN_LEN)
                ->max(ValidationConfig::CODE_MAX_LEN)
                ->insertRegexRule(ValidationConfig::CODE_REGEX_ERROR, ValidationConfig::CODE_REGEX_RULE)
                ->require(),
        ];
    }
}
