<?php
// ============================================================================
// File:    ChannelController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\ChannelService;

class ChannelController extends Controller
{
    private AuthService $authService;
    private ChannelService $channelService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->channelService = new ChannelService();
    }

    public function CreatePage()
    {
        $defaultValues = Request::getFlash("value") ?? [];
        $errorMessages = Request::getFlash("error") ?? [];

        return $this->View("/studio/channels/new", [
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
        ]);
    }

    public function Create()
    {
        return $this->LocalRedirect("/studio/channels");
    }

    public function EditPage(string $channelCode)
    {
        $auth = $this->authService->getAuth();

        $editValues = $this->channelService->getChannelEditData($channelCode, $auth);
        $formData = Request::getFlash("value") ?? [];

        $defaultValues = $editValues->mergeFromForm($formData);
        $errorMessages = Request::getFlash("error") ?? [];

        // var_dump($channelCode === $auth->channel_code);
        // return;

        return $this->View("/studio/channels/[id]/edit", [
            "channelCode" => $channelCode,
            "defaultValues" => $defaultValues,
            "errorMessages" => $errorMessages,
            "changeActiveChannelUrl" => "/studio/users/{$auth->code}/active-channel",
            "deleteUrl" => "/studio/channels/$channelCode/delete",
            "isActive" => $channelCode === $auth->channel_code,
        ]);
    }

    public function Edit(string $channelCode)
    {
        return $this->LocalRedirect("/studio/channels");
    }

    public function Delete(string $channelCode)
    {
        return $this->LocalRedirect("/studio/channels");
    }

    public function ChangeAvatar(string $channelCode)
    {
        return $this->LocalRedirect("/studio/channels");
    }

    public function ChangeBanner(string $channelCode)
    {
        return $this->LocalRedirect("/studio/channels");
    }

    public function IndexPage()
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->channelService->getChannelsPagination($page);
        $channels = $this->channelService->getChannels($page, $auth);

        return $this->View("/channels", [
            "channels" => $channels,
            "pagination" => $pagination,
        ]);
    }

    public function HomePage(string $channelCode)
    {
        $auth = $this->authService->getAuth();

        $header = $this->channelService->getChannelHeader($channelCode, $auth);

        return $this->View("/channels/[id]", [
            "header" => $header,
        ]);
    }

    public function VideosPage(string $channelCode)
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $header = $this->channelService->getChannelHeader($channelCode, $auth);
        $pagination = $this->channelService->getChannelVideosPagination($channelCode, $page);
        $videos = $this->channelService->getChannelVideos($channelCode, $page);

        return $this->View("/channels/[id]/videos", [
            "header" => $header,
            "videos" => $videos,
            "pagination" => $pagination,
        ]);
    }

    public function ShortsPage(string $channelCode)
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $header = $this->channelService->getChannelHeader($channelCode, $auth);
        $pagination = $this->channelService->getChannelShortsPagination($channelCode, $page);
        $shorts = $this->channelService->getChannelShorts($channelCode, $page);

        return $this->View("/channels/[id]/shorts", [
            "header" => $header,
            "shorts" => $shorts,
            "pagination" => $pagination,
        ]);
    }

    public function MusicsPage(string $channelCode)
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $header = $this->channelService->getChannelHeader($channelCode, $auth);
        $pagination = $this->channelService->getChannelMusicsPagination($channelCode, $page);
        $musics = $this->channelService->getChannelMusics($channelCode, $page);

        return $this->View("/channels/[id]/musics", [
            "header" => $header,
            "musics" => $musics,
            "pagination" => $pagination,
        ]);
    }

    public function PlaylistsPage(string $channelCode)
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $header = $this->channelService->getChannelHeader($channelCode, $auth);
        $pagination = $this->channelService->getChannelPlaylistsPagination($channelCode, $page);
        $playlists = $this->channelService->getChannelPlaylists($channelCode, $page);

        return $this->View("/channels/[id]/playlists", [
            "header" => $header,
            "playlists" => $playlists,
            "pagination" => $pagination,
        ]);
    }

    public function SubscriptionsPage(string $channelCode)
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $header = $this->channelService->getChannelHeader($channelCode, $auth);
        $pagination = $this->channelService->getChannelSubscriptionsPagination($channelCode, $page);
        $subscriptions = $this->channelService->getChannelSubscriptions($channelCode, $page, $auth);

        return $this->View("/channels/[id]/subscriptions", [
            "header" => $header,
            "subscriptions" => $subscriptions,
            "pagination" => $pagination,
        ]);
    }

    public function DetailsPage(string $channelCode)
    {
        $auth = $this->authService->getAuth();

        $header = $this->channelService->getChannelHeader($channelCode, $auth);
        $details = $this->channelService->getChannelDetails($channelCode);

        return $this->View("/channels/[id]/details", [
            "header" => $header,
            "details" => $details,
        ]);
    }

    public function Subscribe(string $channelCode)
    {
        return $this->Component("");
    }

    public function Unsubscribe(string $channelCode)
    {
        return $this->Component("");
    }
}
