<?php
// ============================================================================
// File:    AuthController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Helpers\OptionListHelper;
use Seymen\PhpMvcTemplate\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
    }

    public function RegisterPage()
    {
        $countries = OptionListHelper::getCountryOptions();
        $defaultValues = Request::getFlash("value") ?? [];
        $errorMessages = Request::getFlash("error") ?? [];
        $redirectUri = Request::getQuery("redirect_uri") ?? null;

        return $this->View("/register", [
            "countries" => $countries,
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
            "redirectUri" => $redirectUri,
        ]);
    }

    public function Register()
    {
        $data = Request::getFormBody();
        $this->authService->register($data);

        // Giriş Yap formunda username otomatik dolu gelsin
        Request::setFlash("value", ["body" => [
            "username" => $data["username"],
        ]]);

        $redirectUri = Request::getQuery("redirect_uri") ?? null;
        $redirectUri = "/login" . (($redirectUri !== null) ? "?redirect_uri=$redirectUri" : "");
        return $this->LocalRedirect($redirectUri);
    }

    public function LoginPage()
    {
        $defaultValues = Request::getFlash("value") ?? [];
        $errorMessages = Request::getFlash("error") ?? [];
        $redirectUri = Request::getQuery("redirect_uri") ?? null;

        return $this->View("/login", [
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
            "redirectUri" => $redirectUri,
        ]);
    }

    public function Login()
    {
        $data = Request::getFormBody();
        $this->authService->login($data);

        $redirectUri = Request::getQuery("redirect_uri") ?? "/";
        return $this->LocalRedirect($redirectUri);
    }

    public function Logout()
    {
        $this->authService->logout();
        return $this->LocalRedirect("/");
    }
}
