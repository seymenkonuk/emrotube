<?php
// ============================================================================
// File:    IndexPageScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\Search;


use Seymen\PhpMvcTemplate\Config\ValidationConfig;
use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class IndexPageScheme
{
    public static function Query()
    {
        return [
            "q" => Validator::create()
                ->str()
                ->optional(),
            "category" => Validator::create()
                ->str()
                ->optional(),
            "channel" => Validator::create()
                ->str()
                ->optional(),
            "type" => Validator::create()
                ->str()
                ->insertAllowValues(ValidationConfig::CONTENT_TYPE_FILTERS)
                ->optional(),
            "duration" => Validator::create()
                ->str()
                ->insertAllowValues(ValidationConfig::DURATION_FILTERS)
                ->optional(),
            "sort" => Validator::create()
                ->str()
                ->insertAllowValues(ValidationConfig::SORT_FILTERS)
                ->optional(),
            "date" => Validator::create()
                ->str()
                ->insertAllowValues(ValidationConfig::DATE_FILTERS)
                ->optional(),
            "page" => Validator::create()
                ->int()
                ->min(1)
                ->optional(),
        ];
    }
}
