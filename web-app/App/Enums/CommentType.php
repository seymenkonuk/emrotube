<?php
// ============================================================================
// File:    CommentType.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Enums;


enum CommentType: int
{
    case DISALLOW = 0;
    case ALLOW = 1;

    public function icon(): string
    {
        return match ($this) {
            self::ALLOW => 'bi-chat',
            self::DISALLOW => '',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::ALLOW => 'Yorum Yapılabilir!',
            self::DISALLOW => 'Yorum Yapılamaz!',
        };
    }
}
