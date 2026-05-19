<?php
// ============================================================================
// File:    ShortService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Services;

use Seymen\PhpMvcTemplate\Config\PaginationConfig;
use Seymen\PhpMvcTemplate\DTO\ShortCardDTO;
use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\Exceptions\AuthorizationException;
use Seymen\PhpMvcTemplate\Exceptions\NotFoundException;
use Seymen\PhpMvcTemplate\Models\MediaEdit;
use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Policies\ShortPolicy;
use Seymen\PhpMvcTemplate\Repositories\ShortRepository;

class ShortService
{
    private ShortRepository $shortRepository;

    public function __construct()
    {
        $this->shortRepository = new ShortRepository();
    }

    public function getShortEditData(string $shortCode, ?UserAuth $auth): ?MediaEdit
    {
        // Kısa Video Mevcut Mu
        if (!$this->shortRepository->existsByCode($shortCode)) {
            throw new NotFoundException(NotFoundException::SHORT_NOT_FOUND_TITLE, NotFoundException::SHORT_NOT_FOUND_DESCRIPTION);
        }

        // Kısa Videoyu Düzenleme Yetkin Var Mı
        if (!ShortPolicy::canEdit($shortCode, $auth)) {
            throw new AuthorizationException(AuthorizationException::SHORT_EDIT_PERMISSION_DENIED_TITLE, AuthorizationException::SHORT_EDIT_PERMISSION_DENIED_DESCRIPTION);
        }

        // Kısa Video Bilgisini Al
        $data = $this->shortRepository->getShortForEditing($shortCode);

        // Veriyi Döndür
        return $data;
    }

    public function getShortsPagination(int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::SHORT_PER_PAGE;
        $totalShorts = $this->shortRepository->getCountPublicShorts();
        $lastPage = max(1, (int) ceil($totalShorts / $perPage));

        // Geçersiz sayfa numarası
        if ($page > $lastPage) {
            throw new NotFoundException(NotFoundException::INVALID_PAGE_TITLE, NotFoundException::INVALID_PAGE_DESCRIPTION);
        }

        // Mevcut Sayfadaki Veri Adedi
        $count = ($page !== $lastPage) ? $perPage : ($totalShorts - ($lastPage - 1) * $perPage);

        // Veriyi Döndür
        return new PaginationDTO($page, $lastPage, $perPage, $count, $totalShorts);
    }

    /**
     * @return \Generator<ShortCardDTO>
     */
    public function getShorts(int $page): \Generator
    {
        // Kısa Videoları Al
        $perPage = PaginationConfig::SHORT_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $shorts = $this->shortRepository->getPaginatedPublicShorts($offset, $limit);

        // Veriyi Döndür
        foreach ($shorts as $short) {
            yield ShortCardDTO::fromModel(
                "/shorts/" . $short->code,
                "/channels/" . $short->channel_code,
                $short,
            );
        }
    }
}
