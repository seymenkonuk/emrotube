<?php
// ============================================================================
// File:    FeedRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;
use Seymen\PhpMvcTemplate\Middlewares\RequireAuthMiddleware;


class FeedRoute
{
    public static function register()
    {
        // Index Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "feed",
            controller: "Feed",
            action: "IndexPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Channels Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "feed/channels",
            controller: "Feed",
            action: "ChannelsPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Subscriptions Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "feed/subscriptions",
            controller: "Feed",
            action: "SubscriptionsPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Comments Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "feed/comments",
            controller: "Feed",
            action: "CommentsPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Playlists Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "feed/playlists",
            controller: "Feed",
            action: "PlaylistsPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Watch Later Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "feed/watch-later",
            controller: "Feed",
            action: "WatchLaterPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // History Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "feed/history",
            controller: "Feed",
            action: "HistoryPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Liked Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "feed/liked",
            controller: "Feed",
            action: "LikedPage",
            middlewares: [new RequireAuthMiddleware()],
        );
    }
}
