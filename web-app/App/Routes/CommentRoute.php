<?php
// ============================================================================
// File:    CommentRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;
use Seymen\PhpMvcTemplate\Middlewares\FetchResponseFormatterMiddleware;
use Seymen\PhpMvcTemplate\Middlewares\RequireAuthMiddleware;


class CommentRoute
{
    public static function register()
    {
        // Create
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "videos/{video_code}/comment",
            controller: "Comment",
            action: "AddToVideo",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Create
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "shorts/{short_code}/comment",
            controller: "Comment",
            action: "AddToShort",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Create
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "musics/{music_code}/comment",
            controller: "Comment",
            action: "AddToMusic",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Edit
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "comments/{comment_code}/edit",
            controller: "Comment",
            action: "Edit",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Delete
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "comments/{comment_code}/delete",
            controller: "Comment",
            action: "Delete",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Like
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "comments/{comment_code}/like",
            controller: "Comment",
            action: "Like",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Dislike
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "comments/{comment_code}/dislike",
            controller: "Comment",
            action: "Dislike",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
    }
}
