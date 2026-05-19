<?php
// ============================================================================
// File:    GetCategoryBannerScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\Upload;


use Seymen\PhpMvcTemplate\Config\ValidationConfig;
use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class GetCategoryBannerScheme
{
    public static function Params()
    {
        return [
            "category_code" => Validator::create()
                ->str()
                ->min(ValidationConfig::CODE_MIN_LEN)
                ->max(ValidationConfig::CODE_MAX_LEN)
                ->insertRegexRule(ValidationConfig::CODE_REGEX_ERROR, ValidationConfig::CODE_REGEX_RULE)
                ->require(),
            "file_name" => Validator::create()
                ->str()
                ->min(ValidationConfig::FILE_NAME_MIN_LEN)
                ->max(ValidationConfig::FILE_NAME_MAX_LEN)
                ->insertRegexRule(ValidationConfig::BANNER_FILE_NAME_REGEX_ERROR, ValidationConfig::BANNER_FILE_NAME_REGEX_RULE)
                ->require(),
        ];
    }
}
