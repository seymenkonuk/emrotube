<?php
// ============================================================================
// File:    ErrorHandler.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Core;


class ErrorHandler
{
    static ?TemplateEngine $template = null;

    public static function getInstance()
    {
        if (self::$template === NULL) {
            self::$template = new TemplateEngine();
        }
        return self::$template;
    }

    public static function show(int $code = 404, array $data = [])
    {
        $template = self::getInstance();
        ob_get_clean();
        http_response_code($code);
        try {
            echo $template->render("Errors/$code", $data);
        } catch (TemplateException) {
        }
        exit;
    }
}
