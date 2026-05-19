<?php
// ============================================================================
// File:    AuthRoute.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Routes;


use Seymen\PhpMvcTemplate\Core\Router;
use Seymen\PhpMvcTemplate\Middlewares\RejectAuthenticatedMiddleware;
use Seymen\PhpMvcTemplate\Middlewares\RequireAuthMiddleware;


class AuthRoute
{
    public static function register()
    {
        // Register Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "register",
            controller: "Auth",
            action: "RegisterPage",
            middlewares: [new RejectAuthenticatedMiddleware()],
        );
        // Register
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "register",
            controller: "Auth",
            action: "Register",
            middlewares: [new RejectAuthenticatedMiddleware()],
        );
        // Login Page
        Router::addRoute(
            method: Router::GET_METHOD,
            url: "login",
            controller: "Auth",
            action: "LoginPage",
            middlewares: [new RejectAuthenticatedMiddleware()],
        );
        // Login
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "login",
            controller: "Auth",
            action: "Login",
            middlewares: [new RejectAuthenticatedMiddleware()],
        );
        // Logout
        Router::addRoute(
            method: Router::POST_METHOD,
            url: "logout",
            controller: "Auth",
            action: "Logout",
            middlewares: [new RequireAuthMiddleware()],
        );
    }
}
