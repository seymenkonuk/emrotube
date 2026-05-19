<?php
// ============================================================================
// File:    FetchResponseFormatterMiddleware.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Middlewares;


use Closure;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;


class FetchResponseFormatterMiddleware extends Controller
{
    public function Handle(Closure $next)
    {
        $response = $next();

        // Yeni CSRF Token Üret
        Request::refreshCsrfToken();

        // Token'ı Al
        $csrfToken = Request::getCsrfToken();

        // Formatlayıp Gönder
        return $this->Json([
            "html" => $response,
            "csrf_token" => $csrfToken,
        ]);
    }
}
