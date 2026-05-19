<?php
// ============================================================================
// File:    RequireAuthMiddleware.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Middlewares;


use Closure;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Services\AuthService;


class RequireAuthMiddleware extends Controller
{
    private AuthService $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
    }

    public function Handle(Closure $next)
    {
        // Giriş Yapmamışsa
        if (!$this->authService->isLoggedIn()) {
            // GET metodu ise, login'e yönlendir ve redirect uri ekle
            if (Request::getMethod() == "GET") {
                return $this->LocalRedirect(
                    "/login?redirect_uri=" . $_SERVER["REQUEST_URI"],
                    $this->Unauthorized(),
                );
            } else {
                return $this->Unauthorized();
            }
        }
        // Giriş Yapmışsa
        return $next();
    }
}
