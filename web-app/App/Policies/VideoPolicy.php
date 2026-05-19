<?php
// ============================================================================
// File:    VideoPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Policies;


use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Repositories\VideoRepository;


class VideoPolicy
{
    public static function canCreate(?UserAuth $auth): bool
    {
        // Oturum Açan Herkes Video Oluşturabilir
        return isset($auth);
    }

    public static function canEdit(string $videoCode, ?UserAuth $auth): bool
    {
        // Giriş Yapmayan Düzenleyemez
        if (!isset($auth)) {
            return false;
        }
        // Videonun Sahibi Olmayan Düzenleyemez
        $videoRepository = new VideoRepository();
        $uploaderCode = $videoRepository->getUploaderCodeByCode($videoCode);
        return $auth->channel_code === $uploaderCode;
    }

    public static function canDelete(string $videoCode, ?UserAuth $auth): bool
    {
        // Düzenleyebilen Kişi Silebilir
        return self::canEdit($videoCode, $auth);
    }
}
