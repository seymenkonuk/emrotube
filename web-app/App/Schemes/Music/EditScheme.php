<?php
// ============================================================================
// File:    EditScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\Music;


use Seymen\PhpMvcTemplate\Config\ValidationConfig;
use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class EditScheme
{
    public static function Body()
    {
        return [
            "title" => Validator::create()
                ->str()
                ->min(ValidationConfig::TITLE_MIN_LEN)
                ->max(ValidationConfig::TITLE_MAX_LEN)
                ->insertRegexRule(ValidationConfig::TITLE_REGEX_ERROR, ValidationConfig::TITLE_REGEX_RULE)
                ->require(),
            "description" => Validator::create()
                ->str()
                ->min(ValidationConfig::DESC_MIN_LEN)
                ->max(ValidationConfig::DESC_MAX_LEN)
                ->insertRegexRule(ValidationConfig::DESC_REGEX_ERROR, ValidationConfig::DESC_REGEX_RULE)
                ->optional(),
            "view_type" => Validator::create()
                ->str()
                ->insertAllowValues(ValidationConfig::VIEW_TYPES)
                ->require(),
            "comment_type" => Validator::create()
                ->str()
                ->insertAllowValues(ValidationConfig::COMMENT_TYPES)
                ->require(),
            "transcript" => Validator::create()
                ->str()
                ->min(ValidationConfig::LANGUAGE_CODE_MIN_LEN)
                ->max(ValidationConfig::LANGUAGE_CODE_MAX_LEN)
                ->insertRegexRule(ValidationConfig::LANGUAGE_CODE_REGEX_ERROR, ValidationConfig::LANGUAGE_CODE_REGEX_RULE)
                ->optional(),
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
            "music_code" => Validator::create()
                ->str()
                ->min(ValidationConfig::CODE_MIN_LEN)
                ->max(ValidationConfig::CODE_MAX_LEN)
                ->insertRegexRule(ValidationConfig::CODE_REGEX_ERROR, ValidationConfig::CODE_REGEX_RULE)
                ->require(),
        ];
    }
}
