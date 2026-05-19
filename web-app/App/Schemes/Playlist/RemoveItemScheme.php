<?php
// ============================================================================
// File:    RemoveItemScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\Playlist;


use Seymen\PhpMvcTemplate\Config\ValidationConfig;
use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class RemoveItemScheme
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
        ];
    }

    public static function Params()
    {
        return [
            "playlist_code" => Validator::create()
                ->str()
                ->min(ValidationConfig::CODE_MIN_LEN)
                ->max(ValidationConfig::CODE_MAX_LEN)
                ->insertRegexRule(ValidationConfig::CODE_REGEX_ERROR, ValidationConfig::CODE_REGEX_RULE)
                ->require(),
            "item_id" => Validator::create()
                ->int()
                ->min(1)
                ->require(),
        ];
    }
}
