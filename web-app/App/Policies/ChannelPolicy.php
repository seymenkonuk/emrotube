<?php
// ============================================================================
// File:    ChannelPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Policies;


use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Repositories\ChannelRepository;

class ChannelPolicy
{
    public static function canView(string $channelCode, ?UserAuth $auth): bool
    {
        // Herkes Görüntüleyebilir
        return true;
    }

    public static function canCreate(?UserAuth $auth): bool
    {
        // Oturum Açan Herkes Video Oluşturabilir
        return isset($auth);
    }

    public static function canEdit(string $channelCode, ?UserAuth $auth): bool
    {
        // Giriş Yapmayan Editleyemez
        if (!isset($auth)) {
            return false;
        }
        // Videonun Sahibi Olmayan Düzenleyemez
        $channelRepository = new ChannelRepository();
        $userCode = $channelRepository->getUserCodeByChannelCode($channelCode);
        // Kanalın Sahibi Olmayan Düzenleyemez
        return $auth->code === $userCode;
    }

    public static function canDelete(string $channelCode, ?UserAuth $auth): bool
    {
        // Düzenleyebilen Kişi Silebilir
        return self::canEdit($channelCode, $auth);
    }
}
