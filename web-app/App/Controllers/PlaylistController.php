<?php
// ============================================================================
// File:    PlaylistController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Helpers\OptionListHelper;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\PlaylistService;

class PlaylistController extends Controller
{
    private AuthService $authService;
    private PlaylistService $playlistService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->playlistService = new PlaylistService();
    }

    public function CreatePage()
    {
        $viewTypes = OptionListHelper::getViewTypeOptions();
        $defaultValues = Request::getFlash("value") ?? [];
        $errorMessages = Request::getFlash("error") ?? [];

        return $this->View("/studio/playlists/new", [
            "viewTypes" => $viewTypes,
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
        ]);
    }

    public function Create()
    {
        return $this->LocalRedirect("/studio/playlists");
    }

    public function EditPage(string $playlistCode)
    {
        $auth = $this->authService->getAuth();

        $editValues = $this->playlistService->getPlaylistEditData($playlistCode, $auth);
        $formData = Request::getFlash("value") ?? [];


        $viewTypes = OptionListHelper::getViewTypeOptions();
        $defaultValues = $editValues->mergeFromForm($formData);
        $errorMessages = Request::getFlash("error") ?? [];

        return $this->View("/studio/playlists/[id]/edit", [
            "viewTypes" => $viewTypes,
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
            "deleteUrl" => "/studio/playlists/$playlistCode/delete",
        ]);
    }

    public function Edit(string $playlistCode)
    {
        return $this->LocalRedirect("/studio/playlists");
    }

    public function Delete(string $playlistCode)
    {
        return $this->LocalRedirect("/studio/playlists");
    }

    public function ChangeBanner(string $playlistCode)
    {
        return $this->LocalRedirect("/studio/playlists");
    }

    public function IndexPage()
    {
        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->playlistService->getPlaylistsPagination($page);
        $playlists = $this->playlistService->getPlaylists($page);

        return $this->View("/playlists", [
            "playlists" => $playlists,
            "pagination" => $pagination,
        ]);
    }

    public function HomePage(string $playlistCode)
    {

        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $header = $this->playlistService->getPlaylistHeader($playlistCode, $auth);
        $pagination = $this->playlistService->getPlaylistContentPagination($playlistCode, $page);
        $videos = $this->playlistService->getPlaylistContent($playlistCode, $page, $auth);

        return $this->View("/playlists/[id]", [
            "header" => $header,
            "videos" => $videos,
            "pagination" => $pagination,
        ]);
    }

    public function RemoveItem(string $playlistCode, int $itemId)
    {
        return $this->Component("");
    }

    public function AddVideo(string $videoCode)
    {
        return $this->Component("");
    }

    public function AddShort(string $shortCode)
    {
        return $this->Component("");
    }

    public function AddMusic(string $musicCode)
    {
        return $this->Component("");
    }
}
