<?php
// ============================================================================
// File:    LikeType.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Enums;


enum LikeType: int
{
    case DISLIKE = 0;
    case LIKE = 1;

    public function icon(): string
    {
        return match ($this) {
            self::DISLIKE => 'bi-hand-thumbs-down',
            self::LIKE => 'bi-hand-thumbs-up',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::DISLIKE => 'Beğenmeme',
            self::LIKE => 'Beğeni',
        };
    }
}
