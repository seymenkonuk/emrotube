<?php
// ============================================================================
// File:    UserRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;
use Seymen\PhpMvcTemplate\Middlewares\RequireAuthMiddleware;


class UserRoute
{
    public static function register()
    {
        // Edit Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/users/{user_code}/edit",
            controller: "User",
            action: "EditPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Edit
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/users/{user_code}/edit",
            controller: "User",
            action: "Edit",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Change Password Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "studio/users/{user_code}/change-password",
            controller: "User",
            action: "ChangePasswordPage",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Change Password
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/users/{user_code}/change-password",
            controller: "User",
            action: "ChangePassword",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Delete
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/users/{user_code}/delete",
            controller: "User",
            action: "Delete",
            middlewares: [new RequireAuthMiddleware()],
        );
        // Change Active Channel
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "studio/users/{user_code}/active-channel",
            controller: "User",
            action: "ChangeActiveChannel",
            middlewares: [new RequireAuthMiddleware()],
        );
    }
}
