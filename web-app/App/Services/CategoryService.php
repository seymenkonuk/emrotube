<?php
// ============================================================================
// File:    CategoryService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Services;

use Seymen\PhpMvcTemplate\Config\PaginationConfig;
use Seymen\PhpMvcTemplate\DTO\CategoryCardDTO;
use Seymen\PhpMvcTemplate\DTO\CategoryHeaderDTO;
use Seymen\PhpMvcTemplate\DTO\MediaListItemDTO;
use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\Enums\VideoType;
use Seymen\PhpMvcTemplate\Exceptions\NotFoundException;
use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Policies\MediaPolicy;
use Seymen\PhpMvcTemplate\Repositories\CategoryRepository;
use Seymen\PhpMvcTemplate\Repositories\CategoryContentRepository;

class CategoryService
{
    private CategoryRepository $categoryRepository;
    private CategoryContentRepository $categoryContentRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
        $this->categoryContentRepository = new CategoryContentRepository();
    }

    public function getCategoriesPagination(int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::CATEGORY_PER_PAGE;
        $totalCategories = $this->categoryRepository->getCountPublicCategories();
        $lastPage = max(1, (int) ceil($totalCategories / $perPage));

        // Geçersiz sayfa numarası
        if ($page > $lastPage) {
            throw new NotFoundException(NotFoundException::INVALID_PAGE_TITLE, NotFoundException::INVALID_PAGE_DESCRIPTION);
        }

        // Mevcut Sayfadaki Veri Adedi
        $count = ($page !== $lastPage) ? $perPage : ($totalCategories - ($lastPage - 1) * $perPage);

        // Veriyi Döndür
        return new PaginationDTO($page, $lastPage, $perPage, $count, $totalCategories);
    }

    /**
     * @return \Generator<CategoryCardDTO>
     */
    public function getCategories(int $page): \Generator
    {
        // Kategorileri Al
        $perPage = PaginationConfig::CATEGORY_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $categories = $this->categoryRepository->getPaginatedPublicCategories($offset, $limit);

        // Veriyi Döndür
        foreach ($categories as $category) {
            yield CategoryCardDTO::fromModel(
                "/categories/" . $category->code,
                $category,
            );
        }
    }

    public function getCategoryHeader(string $categoryCode): CategoryHeaderDTO
    {
        // Kategori Mevcut Mu
        if (!$this->categoryRepository->existsByCode($categoryCode)) {
            throw new NotFoundException(NotFoundException::CATEGORY_NOT_FOUND_TITLE, NotFoundException::CATEGORY_NOT_FOUND_DESCRIPTION);
        }

        // Header'ı Al
        $header = $this->categoryRepository->getCategoryHeaderByCode($categoryCode);

        // Veriyi Döndür
        return CategoryHeaderDTO::fromModel($header);
    }

    public function getCategoryContentPagination(string $categoryCode, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::CATEGORY_CONTENT_PER_PAGE;
        $totalVideos = $this->categoryContentRepository->getCountContentByCategoryCode($categoryCode);
        $lastPage = max(1, (int) ceil($totalVideos / $perPage));

        // Geçersiz sayfa numarası
        if ($page > $lastPage) {
            throw new NotFoundException(NotFoundException::INVALID_PAGE_TITLE, NotFoundException::INVALID_PAGE_DESCRIPTION);
        }

        // Mevcut Sayfadaki Veri Adedi
        $count = ($page !== $lastPage) ? $perPage : ($totalVideos - ($lastPage - 1) * $perPage);

        // Veriyi Döndür
        return new PaginationDTO($page, $lastPage, $perPage, $count, $totalVideos);
    }

    /**
     * @return \Generator<?MediaListItemDTO>
     */
    public function getCategoryContent(string $categoryCode, int $page, ?UserAuth $auth): \Generator
    {
        // Videoları Al
        $perPage = PaginationConfig::CATEGORY_CONTENT_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $videos = $this->categoryContentRepository->getPaginatedContentByCategoryCode($categoryCode, $offset, $limit);

        // Veriyi Döndür
        foreach ($videos as $index => $video) {
            // Görüntüleme Yetkin Yok
            if (!MediaPolicy::canView($video, $auth)) {
                yield null;
                continue;
            }
            // Yetkin Var Görüntüleyebilirsin
            $order = strval($offset + $index + 1);
            $type = VideoType::from($video->type);
            yield MediaListItemDTO::fromModel(
                $order,
                $type->url() . "/" . $video->code,
                "/channels/" . $video->channel_code,
                $video
            );
        }
    }
}
