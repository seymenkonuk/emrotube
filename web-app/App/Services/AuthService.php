<?php
// ============================================================================
// File:    AuthService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Services;

use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Exceptions\ValidationException;
use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Repositories\UserRepository;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function register(array $data)
    {
        // $errors = ["body" => [], "query" => [], "params" => []];
        // $hasError = false;

        // // Email Adresi Mevcut
        // if ($this->userRepository->existsByEmail($data["email"])) {
        //     $hasError = true;
        //     $errors["body"]["email"] = "Bu email adresi zaten kullanılıyor!";
        // }

        // // Username Mevcut
        // if ($this->userRepository->existsByUsername($data["username"])) {
        //     $hasError = true;
        //     $errors["body"]["username"] = "Bu kullanıcı adı zaten kullanılıyor!";
        // }

        // // Error
        // if ($hasError) {
        //     throw new ValidationException($errors);
        // }

        // // Parolayı Hashle
        // $data["password_hash"] = password_hash($data["password"], PASSWORD_BCRYPT);

        // // Veri Tabanına Ekle
        // if (!$this->userRepository->insert($data)) {
        //     // Bilinmeyen Hata VT'ye eklenemedi!
        //     throw new ValidationException(["body" => []]);
        // }

        // // Varsayılan Kanalı Oluştur

        // // Aktif Kanalı Değiştir
    }

    public function login(array $data)
    {
        $userCredentials = $this->userRepository->getCodeAndPasswordHashByUsername($data["username"]);

        // Kullanıcı bulunamadı
        if (!$userCredentials) {
            throw new ValidationException(["body" => [
                "password" => "Kullanıcı adı ya da parola hatalı!",
            ]], Request::getRequest(), $_SERVER["REQUEST_URI"]);
        }

        // Parola eşleşmiyor
        if (!password_verify($data["password"], $userCredentials->password_hash)) {
            throw new ValidationException(["body" => [
                "password" => "Kullanıcı adı ya da parola hatalı!",
            ]], Request::getRequest(), $_SERVER["REQUEST_URI"]);
        }

        // Oturumu oluştur
        session_regenerate_id(true);
        $_SESSION["auth"] = $userCredentials->code;
    }

    public function logout()
    {
        unset($_SESSION["auth"]);
        session_regenerate_id(true);
    }

    public function isLoggedIn(): bool
    {
        if ($this->getAuth() === null) {
            unset($_SESSION["auth"]);
            return false;
        }
        return true;
    }

    public function getAuth(): ?UserAuth
    {
        if (!isset($_SESSION["auth"])) {
            return null;
        }
        return $this->userRepository->getActiveChannelByCode($_SESSION["auth"]);
    }
}
