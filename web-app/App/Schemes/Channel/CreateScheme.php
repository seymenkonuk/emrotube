<?php
// ============================================================================
// File:    CreateScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\Channel;


use Seymen\PhpMvcTemplate\Config\ValidationConfig;
use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class CreateScheme
{
    public static function Body()
    {
        return [
            "name" => Validator::create()
                ->str()
                ->min(ValidationConfig::USERNAME_MIN_LEN)
                ->max(ValidationConfig::USERNAME_MAX_LEN)
                ->insertRegexRule(ValidationConfig::USERNAME_REGEX_ERROR, ValidationConfig::USERNAME_REGEX_RULE)
                ->require(),
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
            "instagram_url" => Validator::create()
                ->str()
                ->min(ValidationConfig::LOCAL_URL_MIN_LEN)
                ->max(ValidationConfig::LOCAL_URL_MAX_LEN)
                ->insertRegexRule(ValidationConfig::LOCAL_URL_REGEX_ERROR, ValidationConfig::LOCAL_URL_REGEX_RULE)
                ->optional(),
            "twitter_url" => Validator::create()
                ->str()
                ->min(ValidationConfig::LOCAL_URL_MIN_LEN)
                ->max(ValidationConfig::LOCAL_URL_MAX_LEN)
                ->insertRegexRule(ValidationConfig::LOCAL_URL_REGEX_ERROR, ValidationConfig::LOCAL_URL_REGEX_RULE)
                ->optional(),
            "facebook_url" => Validator::create()
                ->str()
                ->min(ValidationConfig::LOCAL_URL_MIN_LEN)
                ->max(ValidationConfig::LOCAL_URL_MAX_LEN)
                ->insertRegexRule(ValidationConfig::LOCAL_URL_REGEX_ERROR, ValidationConfig::LOCAL_URL_REGEX_RULE)
                ->optional(),
            "linkedin_url" => Validator::create()
                ->str()
                ->min(ValidationConfig::LOCAL_URL_MIN_LEN)
                ->max(ValidationConfig::LOCAL_URL_MAX_LEN)
                ->insertRegexRule(ValidationConfig::LOCAL_URL_REGEX_ERROR, ValidationConfig::LOCAL_URL_REGEX_RULE)
                ->optional(),
            "github_url" => Validator::create()
                ->str()
                ->min(ValidationConfig::LOCAL_URL_MIN_LEN)
                ->max(ValidationConfig::LOCAL_URL_MAX_LEN)
                ->insertRegexRule(ValidationConfig::LOCAL_URL_REGEX_ERROR, ValidationConfig::LOCAL_URL_REGEX_RULE)
                ->optional(),
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
            "profile_photo" => [
                "name" => Validator::create()
                    ->str()
                    ->min(ValidationConfig::FILE_NAME_MIN_LEN)
                    ->max(ValidationConfig::FILE_NAME_MAX_LEN)
                    ->insertRegexRule(ValidationConfig::AVATAR_FILE_NAME_REGEX_ERROR, ValidationConfig::AVATAR_FILE_NAME_REGEX_RULE)
                    ->optional(),
                "type" => Validator::create()
                    ->str()
                    ->insertAllowValues(ValidationConfig::ALLOW_AVATAR_FILES)
                    ->optional(),
                "tmp_name" => Validator::create()
                    ->str()
                    ->optional(),
                "error" => Validator::create()
                    ->int()
                    ->min(0)
                    ->max(0)
                    ->optional(),
                "size" => Validator::create()
                    ->int()
                    ->min(ValidationConfig::MIN_AVATAR_FILE_SIZE)
                    ->max(ValidationConfig::MAX_AVATAR_FILE_SIZE)
                    ->optional(),
                "full_path" => Validator::create()
                    ->str()
                    ->optional(),
            ],
            "banner_photo" => [
                "name" => Validator::create()
                    ->str()
                    ->min(ValidationConfig::FILE_NAME_MIN_LEN)
                    ->max(ValidationConfig::FILE_NAME_MAX_LEN)
                    ->insertRegexRule(ValidationConfig::BANNER_FILE_NAME_REGEX_ERROR, ValidationConfig::BANNER_FILE_NAME_REGEX_RULE)
                    ->optional(),
                "type" => Validator::create()
                    ->str()
                    ->insertAllowValues(ValidationConfig::ALLOW_BANNER_FILES)
                    ->optional(),
                "tmp_name" => Validator::create()
                    ->str()
                    ->optional(),
                "error" => Validator::create()
                    ->int()
                    ->min(0)
                    ->max(0)
                    ->optional(),
                "size" => Validator::create()
                    ->int()
                    ->min(ValidationConfig::MIN_BANNER_FILE_SIZE)
                    ->max(ValidationConfig::MAX_BANNER_FILE_SIZE)
                    ->optional(),
                "full_path" => Validator::create()
                    ->str()
                    ->optional(),
            ],
        ];
    }
}
