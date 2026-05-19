<?php
// ============================================================================
// File:    CategoryController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Core\Request;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\CategoryService;

class CategoryController extends Controller
{
    private AuthService $authService;
    private CategoryService $categoryService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->categoryService = new CategoryService();
    }

    public function IndexPage()
    {
        $page = Request::getQuery("page") ?? 1;

        $pagination = $this->categoryService->getCategoriesPagination($page);
        $categories = $this->categoryService->getCategories($page);

        return $this->View("/categories", [
            "categories" => $categories,
            "pagination" => $pagination,
        ]);
    }

    public function HomePage(string $categoryCode)
    {
        $auth = $this->authService->getAuth();

        $page = Request::getQuery("page") ?? 1;

        $header = $this->categoryService->getCategoryHeader($categoryCode);
        $pagination = $this->categoryService->getCategoryContentPagination($categoryCode, $page);
        $videos = $this->categoryService->getCategoryContent($categoryCode, $page, $auth);

        return $this->View("/categories/[id]", [
            "header" => $header,
            "videos" => $videos,
            "pagination" => $pagination,
        ]);
    }
}
