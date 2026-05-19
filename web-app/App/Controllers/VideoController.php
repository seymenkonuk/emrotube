<?php
// ============================================================================
// File:    VideoController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Helpers\OptionListHelper;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\VideoService;

class VideoController extends Controller
{
    private AuthService $authService;
    private VideoService $videoService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->videoService = new VideoService();
    }

    public function CreatePage()
    {
        $viewTypes = OptionListHelper::getViewTypeOptions();
        $commentTypes = OptionListHelper::getCommentTypeOptions();
        $defaultValues = Request::getFlash("value") ?? [];
        $errorMessages = Request::getFlash("error") ?? [];

        return $this->View("/studio/videos/new", [
            "viewTypes" => $viewTypes,
            "commentTypes" => $commentTypes,
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
        ]);
    }

    public function Create()
    {
        return $this->LocalRedirect("/studio/videos");
    }

    public function EditPage(string $videoCode)
    {
        $auth = $this->authService->getAuth();

        $editValues = $this->videoService->getVideoEditData($videoCode, $auth);
        $formData = Request::getFlash("value") ?? [];

        $viewTypes = OptionListHelper::getViewTypeOptions();
        $commentTypes = OptionListHelper::getCommentTypeOptions();
        $defaultValues = $editValues->mergeFromForm($formData);
        $errorMessages = Request::getFlash("error") ?? [];

        return $this->View("/studio/videos/[id]/edit", [
            "viewTypes" => $viewTypes,
            "commentTypes" => $commentTypes,
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
            "deleteUrl" => "/studio/videos/$videoCode/delete",
        ]);
    }

    public function Edit(string $videoCode)
    {
        return $this->LocalRedirect("/studio/videos");
    }

    public function Delete(string $videoCode)
    {
        return $this->LocalRedirect("/studio/videos");
    }

    public function ChangeThumbnail(string $videoCode)
    {
        return $this->LocalRedirect("/studio/videos");
    }

    public function IndexPage()
    {
        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->videoService->getVideosPagination($page);
        $videos = $this->videoService->getVideos($page);

        return $this->View("/videos", [
            "videos" => $videos,
            "pagination" => $pagination,
        ]);
    }

    public function WatchPage(string $videoCode)
    {
        return $this->View("/videos/[id]");
    }

    public function Like(string $videoCode)
    {
        return $this->Component("");
    }

    public function Dislike(string $videoCode)
    {
        return $this->Component("");
    }

    public function AddWatchLater(string $videoCode)
    {
        return $this->Component("");
    }
}
