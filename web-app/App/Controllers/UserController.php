<?php
// ============================================================================
// File:    UserController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Helpers\OptionListHelper;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\UserService;

class UserController extends Controller
{
    private AuthService $authService;
    private UserService $userService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->userService = new UserService();
    }

    public function EditPage(string $userCode)
    {
        $auth = $this->authService->getAuth();

        $editValues = $this->userService->getUserEditData($userCode, $auth);
        $formData = Request::getFlash("value") ?? [];

        $countries = OptionListHelper::getCountryOptions();
        $defaultValues = $editValues->mergeFromForm($formData);
        $errorMessages = Request::getFlash("error") ?? [];

        return $this->View("/studio/users/[id]/edit", [
            "countries" => $countries,
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
            "deleteUrl" => "/studio/users/$userCode/delete",
        ]);
    }

    public function Edit(string $userCode)
    {
        return $this->LocalRedirect("/studio");
    }

    public function ChangePasswordPage(string $userCode)
    {
        $auth = $this->authService->getAuth();

        $editValues = $this->userService->getUserChangePasswordData($userCode, $auth);
        $formData = Request::getFlash("value") ?? [];

        $defaultValues = $editValues?->mergeFromForm($formData) ?? [];
        $errorMessages = Request::getFlash("error") ?? [];

        return $this->View("/studio/users/[id]/change-password", [
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
        ]);
    }

    public function ChangePassword(string $userCode)
    {
        return $this->LocalRedirect("/studio");
    }

    public function Delete(string $userCode)
    {
        return $this->LocalRedirect("/logout");
    }

    public function ChangeActiveChannel(string $userCode)
    {
        return $this->LocalRedirect("/studio/channels");
    }
}
