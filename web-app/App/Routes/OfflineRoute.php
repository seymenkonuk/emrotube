<?php
// ============================================================================
// File:    OfflineRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;


class OfflineRoute
{
    public static function register()
    {
        // Register Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "offline",
            controller: "Offline",
            action: "IndexPage",
        );
    }
}
