<?php
// ============================================================================
// File:    FeedController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\FeedService;

class FeedController extends Controller
{
    private AuthService $authService;
    private FeedService $feedService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->feedService = new FeedService();
    }

    public function IndexPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->feedService->getFeedPagination($auth, $page);
        $videos = $this->feedService->getFeed($auth, $page);

        return $this->View("/feed", [
            "videos" => $videos,
            "pagination" => $pagination,
        ]);
    }

    public function ChannelsPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->feedService->getSubscriptionsPagination($auth, $page);
        $channels = $this->feedService->getSubscriptions($auth, $page);

        return $this->View("/feed/channels", [
            "channels" => $channels,
            "pagination" => $pagination,
        ]);
    }

    public function SubscriptionsPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->feedService->getSubscriptionVideosPagination($auth, $page);
        $videos = $this->feedService->getSubscriptionVideos($auth, $page);

        return $this->View("/feed/subscriptions", [
            "videos" => $videos,
            "pagination" => $pagination,
        ]);
    }

    public function CommentsPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->feedService->getCommentsPagination($auth, $page);
        $comments = $this->feedService->getComments($auth, $page);

        return $this->View("/feed/comments", [
            "comments" => $comments,
            "pagination" => $pagination,
        ]);
    }

    public function PlaylistsPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->feedService->getPlaylistsPagination($auth, $page);
        $playlists = $this->feedService->getPlaylists($auth, $page);

        return $this->View("/feed/playlists", [
            "playlists" => $playlists,
            "pagination" => $pagination,
        ]);
    }

    public function WatchLaterPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $header = $this->feedService->getWatchLaterHeader($auth);
        $pagination = $this->feedService->getWatchLaterPagination($auth, $page);
        $videos = $this->feedService->getWatchLater($auth, $page);

        return $this->View("/feed/watch-later", [
            "header" => $header,
            "videos" => $videos,
            "pagination" => $pagination,
        ]);
    }

    public function HistoryPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $header = $this->feedService->getHistoryHeader($auth);
        $pagination = $this->feedService->getHistoryPagination($auth, $page);
        $videos = $this->feedService->getHistory($auth, $page);

        return $this->View("/feed/history", [
            "header" => $header,
            "videos" => $videos,
            "pagination" => $pagination,
        ]);
    }

    public function LikedPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $header = $this->feedService->getLikedHeader($auth);
        $pagination = $this->feedService->getLikedPagination($auth, $page);
        $videos = $this->feedService->getLiked($auth, $page);

        return $this->View("/feed/liked", [
            "header" => $header,
            "videos" => $videos,
            "pagination" => $pagination,
        ]);
    }
}
