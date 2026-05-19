<?php
// ============================================================================
// File:    SearchRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;


class SearchRoute
{
    public static function register()
    {
        // Index Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "search",
            controller: "Search",
            action: "IndexPage",
        );
    }
}
