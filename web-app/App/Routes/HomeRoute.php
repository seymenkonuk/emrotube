<?php
// ============================================================================
// File:    HomeRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;


class HomeRoute
{
    public static function register()
    {
        // Index Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "",
            controller: "Home",
            action: "IndexPage",
        );
        // Ping
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "ping",
            controller: "Home",
            action: "Ping",
        );
    }
}
