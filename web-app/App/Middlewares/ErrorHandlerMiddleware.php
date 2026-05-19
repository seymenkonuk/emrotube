<?php
// ============================================================================
// File:    ErrorHandlerMiddleware.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Middlewares;


use Closure;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Exceptions\AuthorizationException;
use Seymen\PhpMvcTemplate\Exceptions\NotFoundException;
use Seymen\PhpMvcTemplate\Exceptions\ValidationException;


class ErrorHandlerMiddleware extends Controller
{
    public function Handle(Closure $next)
    {
        try {
            return $next();
        }
        // 
        catch (ValidationException $error) {
            Request::setFlash("error", $error->getErrors());
            Request::setFlash("value", $error->getValues());
            return $this->LocalRedirect(
                $error->getRedirectUri(),
                $this->BadRequest(),
            );
        }
        // 
        catch (NotFoundException $error) {
            return $this->NotFound($error->getErrors());
        }
        // 
        catch (AuthorizationException $error) {
            return $this->Forbidden($error->getErrors());
        }
        // //
        // catch (\Throwable $th) {
        //     return $this->InternalServerError();
        // }
    }
}
