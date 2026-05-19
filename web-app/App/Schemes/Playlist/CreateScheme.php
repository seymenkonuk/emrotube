<?php
// ============================================================================
// File:    CreateScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\Playlist;


use Seymen\PhpMvcTemplate\Config\ValidationConfig;
use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class CreateScheme
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
            "csrf_token" => Validator::create()
                ->str()
                ->min(ValidationConfig::CSRF_TOKEN_MIN_LEN)
                ->max(ValidationConfig::CSRF_TOKEN_MAX_LEN)
                ->insertRegexRule(ValidationConfig::CSRF_TOKEN_REGEX_ERROR, ValidationConfig::CSRF_TOKEN_REGEX_RULE)
                ->require(),
        ];
    }

    public static function Files()
    {
        return [
            "banner_photo" => [
                "name" => Validator::create()
                    ->str()
                    ->min(ValidationConfig::FILE_NAME_MIN_LEN)
                    ->max(ValidationConfig::FILE_NAME_MAX_LEN)
                    ->insertRegexRule(ValidationConfig::BANNER_FILE_NAME_REGEX_ERROR, ValidationConfig::BANNER_FILE_NAME_REGEX_RULE)
                    ->require(),
                "type" => Validator::create()
                    ->str()
                    ->insertAllowValues(ValidationConfig::ALLOW_BANNER_FILES)
                    ->require(),
                "tmp_name" => Validator::create()
                    ->str()
                    ->require(),
                "error" => Validator::create()
                    ->int()
                    ->min(0)
                    ->max(0)
                    ->require(),
                "size" => Validator::create()
                    ->int()
                    ->min(ValidationConfig::MIN_BANNER_FILE_SIZE)
                    ->max(ValidationConfig::MAX_BANNER_FILE_SIZE)
                    ->require(),
                "full_path" => Validator::create()
                    ->str()
                    ->optional(),
            ],
        ];
    }
}
