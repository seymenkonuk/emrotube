<?php
// ============================================================================
// File:    VideoRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;
use Seymen\PhpMvcTemplate\Middlewares\FetchResponseFormatterMiddleware;
use Seymen\PhpMvcTemplate\Middlewares\RequireAuthMiddleware;


class VideoRoute
{
    public static function register()
    {
        // Create Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/videos/new",
            controller: "Video",
            action: "CreatePage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Create
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/videos/new",
            controller: "Video",
            action: "Create",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Edit Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/videos/{video_code}/edit",
            controller: "Video",
            action: "EditPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Edit
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/videos/{video_code}/edit",
            controller: "Video",
            action: "Edit",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Delete
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/videos/{video_code}/delete",
            controller: "Video",
            action: "Delete",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Change Thumbnail
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/videos/{video_code}/change-thumbnail",
            controller: "Video",
            action: "ChangeThumbnail",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Index Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "videos",
            controller: "Video",
            action: "IndexPage",
        );
        // Watch Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "videos/{video_code}",
            controller: "Video",
            action: "WatchPage",
        );
        // Like
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "videos/{video_code}/like",
            controller: "Video",
            action: "Like",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Dislike
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "videos/{video_code}/dislike",
            controller: "Video",
            action: "Dislike",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Watch Later
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "videos/{video_code}/watch-later",
            controller: "Video",
            action: "AddWatchLater",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
    }
}
