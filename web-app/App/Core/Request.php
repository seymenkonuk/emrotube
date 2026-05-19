<?php
// ============================================================================
// File:    Request.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Core;


class Request
{
    public static function getMethod(): string
    {
        return mb_strtoupper($_SERVER['REQUEST_METHOD'], "UTF-8");
    }

    public static function getEndpoint(): string
    {
        // Domain name is example
        $result = parse_url("https://recepseymenkonuk.com" . $_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return $result;
    }

    public static function getHeaders(): false|array
    {
        return getallheaders();
    }

    public static function getHeader(string $header)
    {
        return self::getHeaders()[$header] ?? null;
    }

    public static function getCookies(): array
    {
        return $_COOKIE;
    }

    public static function getCookie(string $cookie)
    {
        return self::getCookies()[$cookie] ?? null;
    }

    public static function getUserIP()
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        return filter_var($ipAddress, FILTER_VALIDATE_IP) ? $ipAddress : null;
    }

    public static function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? null;
    }

    public static function getBody()
    {
        return file_get_contents("php://input");
    }

    public static function getJsonBody()
    {
        return json_decode(self::getBody(), true);
    }

    public static function getFormBody()
    {
        return $_POST;
    }

    public static function getQueries()
    {
        return $_GET;
    }

    public static function getQuery(string $name)
    {
        return self::getQueries()[$name] ?? null;
    }

    public static function getParams()
    {
        return Router::getControllerAction()["parameters"];
    }

    public static function getFiles()
    {
        return $_FILES;
    }

    public static function getFile(string $fileName)
    {
        return self::getFiles()[$fileName] ?? null;
    }

    // REQUEST AND SCHEMES
    public static function getRequest()
    {
        $scheme = self::getScheme();
        return [
            "body" => Request::getFormBody(),
            "query" => Request::getQueries(),
            "params" => array_combine(
                array_keys($scheme["params"]),
                Request::getParams(),
            ),
            "files" => Request::getFiles(),
        ];
    }

    public static function getScheme()
    {
        ["controller" => $controller, "action" => $action] = Router::getControllerAction();

        // Scheme Bulunamazsa
        $scheme = "Seymen\\PhpMvcTemplate\\Schemes\\" . $controller . "\\" . $action . "Scheme";
        if (!class_exists($scheme)) {
            ErrorHandler::show(500);
        }
        $scheme = new $scheme();

        // Body Scheme
        $body = [];
        if (method_exists($scheme, "Body")) {
            $body = $scheme->Body();
        }
        // Query Scheme
        $query = [];
        if (method_exists($scheme, "Query")) {
            $query = $scheme->Query();
        }
        // Params Scheme
        $params = [];
        if (method_exists($scheme, "Params")) {
            $params = $scheme->Params();
        }
        // Files Scheme
        $files = [];
        if (method_exists($scheme, "Files")) {
            $files = $scheme->Files();
        }

        // Return
        return [
            "body" => $body,
            "query" => $query,
            "params" => $params,
            "files" => $files,
        ];
    }

    // FLASH
    public static function setFlash(string $key, $message)
    {
        $_SESSION["flash"][$key] = $message;
    }

    public static function getFlash(string $key)
    {
        if (isset($_SESSION['flash'][$key])) {
            $message = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $message;
        }
        return null;
    }

    // CSRF TOKEN
    public static function getCsrfToken()
    {
        return $_SESSION["csrf_token"]["value"] ?? null;
    }

    public static function refreshCsrfToken()
    {
        $_SESSION["csrf_token"] = [
            "value" => Database::generateToken(32),
            "expires" => time() + 60 * 60,
        ];
    }

    public static function revokeCsrfToken()
    {
        unset($_SESSION["csrf_token"]);
    }

    public static function isCsrfTokenExpired(): bool
    {
        if (!isset($_SESSION["csrf_token"])) {
            return true;
        }
        $expires = $_SESSION["csrf_token"]["expires"] ?? 0;
        return time() > $expires;
    }

    public static function validateCsrfToken(?string $token)
    {
        // Null check
        if ($token === null) {
            return false;
        }

        $storedToken = self::getCsrfToken();

        if (self::isCsrfTokenExpired()) {
            return false;
        }

        // Zamanlama Saldırıları için === yerine hash_equals kullanıldı
        return hash_equals($storedToken, $token);
    }
}
