<?php
// ============================================================================
// File:    StudioRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;
use Seymen\PhpMvcTemplate\Middlewares\RequireAuthMiddleware;


class StudioRoute
{
    public static function register()
    {
        // Index Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio",
            controller: "Studio",
            action: "IndexPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Channels Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/channels",
            controller: "Studio",
            action: "ChannelsPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Videos Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/videos",
            controller: "Studio",
            action: "VideosPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Shorts Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/shorts",
            controller: "Studio",
            action: "ShortsPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Musics Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/musics",
            controller: "Studio",
            action: "MusicsPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Playlists Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/playlists",
            controller: "Studio",
            action: "PlaylistsPage",
            middlewares: [new RequireAuthMiddleware()],
        );
    }
}
