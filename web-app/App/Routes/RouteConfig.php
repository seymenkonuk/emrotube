<?php
// ============================================================================
// File:    RouteConfig.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;
use Seymen\PhpMvcTemplate\Middlewares\RateLimitMiddleware;
use Seymen\PhpMvcTemplate\Middlewares\RequestValidationMiddleware;
use Seymen\PhpMvcTemplate\Middlewares\CsrfMiddleware;
use Seymen\PhpMvcTemplate\Middlewares\ErrorHandlerMiddleware;
use Seymen\PhpMvcTemplate\Middlewares\SecurityHeadersMiddleware;


class RouteConfig
{
    public static function register()
    {
        // Route Bulunamazsa Bile Çalışacak Ortak Middleware'ler
        (new SecurityHeadersMiddleware())->Handle(function () {});
        // Route Bulunursa Çalışacak Ortak Middleware'ler
        Router::addMiddleware(new ErrorHandlerMiddleware());
        Router::addMiddleware(new RequestValidationMiddleware());
        Router::addMiddleware(new RateLimitMiddleware());
        Router::addMiddleware(new CsrfMiddleware());

        // Route'lar
        HomeRoute::register();
        AuthRoute::register();
        UserRoute::register();
        ChannelRoute::register();
        CategoryRoute::register();
        VideoRoute::register();
        ShortRoute::register();
        MusicRoute::register();
        CaptionRoute::register();
        NotificationRoute::register();
        OfflineRoute::register();
        PlaylistRoute::register();
        CommentRoute::register();
        FeedRoute::register();
        StudioRoute::register();
        SearchRoute::register();
        UploadRoute::register();
    }
}
