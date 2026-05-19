<?php
// ============================================================================
// File:    CategoryRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;


class CategoryRoute
{
    public static function register()
    {
        // Index Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "categories",
            controller: "Category",
            action: "IndexPage",
        );
        // Home Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "categories/{category_code}",
            controller: "Category",
            action: "HomePage",
        );
    }
}
