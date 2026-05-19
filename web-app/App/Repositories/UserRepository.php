<?php
// ============================================================================
// File:    UserRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Repositories;


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Models\UserCredentials;
use Seymen\PhpMvcTemplate\Models\UserEdit;


class UserRepository extends Repository
{
    /**
     * Bu koda sahip kullanıcı olup olmadığını döner.
     * @param string $code
     * @return bool
     */
    public function existsByCode(string $code): bool
    {
        $sql = "SELECT 1 FROM vw_user_edit WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Bu kullanıcı adına sahip kullanıcı olup olmadığını döner.
     * @param string $code
     * @return bool
     */
    public function existsByUsername(string $username): bool
    {
        $sql = "SELECT 1 FROM vw_user_edit WHERE username = :username LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Bu email adresine sahip kullanıcı olup olmadığını döner.
     * @param string $code
     * @return bool
     */
    public function existsByEmail(string $email): bool
    {
        $sql = "SELECT 1 FROM vw_user_edit WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Kullanıcının kimlik bilgilerini getirir.
     * @param string $code
     * @return ?UserCredentials
     */
    public function getCodeAndPasswordHashByUsername(string $username): ?UserCredentials
    {
        $sql = "SELECT * FROM vw_user_auth WHERE username = :username LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, UserCredentials::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * Kullanıcının aktif kanalını getirir.
     * @param string $code
     * @return ?UserAuth
     */
    public function getActiveChannelByCode(string $code): ?UserAuth
    {
        $sql = "SELECT * FROM vw_user_active_channel WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, UserAuth::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * Kullanıcının edit detaylarını getirir.
     * @param string $code
     * @return ?UserEdit
     */
    public function getUserForEditing(string $code): ?UserEdit
    {
        $sql = "SELECT * FROM vw_user_edit WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, UserEdit::class);
        return $stmt->fetch() ?: null;
    }
}
