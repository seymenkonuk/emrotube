<?php
// ============================================================================
// File:    WatchPageScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\Music;


use Seymen\PhpMvcTemplate\Config\ValidationConfig;
use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class WatchPageScheme
{
    public static function Query()
    {
        return [
            "t" => Validator::create()
                ->int()
                ->min(0)
                ->optional(),
            "playlist" => Validator::create()
                ->str()
                ->optional(),
            "index" => Validator::create()
                ->int()
                ->min(0)
                ->optional(),
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
