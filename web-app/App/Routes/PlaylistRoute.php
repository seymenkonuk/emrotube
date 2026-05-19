<?php
// ============================================================================
// File:    PlaylistRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;
use Seymen\PhpMvcTemplate\Middlewares\FetchResponseFormatterMiddleware;
use Seymen\PhpMvcTemplate\Middlewares\RequireAuthMiddleware;


class PlaylistRoute
{
    public static function register()
    {
        // Create Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/playlists/new",
            controller: "Playlist",
            action: "CreatePage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Create
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/playlists/new",
            controller: "Playlist",
            action: "Create",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Edit Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/playlists/{playlist_code}/edit",
            controller: "Playlist",
            action: "EditPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Edit
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/playlists/{playlist_code}/edit",
            controller: "Playlist",
            action: "Edit",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Delete
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/playlists/{playlist_code}/delete",
            controller: "Playlist",
            action: "Delete",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Change Banner
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/playlists/{playlist_code}/change-banner",
            controller: "Playlist",
            action: "ChangeBanner",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Index Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "playlists",
            controller: "Playlist",
            action: "IndexPage",
        );
        // Home Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "playlists/{playlist_code}",
            controller: "Playlist",
            action: "HomePage",
        );
        // Remove Item
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "playlists/{playlist_code}/remove/{item_id}",
            controller: "Playlist",
            action: "RemoveItem",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Add Video
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "videos/{video_code}/addlist",
            controller: "Playlist",
            action: "AddVideo",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Add Short
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "shorts/{short_code}/addlist",
            controller: "Playlist",
            action: "AddShort",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
        // Add Music
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "musics/{music_code}/addlist",
            controller: "Playlist",
            action: "AddMusic",
            middlewares: [new RequireAuthMiddleware(), new FetchResponseFormatterMiddleware()],
        );
    }
}
