<?php
// ============================================================================
// File:    PlaylistsPageScheme.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Schemes\Feed;


use Seymen\PhpMvcTemplate\Core\Validator\Validator;


class PlaylistsPageScheme
{
    public static function Query()
    {
        return [
            "page" => Validator::create()
                ->int()
                ->min(1)
                ->optional(),
        ];
    }
}
