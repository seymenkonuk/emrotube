<?php
// ============================================================================
// File:    MusicController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Helpers\OptionListHelper;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\MusicService;

class MusicController extends Controller
{
    private AuthService $authService;
    private MusicService $musicService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->musicService = new MusicService();
    }

    public function CreatePage()
    {
        $viewTypes = OptionListHelper::getViewTypeOptions();
        $commentTypes = OptionListHelper::getCommentTypeOptions();
        $defaultValues = Request::getFlash("value") ?? [];
        $errorMessages = Request::getFlash("error") ?? [];

        return $this->View("/studio/musics/new", [
            "viewTypes" => $viewTypes,
            "commentTypes" => $commentTypes,
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
        ]);
    }

    public function Create()
    {
        return $this->LocalRedirect("/studio/musics");
    }

    public function EditPage(string $musicCode)
    {
        $auth = $this->authService->getAuth();

        $editValues = $this->musicService->getMusicEditData($musicCode, $auth);
        $formData = Request::getFlash("value") ?? [];


        $viewTypes = OptionListHelper::getViewTypeOptions();
        $commentTypes = OptionListHelper::getCommentTypeOptions();
        $defaultValues = $editValues->mergeFromForm($formData);
        $errorMessages = Request::getFlash("error") ?? [];

        return $this->View("/studio/musics/[id]/edit", [
            "viewTypes" => $viewTypes,
            "commentTypes" => $commentTypes,
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
            "deleteUrl" => "/studio/musics/$musicCode/delete",
        ]);
    }

    public function Edit(string $musicCode)
    {
        return $this->LocalRedirect("/studio/musics");
    }

    public function Delete(string $musicCode)
    {
        return $this->LocalRedirect("/studio/musics");
    }

    public function ChangeThumbnail(string $musicCode)
    {
        return $this->LocalRedirect("/studio/musics");
    }

    public function IndexPage()
    {
        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->musicService->getMusicsPagination($page);
        $musics = $this->musicService->getMusics($page);

        return $this->View("/musics", [
            "musics" => $musics,
            "pagination" => $pagination,
        ]);
    }

    public function WatchPage(string $musicCode)
    {
        return $this->View("/musics/[id]");
    }

    public function Like(string $musicCode)
    {
        return $this->Component("");
    }

    public function Dislike(string $musicCode)
    {
        return $this->Component("");
    }

    public function AddWatchLater(string $musicCode)
    {
        return $this->Component("");
    }
}
