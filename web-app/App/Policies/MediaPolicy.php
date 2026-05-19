<?php
// ============================================================================
// File:    MediaPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Policies;


use Seymen\PhpMvcTemplate\Enums\ViewType;
use Seymen\PhpMvcTemplate\Models\Media;
use Seymen\PhpMvcTemplate\Models\UserAuth;


class MediaPolicy
{
    public static function canView(Media $media, ?UserAuth $auth): bool
    {
        // Medya Gizli Değilse Herkes Görüntüleyebilir
        if ($media->view_type !== ViewType::PRIVATE->value) {
            return true;
        }
        // Medya Gizli ise Görüntüleyebilmek İçin Oturum Açmak Zorunludur
        // Giriş Yapmayan Görüntüleyemez
        if (!isset($auth)) {
            return false;
        }
        // Medyanın Sahibi Olmayan Görüntüleyemez
        return $auth->channel_code === $media->channel_code;
    }
}
