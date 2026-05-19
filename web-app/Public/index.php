<?php
// ============================================================================
// File:    index.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

session_set_cookie_params([
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_name("SESSION");
session_start();
// session_regenerate_id(true); // bunun yerine gerekli zamanlarda yeniden üretiliyor

require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "vendor" . DIRECTORY_SEPARATOR . "autoload.php");

use Seymen\PhpMvcTemplate\Config\AppConfig;
use Seymen\PhpMvcTemplate\Core\ErrorHandler;
use Seymen\PhpMvcTemplate\Core\Router;
use Seymen\PhpMvcTemplate\Routes\RouteConfig;

ob_start();

// hata ayıklama için bütün errorleri detaylıca raporla
if (AppConfig::DEBUG) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

try {
    RouteConfig::register();
    echo Router::dispatch();
} catch (\Throwable $th) {
    // hata ayıklama için bütün errorleri detaylıca raporla
    if (AppConfig::DEBUG) {
        ErrorHandler::show(500, [
            "message" => $th->getMessage() . "|" . $th->getFile() . "|" . $th->getLine()
        ]);
    } else {
        ErrorHandler::show(500);
    }
}
