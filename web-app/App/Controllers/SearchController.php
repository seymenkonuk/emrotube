<?php
// ============================================================================
// File:    SearchController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\SearchService;

class SearchController extends Controller
{
    private AuthService $authService;
    private SearchService $searchService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->searchService = new SearchService();
    }

    public function IndexPage()
    {
        $search = Request::getQuery("q") ?? "";

        return $this->View("/search", [
            "search" => $search,
        ]);
    }
}
