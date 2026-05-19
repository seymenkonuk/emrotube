<?php
// ============================================================================
// File:    ShortPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Policies;


use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Repositories\ShortRepository;


class ShortPolicy
{
    public static function canCreate(?UserAuth $auth): bool
    {
        // Oturum Açan Herkes Kısa Video Oluşturabilir
        return isset($auth);
    }

    public static function canEdit(string $shortCode, ?UserAuth $auth): bool
    {
        // Giriş Yapmayan Düzenleyemez
        if (!isset($auth)) {
            return false;
        }
        // Kısa Videonun Sahibi Olmayan Düzenleyemez
        $shortRepository = new ShortRepository();
        $uploaderCode = $shortRepository->getUploaderCodeByCode($shortCode);
        return $auth->channel_code === $uploaderCode;
    }

    public static function canDelete(string $shortCode, ?UserAuth $auth): bool
    {
        // Düzenleyebilen Kişi Silebilir
        return self::canEdit($shortCode, $auth);
    }
}
