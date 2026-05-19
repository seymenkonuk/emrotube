<?php
// ============================================================================
// File:    ChangeThumbnailScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\Video;


use Seymen\PhpMvcTemplate\Config\ValidationConfig;
use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class ChangeThumbnailScheme
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
            "video_code" => Validator::create()
                ->str()
                ->min(ValidationConfig::CODE_MIN_LEN)
                ->max(ValidationConfig::CODE_MAX_LEN)
                ->insertRegexRule(ValidationConfig::CODE_REGEX_ERROR, ValidationConfig::CODE_REGEX_RULE)
                ->require(),
        ];
    }

    public static function Files()
    {
        return [
            "thumbnail_photo" => [
                "name" => Validator::create()
                    ->str()
                    ->min(ValidationConfig::FILE_NAME_MIN_LEN)
                    ->max(ValidationConfig::FILE_NAME_MAX_LEN)
                    ->insertRegexRule(ValidationConfig::THUMBNAIL_FILE_NAME_REGEX_ERROR, ValidationConfig::THUMBNAIL_FILE_NAME_REGEX_RULE)
                    ->require(),
                "type" => Validator::create()
                    ->str()
                    ->insertAllowValues(ValidationConfig::ALLOW_THUMBNAIL_FILES)
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
                    ->max(ValidationConfig::MIN_THUMBNAIL_FILE_SIZE)
                    ->max(ValidationConfig::MAX_THUMBNAIL_FILE_SIZE)
                    ->require(),
                "full_path" => Validator::create()
                    ->str()
                    ->optional(),
            ],
        ];
    }
}
