<?php
// ============================================================================
// File:    NotificationRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;


class NotificationRoute
{
    public static function register()
    {
        // Register Page
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "notifications/subscribe",
            controller: "Notification",
            action: "Subscribe",
        );
    }
}
