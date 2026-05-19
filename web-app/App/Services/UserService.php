<?php
// ============================================================================
// File:    UserService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Services;

use Seymen\PhpMvcTemplate\Exceptions\AuthorizationException;
use Seymen\PhpMvcTemplate\Exceptions\NotFoundException;
use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Models\UserEdit;
use Seymen\PhpMvcTemplate\Policies\UserPolicy;
use Seymen\PhpMvcTemplate\Repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getUserEditData(string $userCode, ?UserAuth $auth): ?UserEdit
    {
        // Kullanıcı Mevcut Mu
        if (!$this->userRepository->existsByCode($userCode)) {
            throw new NotFoundException(NotFoundException::USER_NOT_FOUND_TITLE, NotFoundException::USER_NOT_FOUND_DESCRIPTION);
        }

        // Kullanıcıyı Düzenleme Yetkin Var Mı
        if (!UserPolicy::canEdit($userCode, $auth)) {
            throw new AuthorizationException(AuthorizationException::USER_EDIT_PERMISSION_DENIED_TITLE, AuthorizationException::USER_EDIT_PERMISSION_DENIED_DESCRIPTION);
        }

        // Kullanıcı Bilgisini Al
        $data = $this->userRepository->getUserForEditing($userCode);

        // Veriyi Döndür
        return $data;
    }

    public function getUserChangePasswordData(string $userCode, ?UserAuth $auth): ?UserEdit
    {
        // Kullanıcı Mevcut Mu
        if (!$this->userRepository->existsByCode($userCode)) {
            throw new NotFoundException(NotFoundException::USER_NOT_FOUND_TITLE, NotFoundException::USER_NOT_FOUND_DESCRIPTION);
        }

        // Kullanıcıyı Düzenleme Yetkin Var Mı
        if (!UserPolicy::canEdit($userCode, $auth)) {
            throw new AuthorizationException(AuthorizationException::USER_EDIT_PERMISSION_DENIED_TITLE, AuthorizationException::USER_EDIT_PERMISSION_DENIED_DESCRIPTION);
        }

        // Veriyi Döndür
        return null;
    }
}
