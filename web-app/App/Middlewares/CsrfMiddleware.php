<?php
// ============================================================================
// File:    CsrfMiddleware.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Middlewares;


use Closure;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;


class CsrfMiddleware extends Controller
{
    public function Handle(Closure $next)
    {
        if (Request::getMethod() === "GET") {
            return $this->createToken($next);
        } else {
            return $this->checkToken($next);
        }
    }

    private function createToken(Closure $next)
    {
        if (Request::isCsrfTokenExpired()) {
            Request::refreshCsrfToken();
        }
        return $next();
    }

    private function checkToken(Closure $next)
    {
        $tokenFromRequest = Request::getFormBody()["csrf_token"] ?? null;
        if (!Request::validateCsrfToken($tokenFromRequest)) {
            Request::revokeCsrfToken();
            return $this->Forbidden([
                "message" => "Geçersiz veya süresi dolmuş CSRF token!",
            ]);
        }
        Request::revokeCsrfToken();
        return $next();
    }
}
