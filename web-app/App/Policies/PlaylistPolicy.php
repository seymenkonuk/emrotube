<?php
// ============================================================================
// File:    PlaylistPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Policies;


use Seymen\PhpMvcTemplate\Enums\ViewType;
use Seymen\PhpMvcTemplate\Models\PlaylistHeader;
use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Repositories\PlaylistRepository;


class PlaylistPolicy
{
    public static function canView(PlaylistHeader $playlist, ?UserAuth $auth): bool
    {
        // Oynatma Listesi Gizli Değilse Herkes Görüntüleyebilir
        if ($playlist->view_type !== ViewType::PRIVATE->value) {
            return true;
        }
        // Oynatma Listesi Gizli ise Görüntüleyebilmek İçin Oturum Açmak Zorunludur
        // Giriş Yapmayan Görüntüleyemez
        if (!isset($auth)) {
            return false;
        }
        // Oynatma Listesinin Sahibi Olmayan Görüntüleyemez
        return $auth->channel_code === $playlist->channel_code;
    }

    public static function canCreate(?UserAuth $auth): bool
    {
        // Oturum Açan Herkes Oynatma Listesi Oluşturabilir
        return isset($auth);
    }

    public static function canEdit(string $playlistCode, ?UserAuth $auth): bool
    {
        // Giriş Yapmayan Düzenleyemez
        if (!isset($auth)) {
            return false;
        }
        // Oynatma Listesinin Sahibi Olmayan Düzenleyemez
        $playlistRepository = new PlaylistRepository();
        $ownerCode = $playlistRepository->getOwnerCodeByCode($playlistCode);
        return $auth->channel_code === $ownerCode;
    }

    public static function canDelete(string $playlistCode, ?UserAuth $auth): bool
    {
        // Düzenleyebilen Kişi Silebilir
        return self::canEdit($playlistCode, $auth);
    }
}
