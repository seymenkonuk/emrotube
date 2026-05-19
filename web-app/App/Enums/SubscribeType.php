<?php
// ============================================================================
// File:    SubscribeType.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Enums;


enum SubscribeType: int
{
    case SELF_SUBSCRIBE_NOT_ALLOWED = -3;
    case GUEST_SUBSCRIBE_NOT_ALLOWED = -2;
    case NOT_SUBSCRIBED = -1;
    case NORMAL = 0;

    public function icon(): string
    {
        return match ($this) {
            self::SELF_SUBSCRIBE_NOT_ALLOWED => 'bi-bell-slash',
            self::GUEST_SUBSCRIBE_NOT_ALLOWED => '',
            self::NOT_SUBSCRIBED => 'bi-bell',
            self::NORMAL => 'bi-bell-fill',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::SELF_SUBSCRIBE_NOT_ALLOWED => '',
            self::GUEST_SUBSCRIBE_NOT_ALLOWED => '',
            self::NOT_SUBSCRIBED => '',
            self::NORMAL => 'Abonelik',
        };
    }

    public function getButtonText(): string
    {
        return match ($this) {
            self::SELF_SUBSCRIBE_NOT_ALLOWED => 'Kendinize Abone Olamazsınız',
            self::GUEST_SUBSCRIBE_NOT_ALLOWED => 'Abone Olmak için Oturum Açınız',
            self::NOT_SUBSCRIBED => 'Abone Ol',
            self::NORMAL => 'Abonelikten Çık',
        };
    }
}
