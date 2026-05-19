<?php
// ============================================================================
// File:    HomeController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\HomeService;

class HomeController extends Controller
{
    private AuthService $authService;
    private HomeService $homeService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->homeService = new HomeService();
    }

    public function IndexPage()
    {
        return $this->View("");
    }

    public function Ping()
    {
        return $this->Content("pong");
    }
}
