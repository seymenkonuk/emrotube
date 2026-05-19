<?php
// ============================================================================
// File:    StudioController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\StudioService;

class StudioController extends Controller
{
    private AuthService $authService;
    private StudioService $studioService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->studioService = new StudioService();
    }

    public function IndexPage()
    {
        $auth = $this->authService->getAuth();
        $userCode = $auth->code;

        return $this->View("/studio", [
            "editUrl" => "/studio/users/$userCode/edit",
            "changePasswordUrl" => "/studio/users/$userCode/change-password",
            "deleteUrl" => "/studio/users/$userCode/delete",
        ]);
    }

    public function ChannelsPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->studioService->getMyChannelsPagination($auth, $page);
        $channels = $this->studioService->getMyChannels($auth, $page);

        return $this->View("/studio/channels", [
            "channels" => $channels,
            "pagination" => $pagination,
        ]);
    }

    public function VideosPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->studioService->getMyVideosPagination($auth, $page);
        $videos = $this->studioService->getMyVideos($auth, $page);

        return $this->View("/studio/videos", [
            "videos" => $videos,
            "pagination" => $pagination,
        ]);
    }

    public function ShortsPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->studioService->getMyShortsPagination($auth, $page);
        $shorts = $this->studioService->getMyShorts($auth, $page);

        return $this->View("/studio/shorts", [
            "shorts" => $shorts,
            "pagination" => $pagination,
        ]);
    }

    public function MusicsPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->studioService->getMyMusicsPagination($auth, $page);
        $musics = $this->studioService->getMyMusics($auth, $page);

        return $this->View("/studio/musics", [
            "musics" => $musics,
            "pagination" => $pagination,
        ]);
    }

    public function PlaylistsPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->studioService->getMyPlaylistsPagination($auth, $page);
        $playlists = $this->studioService->getMyPlaylists($auth, $page);

        return $this->View("/studio/playlists", [
            "playlists" => $playlists,
            "pagination" => $pagination,
        ]);
    }
}
