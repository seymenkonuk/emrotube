<?php
// ============================================================================
// File:    MusicService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Services;

use Seymen\PhpMvcTemplate\Config\PaginationConfig;
use Seymen\PhpMvcTemplate\DTO\MusicCardDTO;
use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\Exceptions\AuthorizationException;
use Seymen\PhpMvcTemplate\Exceptions\NotFoundException;
use Seymen\PhpMvcTemplate\Models\MediaEdit;
use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Policies\MusicPolicy;
use Seymen\PhpMvcTemplate\Repositories\MusicRepository;

class MusicService
{
    private MusicRepository $musicRepository;

    public function __construct()
    {
        $this->musicRepository = new MusicRepository();
    }

    public function getMusicEditData(string $musicCode, ?UserAuth $auth): ?MediaEdit
    {
        // Müzik Mevcut Mu
        if (!$this->musicRepository->existsByCode($musicCode)) {
            throw new NotFoundException(NotFoundException::MUSIC_NOT_FOUND_TITLE, NotFoundException::MUSIC_NOT_FOUND_DESCRIPTION);
        }

        // Müziği Düzenleme Yetkin Var Mı
        if (!MusicPolicy::canEdit($musicCode, $auth)) {
            throw new AuthorizationException(AuthorizationException::MUSIC_EDIT_PERMISSION_DENIED_TITLE, AuthorizationException::MUSIC_EDIT_PERMISSION_DENIED_DESCRIPTION);
        }

        // Müzik Bilgisini Al
        $data = $this->musicRepository->getMusicForEditing($musicCode);

        // Veriyi Döndür
        return $data;
    }

    public function getMusicsPagination(int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::MUSIC_PER_PAGE;
        $totalMusics = $this->musicRepository->getCountPublicMusics();
        $lastPage = max(1, (int) ceil($totalMusics / $perPage));

        // Geçersiz sayfa numarası
        if ($page > $lastPage) {
            throw new NotFoundException(NotFoundException::INVALID_PAGE_TITLE, NotFoundException::INVALID_PAGE_DESCRIPTION);
        }

        // Mevcut Sayfadaki Veri Adedi
        $count = ($page !== $lastPage) ? $perPage : ($totalMusics - ($lastPage - 1) * $perPage);

        // Veriyi Döndür
        return new PaginationDTO($page, $lastPage, $perPage, $count, $totalMusics);
    }

    /**
     * @return \Generator<MusicCardDTO>
     */
    public function getMusics(int $page): \Generator
    {
        // Müzikleri Al
        $perPage = PaginationConfig::MUSIC_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $musics = $this->musicRepository->getPaginatedPublicMusics($offset, $limit);

        // Veriyi Döndür
        foreach ($musics as $music) {
            yield MusicCardDTO::fromModel(
                "/musics/" . $music->code,
                "/channels/" . $music->channel_code,
                $music,
            );
        }
    }
}
