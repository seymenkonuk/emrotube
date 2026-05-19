<?php
// ============================================================================
// File:    Controller.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Core;


class Controller
{
    private TemplateEngine $template;

    public function __construct()
    {
        $this->template = new TemplateEngine();
    }

    public function View(?string $viewName = null, array $data = [])
    {
        // View Name Boş ise Varsayılanı Bul Getir (Kendi Adındakini)
        if ($viewName === null) {
            ["controller" => $controller, "action" => $action] = Router::getControllerAction();
            $viewName = DIRECTORY_SEPARATOR . "$controller" . DIRECTORY_SEPARATOR . "$action";
        }
        // Print
        try {
            $message = $this->template->render("Pages" . $viewName . "/index", $data);
            return $this->Print($message);
        } catch (TemplateException) {
            return $this->NotFound();
        }
    }

    public function Component(string $componentName, array $data = [])
    {
        try {
            $message = $this->template->render("Components" . $componentName, $data);
            return $this->Print($message);
        } catch (TemplateException) {
            return $this->NotFound();
        }
    }

    public function Error(int $statusCode, array $data = [])
    {
        try {
            $message = $this->template->render("Errors/" . $statusCode, $data);
            http_response_code($statusCode);
            return $this->Print($message);
        } catch (TemplateException) {
            ErrorHandler::show(404, $data);
        }
    }

    public function Redirect(string $url, string $message = "")
    {
        // Validate URL
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return $this->LocalRedirect("/", $message);
        }
        header("Location: $url");
        return $this->Print($message);
    }

    public function LocalRedirect(string $path, string $message = "")
    {
        // Validate Path
        $parts = parse_url(trim($path));
        if (isset($parts['scheme']) || isset($parts['host'])) {
            return $this->LocalRedirect("/", $message);
        }
        header("Location: $path");
        return $this->Print($message);
    }

    public function Json(array $data)
    {
        return $this->Print(json_encode($data, JSON_UNESCAPED_UNICODE), "application/json");
    }

    public function JsonSuccess(string $message, array $data)
    {
        return $this->Json([
            "success" => true,
            "message" => $message,
            "data" => $data
        ]);
    }

    public function JsonFail(string $message, array $error)
    {
        return $this->Json([
            "success" => false,
            "message" => $message,
            "error" => $error
        ]);
    }

    public function Content(string $text, string $contentType = "plain/text")
    {
        return $this->Print($text, $contentType);
    }

    public function File(string $path, string $contentType)
    {
        if (!is_file($path)) {
            return $this->NotFound();
        }
        $content = file_get_contents($path);
        return $this->Print($content, $contentType);
    }

    public function StreamFile(string $path, string $contentType)
    {
        if (!is_file($path)) {
            return $this->NotFound();
        }

        $size = filesize($path);
        $start = 0;
        $end = $size - 1;
        $length = $size;

        if (
            isset($_SERVER['HTTP_RANGE']) &&
            preg_match('/bytes=(\d+)-(\d*)/', $_SERVER['HTTP_RANGE'], $matches)
        ) {
            $start = intval($matches[1]);
            if (!empty($matches[2])) {
                $end = intval($matches[2]);
            }
            $length = $end - $start + 1;
            header("HTTP/1.1 206 Partial Content");
        } else {
            header("HTTP/1.1 200 OK");
        }

        header("Content-Type: $contentType");
        header("Accept-Ranges: bytes");
        header("Content-Length: $length");
        header("Content-Range: bytes $start-$end/$size");

        $fp = fopen($path, 'rb');
        fseek($fp, $start);

        $bufferSize = 8192; // 8 KiB
        while (!feof($fp) && ftell($fp) <= $end) {
            echo fread($fp, $bufferSize);
            ob_flush();
            flush();
        }

        fclose($fp);
        return ob_get_clean();
    }

    public function StatusCode(int $code, array $data = [])
    {
        return $this->Error($code, $data);
    }

    public function EmptyResult()
    {
        return $this->StatusCode(204);
    }

    public function BadRequest(array $data = [])
    {
        return $this->StatusCode(400, $data);
    }

    public function Unauthorized(array $data = [])
    {
        return $this->StatusCode(401, $data);
    }

    public function Forbidden(array $data = [])
    {
        return $this->StatusCode(403, $data);
    }

    public function NotFound(array $data = [])
    {
        return $this->StatusCode(404, $data);
    }

    public function TooManyRequests(array $data = [])
    {
        return $this->StatusCode(429, $data);
    }

    public function InternalServerError(array $data = [])
    {
        return $this->StatusCode(500, $data);
    }

    private function Print(string $message, string $contentType = "text/html")
    {
        ob_get_clean();
        header("Content-Type: $contentType");
        return $message;
    }
}
