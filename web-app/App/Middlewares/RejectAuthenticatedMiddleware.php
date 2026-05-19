<?php
// ============================================================================
// File:    RejectAuthenticatedMiddleware.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Middlewares;


use Closure;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Services\AuthService;


class RejectAuthenticatedMiddleware extends Controller
{
    private AuthService $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
    }

    public function Handle(Closure $next)
    {
        // Giriş Yapmışsa
        if ($this->authService->isLoggedIn()) {
            return $this->LocalRedirect("/");
        }
        // Giriş Yapmamışsa
        return $next();
    }
}
