<?php
// ============================================================================
// File:    VideoService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Services;

use Seymen\PhpMvcTemplate\Config\PaginationConfig;
use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\DTO\VideoCardDTO;
use Seymen\PhpMvcTemplate\Exceptions\AuthorizationException;
use Seymen\PhpMvcTemplate\Exceptions\NotFoundException;
use Seymen\PhpMvcTemplate\Models\MediaEdit;
use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Policies\VideoPolicy;
use Seymen\PhpMvcTemplate\Repositories\VideoRepository;

class VideoService
{
    private VideoRepository $videoRepository;

    public function __construct()
    {
        $this->videoRepository = new VideoRepository();
    }

    public function getVideoEditData(string $videoCode, ?UserAuth $auth): ?MediaEdit
    {
        // Video Mevcut Mu
        if (!$this->videoRepository->existsByCode($videoCode)) {
            throw new NotFoundException(NotFoundException::VIDEO_NOT_FOUND_TITLE, NotFoundException::VIDEO_NOT_FOUND_DESCRIPTION);
        }

        // Videoyu Düzenleme Yetkin Var Mı
        if (!VideoPolicy::canEdit($videoCode, $auth)) {
            throw new AuthorizationException(AuthorizationException::VIDEO_EDIT_PERMISSION_DENIED_TITLE, AuthorizationException::VIDEO_EDIT_PERMISSION_DENIED_DESCRIPTION);
        }

        // Video Bilgisini Al
        $data = $this->videoRepository->getVideoForEditing($videoCode);

        // Veriyi Döndür
        return $data;
    }

    public function getVideosPagination(int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::VIDEO_PER_PAGE;
        $totalVideos = $this->videoRepository->getCountPublicVideos();
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
     * @return \Generator<VideoCardDTO>
     */
    public function getVideos(int $page): \Generator
    {
        // Videoları Al
        $perPage = PaginationConfig::VIDEO_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $videos = $this->videoRepository->getPaginatedPublicVideos($offset, $limit);

        // Veriyi Döndür
        foreach ($videos as $video) {
            yield VideoCardDTO::fromModel(
                "/videos/" . $video->code,
                "/channels/" . $video->channel_code,
                $video,
            );
        }
    }
}
