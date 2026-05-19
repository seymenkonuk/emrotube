<?php
// ============================================================================
// File:    MusicPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Policies;


use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Repositories\MusicRepository;


class MusicPolicy
{
    public static function canCreate(?UserAuth $auth): bool
    {
        // Oturum Açan Herkes Müzik Oluşturabilir
        return isset($auth);
    }

    public static function canEdit(string $musicCode, ?UserAuth $auth): bool
    {
        // Giriş Yapmayan Düzenleyemez
        if (!isset($auth)) {
            return false;
        }
        // Müziğin Sahibi Olmayan Düzenleyemez
        $musicRepository = new MusicRepository();
        $uploaderCode = $musicRepository->getUploaderCodeByCode($musicCode);
        return $auth->channel_code === $uploaderCode;
    }

    public static function canDelete(string $musicCode, ?UserAuth $auth): bool
    {
        // Düzenleyebilen Kişi Silebilir
        return self::canEdit($musicCode, $auth);
    }
}
