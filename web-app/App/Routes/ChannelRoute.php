<?php
// ============================================================================
// File:    ChannelRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;
use Seymen\PhpMvcTemplate\Middlewares\FetchResponseFormatterMiddleware;
use Seymen\PhpMvcTemplate\Middlewares\RequireAuthMiddleware;


class ChannelRoute
{
    public static function register()
    {
        // Create Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/channels/new",
            controller: "Channel",
            action: "CreatePage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Create
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/channels/new",
            controller: "Channel",
            action: "Create",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Edit Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/channels/{channel_code}/edit",
            controller: "Channel",
            action: "EditPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Edit
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/channels/{channel_code}/edit",
            controller: "Channel",
            action: "Edit",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Delete
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/channels/{channel_code}/delete",
            controller: "Channel",
            action: "Delete",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Change Avatar
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/channels/{channel_code}/change-avatar",
            controller: "Channel",
            action: "ChangeAvatar",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Change Banner
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/channels/{channel_code}/change-banner",
            controller: "Channel",
            action: "ChangeBanner",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Index Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "channels",
            controller: "Channel",
            action: "IndexPage",
        );
        // Home Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "channels/{channel_code}",
            controller: "Channel",
            action: "HomePage",
        );
        // Videos Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "channels/{channel_code}/videos",
            controller: "Channel",
            action: "VideosPage",
        );
        // Shorts Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "channels/{channel_code}/shorts",
            controller: "Channel",
            action: "ShortsPage",
        );
        // Musics Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "channels/{channel_code}/musics",
            controller: "Channel",
            action: "MusicsPage",
        );
        // Playlists Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "channels/{channel_code}/playlists",
            controller: "Channel",
            action: "PlaylistsPage",
        );
        // Subscriptions Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "channels/{channel_code}/subscriptions",
            controller: "Channel",
            action: "SubscriptionsPage",
        );
        // Details Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "channels/{channel_code}/details",
            controller: "Channel",
            action: "DetailsPage",
        );
        // Subscribe
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "channels/{channel_code}/subscribe",
            controller: "Channel",
            action: "Subscribe",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Subscribe
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "channels/{channel_code}/unsubscribe",
            controller: "Channel",
            action: "Unsubscribe",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
    }
}
