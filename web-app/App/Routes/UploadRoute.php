<?php
// ============================================================================
// File:    UploadRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;


class UploadRoute
{
    public static function register()
    {
        // Get Channel Banner Image
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "uploads/channels/{channel_code}/banners/{file_name}",
            controller: "Upload",
            action: "GetChannelBanner",
            placeholders: ["file_name" => "\w+\.\w+"],
        );
        // Get Channel Avatar Image
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "uploads/channels/{channel_code}/avatars/{file_name}",
            controller: "Upload",
            action: "GetChannelAvatar",
            placeholders: ["file_name" => "\w+\.\w+"],
        );
        // Get Playlist Banner Image
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "uploads/playlists/{playlist_code}/banners/{file_name}",
            controller: "Upload",
            action: "GetPlaylistBanner",
            placeholders: ["file_name" => "\w+\.\w+"],
        );
        // Get Video File
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "uploads/videos/{video_code}/{file_name}",
            controller: "Upload",
            action: "GetVideoFile",
            placeholders: ["file_name" => "\w+\.\w+"],
        );
        // Get Video Thumbnail Image
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "uploads/videos/{video_code}/thumbnails/{file_name}",
            controller: "Upload",
            action: "GetVideoThumbnail",
            placeholders: ["file_name" => "\w+\.\w+"],
        );
        // Get Video Caption Image
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "uploads/videos/{video_code}/captions/{file_name}",
            controller: "Upload",
            action: "GetVideoCaption",
            placeholders: ["file_name" => "\w+\.\w+"],
        );
        // Get Short File
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "uploads/shorts/{short_code}/{file_name}",
            controller: "Upload",
            action: "GetShortFile",
            placeholders: ["file_name" => "\w+\.\w+"],
        );
        // Get Short Thumbnail Image
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "uploads/shorts/{short_code}/thumbnails/{file_name}",
            controller: "Upload",
            action: "GetShortThumbnail",
            placeholders: ["file_name" => "\w+\.\w+"],
        );
        // Get Short Caption Image
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "uploads/shorts/{short_code}/captions/{file_name}",
            controller: "Upload",
            action: "GetShortCaption",
            placeholders: ["file_name" => "\w+\.\w+"],
        );
        // Get Music File
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "uploads/musics/{music_code}/{file_name}",
            controller: "Upload",
            action: "GetMusicFile",
            placeholders: ["file_name" => "\w+\.\w+"],
        );
        // Get Music Thumbnail Image
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "uploads/musics/{music_code}/thumbnails/{file_name}",
            controller: "Upload",
            action: "GetMusicThumbnail",
            placeholders: ["file_name" => "\w+\.\w+"],
        );
        // Get Music Caption Image
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "uploads/musics/{music_code}/captions/{file_name}",
            controller: "Upload",
            action: "GetMusicCaption",
            placeholders: ["file_name" => "\w+\.\w+"],
        );
        // Get Categories Banner Image
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "uploads/categories/{category_code}/banners/{file_name}",
            controller: "Upload",
            action: "GetCategoryBanner",
            placeholders: ["file_name" => "\w+\.\w+"],
        );
    }
}
