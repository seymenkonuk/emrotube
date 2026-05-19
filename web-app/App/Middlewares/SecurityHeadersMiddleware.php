<?php
// ============================================================================
// File:    SecurityHeadersMiddleware.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Middlewares;


use Closure;

use Seymen\PhpMvcTemplate\Core\Controller;


class SecurityHeadersMiddleware extends Controller
{
    public function Handle(Closure $next)
    {
        // Bilgi sızdıran başlıkları kaldır
        header_remove('Server');

        // Güvenlik başlıklarını ekle
        header('X-Frame-Options: DENY');
        header('X-Content-Type-Options: nosniff');
        header('Referrer-Policy: no-referrer');
        header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
        header('Strict-Transport-Security: max-age=63072000; includeSubDomains; preload');

        return $next();
    }
}
