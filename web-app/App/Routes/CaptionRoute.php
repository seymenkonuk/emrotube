<?php
// ============================================================================
// File:    CaptionRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;
use Seymen\PhpMvcTemplate\Middlewares\RequireAuthMiddleware;


class CaptionRoute
{
    public static function register()
    {
        // Add To Video Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/videos/{video_code}/caption/new",
            controller: "Caption",
            action: "AddToVideoPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Add To Video
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/videos/{video_code}/caption/new",
            controller: "Caption",
            action: "AddToVideo",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Add To Short Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/shorts/{video_code}/caption/new",
            controller: "Caption",
            action: "AddToShortPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Add To Short
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/shorts/{video_code}/caption/new",
            controller: "Caption",
            action: "AddToShort",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Add To Music Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/musics/{video_code}/caption/new",
            controller: "Caption",
            action: "AddToMusicPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Add To Music
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/musics/{video_code}/caption/new",
            controller: "Caption",
            action: "AddToMusic",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Edit Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/caption/{caption_code}/edit",
            controller: "Caption",
            action: "EditPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Edit
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/caption/{caption_code}/edit",
            controller: "Caption",
            action: "Edit",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Delete
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/caption/{caption_code}/delete",
            controller: "Caption",
            action: "Delete",
            middlewares: [new RequireAuthMiddleware()],
        );
    }
}
