<?php
// ============================================================================
// File:    UserPolicy.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Policies;


use Seymen\PhpMvcTemplate\Models\UserAuth;


class UserPolicy
{
    public static function canView(string $userCode, ?UserAuth $auth): bool
    {
        // Herkes Görüntüleyebilir
        return true;
    }

    public static function canCreate(?UserAuth $auth): bool
    {
        // Oturum Açmadıysa Yeni Kullanıcı Oluşturabilir
        return !isset($auth);
    }

    public static function canEdit(string $userCode, ?UserAuth $auth): bool
    {
        // Giriş Yapmayan Düzenleyemez
        if (!isset($auth)) {
            return false;
        }
        // Sadece Kullanıcının Kendisi Kullanıcıyı Düzenleyebilir
        return $auth->code === $userCode;
    }

    public static function canDelete(string $userCode, ?UserAuth $auth): bool
    {
        // Düzenleyebilen Kişi Silebilir
        return self::canEdit($userCode, $auth);
    }
}
