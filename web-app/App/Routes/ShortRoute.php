<?php
// ============================================================================
// File:    ShortRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;
use Seymen\PhpMvcTemplate\Middlewares\FetchResponseFormatterMiddleware;
use Seymen\PhpMvcTemplate\Middlewares\RequireAuthMiddleware;


class ShortRoute
{
    public static function register()
    {
        // Create Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/shorts/new",
            controller: "Short",
            action: "CreatePage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Create
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/shorts/new",
            controller: "Short",
            action: "Create",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Edit Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/shorts/{short_code}/edit",
            controller: "Short",
            action: "EditPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Edit
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/shorts/{short_code}/edit",
            controller: "Short",
            action: "Edit",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Delete
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/shorts/{short_code}/delete",
            controller: "Short",
            action: "Delete",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Change Thumbnail
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/shorts/{short_code}/change-thumbnail",
            controller: "Short",
            action: "ChangeThumbnail",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Index Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "shorts",
            controller: "Short",
            action: "IndexPage",
        );
        // Watch Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "shorts/{short_code}",
            controller: "Short",
            action: "WatchPage",
        );
        // Like
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "shorts/{short_code}/like",
            controller: "Short",
            action: "Like",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Dislike
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "shorts/{short_code}/dislike",
            controller: "Short",
            action: "Dislike",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Watch Later
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "shorts/{short_code}/watch-later",
            controller: "Short",
            action: "AddWatchLater",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
    }
}
