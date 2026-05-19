<?php
// ============================================================================
// File:    MusicRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;
use Seymen\PhpMvcTemplate\Middlewares\FetchResponseFormatterMiddleware;
use Seymen\PhpMvcTemplate\Middlewares\RequireAuthMiddleware;


class MusicRoute
{
    public static function register()
    {
        // Create Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/musics/new",
            controller: "Music",
            action: "CreatePage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Create
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/musics/new",
            controller: "Music",
            action: "Create",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Edit Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/musics/{music_code}/edit",
            controller: "Music",
            action: "EditPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Edit
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/musics/{music_code}/edit",
            controller: "Music",
            action: "Edit",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Delete
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/musics/{music_code}/delete",
            controller: "Music",
            action: "Delete",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Change Thumbnail
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/musics/{music_code}/change-thumbnail",
            controller: "Music",
            action: "ChangeThumbnail",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Index Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "musics",
            controller: "Music",
            action: "IndexPage",
        );
        // Watch Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "musics/{music_code}",
            controller: "Music",
            action: "WatchPage",
        );
        // Like
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "musics/{music_code}/like",
            controller: "Music",
            action: "Like",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Dislike
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "musics/{music_code}/dislike",
            controller: "Music",
            action: "Dislike",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Watch Later
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "musics/{music_code}/watch-later",
            controller: "Music",
            action: "AddWatchLater",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
    }
}
