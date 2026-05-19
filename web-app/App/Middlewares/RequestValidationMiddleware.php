<?php
// ============================================================================
// File:    RequestValidationMiddleware.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Middlewares;


use Closure;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\ErrorHandler;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Core\Validator\Validator;
use Seymen\PhpMvcTemplate\Core\Validator\InvalidTemplateFormatError;
use Seymen\PhpMvcTemplate\Exceptions\ValidationException;


class RequestValidationMiddleware extends Controller
{
    public function Handle(Closure $next)
    {
        // İstekte Gelen Veriyi ve Gelmesi Beklenen Veriyi Al
        $request = Request::getRequest();
        $scheme = Request::getScheme();
        // Veriyi Kontrol Et
        try {
            $error = Validator::validateData($scheme, $request);
        } catch (InvalidTemplateFormatError) {
            ErrorHandler::show(500);
        }
        // Hata Varsa
        if ($error) {
            // Get İsteğiyse
            if (Request::getMethod() === "GET") {
                return $this->BadRequest();
            } else {
                throw new ValidationException($error, $request, $_SERVER["REQUEST_URI"]);
            }
        }
        // Hata Yoksa
        return $next();
    }
}
