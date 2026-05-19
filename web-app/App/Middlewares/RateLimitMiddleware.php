<?php
// ============================================================================
// File:    RateLimitMiddleware.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Middlewares;


use Closure;
use Predis;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;


class RateLimitMiddleware extends Controller
{
    protected Predis\Client $redis;

    public function __construct()
    {
        parent::__construct();
        $this->redis = new Predis\Client();
    }

    public function Handle(Closure $next)
    {
        $ip = Request::getUserIP();
        $endpoint = Request::getEndpoint();
        $method = Request::getMethod();

        // Aynı IP Adresi 60 saniye içinde 200 adet istek yapabilir
        if (!$this->rateLimitCheck("rate_limit:ip:$ip", 200, 60)) {
            return $this->TooManyRequests();
        }

        // Aynı IP adresi Aynı Endpointe 60 saniye içinde 50 adet istek yapabilir
        if (!$this->rateLimitCheck("rate_limit:$endpoint:$ip", 50, 60)) {
            return $this->TooManyRequests();
        }

        // Aynı IP adresi 60 saniye içinde 5 adet "POST /login" isteği yapabilir
        if ($endpoint === "/login" && $method == "POST") {
            if (!$this->rateLimitCheck("rate_limit:login:$ip", 5, 60, 300)) {
                return $this->TooManyRequests();
            }
        }

        // Aynı IP adresi 60 saniye içinde 3 adet "POST /register" isteği yapabilir
        elseif ($endpoint === "/register" && $method == "POST") {
            if (!$this->rateLimitCheck("rate_limit:register:$ip", 3, 60, 300)) {
                return $this->TooManyRequests();
            }
        }

        return $next();
    }

    protected function rateLimitCheck(string $key, int $limit, int $ttl, int $banDuration = 0): bool
    {
        $banKey = "ban:$key";

        // Eğer kullanıcı banlıysa
        if ($this->redis->exists($banKey)) {
            return false;
        }

        // Sayacı arttır
        $current = $this->redis->incr($key);
        if ($current === 1) {
            $this->redis->expire($key, $ttl);
        }

        // Eğer Çok Fazla İstek Yapıldıysa
        if ($current > $limit) {
            // Eğer ban süresi ayarlandıysa, sayacı sil ve ban uygula
            if ($banDuration > 0) {
                $this->redis->del($key);
                $this->redis->setex($banKey, $banDuration, 1);
            }
            return false;
        }

        return true;
    }
}
