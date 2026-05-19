<?php
// ============================================================================
// File:    ViewType.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Enums;


enum ViewType: int
{
    case PUBLIC = 0;
    case UNLISTED = 1;
    case PRIVATE = 2;

    public function icon(): string
    {
        return match ($this) {
            self::PUBLIC => 'bi-globe',
            self::UNLISTED => 'bi-eye-slash',
            self::PRIVATE => 'bi-lock',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::PUBLIC => 'Herkese Açık',
            self::UNLISTED => 'Liste Dışı',
            self::PRIVATE => 'Gizli',
        };
    }
}
