<?php
// ============================================================================
// File:    ShortController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Helpers\OptionListHelper;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\ShortService;

class ShortController extends Controller
{
    private AuthService $authService;
    private ShortService $shortService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->shortService = new ShortService();
    }

    public function CreatePage()
    {
        $viewTypes = OptionListHelper::getViewTypeOptions();
        $commentTypes = OptionListHelper::getCommentTypeOptions();
        $defaultValues = Request::getFlash("value") ?? [];
        $errorMessages = Request::getFlash("error") ?? [];

        return $this->View("/studio/shorts/new", [
            "viewTypes" => $viewTypes,
            "commentTypes" => $commentTypes,
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
        ]);
    }

    public function Create()
    {
        return $this->LocalRedirect("/studio/shorts");
    }

    public function EditPage(string $shortCode)
    {
        $auth = $this->authService->getAuth();

        $editValues = $this->shortService->getShortEditData($shortCode, $auth);
        $formData = Request::getFlash("value") ?? [];


        $viewTypes = OptionListHelper::getViewTypeOptions();
        $commentTypes = OptionListHelper::getCommentTypeOptions();
        $defaultValues = $editValues->mergeFromForm($formData);
        $errorMessages = Request::getFlash("error") ?? [];

        return $this->View("/studio/shorts/[id]/edit", [
            "viewTypes" => $viewTypes,
            "commentTypes" => $commentTypes,
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
            "deleteUrl" => "/studio/shorts/$shortCode/delete",
        ]);
    }

    public function Edit(string $shortCode)
    {
        return $this->LocalRedirect("/studio/shorts");
    }

    public function Delete(string $shortCode)
    {
        return $this->LocalRedirect("/studio/shorts");
    }

    public function ChangeThumbnail(string $shortCode)
    {
        return $this->LocalRedirect("/studio/shorts");
    }

    public function IndexPage()
    {
        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->shortService->getShortsPagination($page);
        $shorts = $this->shortService->getShorts($page);

        return $this->View("/shorts", [
            "shorts" => $shorts,
            "pagination" => $pagination,
        ]);
    }

    public function WatchPage(string $shortCode)
    {
        return $this->View("/shorts/[id]");
    }

    public function Like(string $shortCode)
    {
        return $this->Component("");
    }

    public function Dislike(string $shortCode)
    {
        return $this->Component("");
    }

    public function AddWatchLater(string $shortCode)
    {
        return $this->Component("");
    }
}
