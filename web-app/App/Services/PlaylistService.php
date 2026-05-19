<?php
// ============================================================================
// File:    PlaylistService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Services;

use Seymen\PhpMvcTemplate\Config\PaginationConfig;
use Seymen\PhpMvcTemplate\DTO\MediaListItemDTO;
use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\DTO\PlaylistCardDTO;
use Seymen\PhpMvcTemplate\DTO\PlaylistHeaderDTO;
use Seymen\PhpMvcTemplate\Enums\VideoType;
use Seymen\PhpMvcTemplate\Exceptions\AuthorizationException;
use Seymen\PhpMvcTemplate\Exceptions\NotFoundException;
use Seymen\PhpMvcTemplate\Models\PlaylistEdit;
use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Policies\MediaPolicy;
use Seymen\PhpMvcTemplate\Policies\PlaylistPolicy;
use Seymen\PhpMvcTemplate\Repositories\PlaylistContentRepository;
use Seymen\PhpMvcTemplate\Repositories\PlaylistRepository;

class PlaylistService
{
    private PlaylistRepository $playlistRepository;
    private PlaylistContentRepository $playlistContentRepository;

    public function __construct()
    {
        $this->playlistRepository = new PlaylistRepository();
        $this->playlistContentRepository = new PlaylistContentRepository();
    }

    public function getPlaylistEditData(string $playlistCode, ?UserAuth $auth): ?PlaylistEdit
    {
        // Oynatma Listesi Mevcut Mu
        if (!$this->playlistRepository->existsByCode($playlistCode)) {
            throw new NotFoundException(NotFoundException::PLAYLIST_NOT_FOUND_TITLE, NotFoundException::PLAYLIST_NOT_FOUND_DESCRIPTION);
        }

        // Oynatma Listesini Düzenleme Yetkin Var Mı
        if (!PlaylistPolicy::canEdit($playlistCode, $auth)) {
            throw new AuthorizationException(AuthorizationException::PLAYLIST_EDIT_PERMISSION_DENIED_TITLE, AuthorizationException::PLAYLIST_EDIT_PERMISSION_DENIED_DESCRIPTION);
        }

        // Oynatma Listesi Bilgisini Al
        $data = $this->playlistRepository->getPlaylistForEditing($playlistCode);

        // Veriyi Döndür
        return $data;
    }

    public function getPlaylistsPagination(int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::PLAYLIST_PER_PAGE;
        $totalPlaylists = $this->playlistRepository->getCountPublicPlaylists();
        $lastPage = max(1, (int) ceil($totalPlaylists / $perPage));

        // Geçersiz sayfa numarası
        if ($page > $lastPage) {
            throw new NotFoundException(NotFoundException::INVALID_PAGE_TITLE, NotFoundException::INVALID_PAGE_DESCRIPTION);
        }

        // Mevcut Sayfadaki Veri Adedi
        $count = ($page !== $lastPage) ? $perPage : ($totalPlaylists - ($lastPage - 1) * $perPage);

        // Veriyi Döndür
        return new PaginationDTO($page, $lastPage, $perPage, $count, $totalPlaylists);
    }

    /**
     * @return \Generator<PlaylistCardDTO>
     */
    public function getPlaylists(int $page): \Generator
    {
        // Oynatma Listelerini Al
        $perPage = PaginationConfig::PLAYLIST_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $playlists = $this->playlistRepository->getPaginatedPublicPlaylists($offset, $limit);

        // Veriyi Döndür
        foreach ($playlists as $playlist) {
            yield PlaylistCardDTO::fromModel(
                "/playlists/" . $playlist->code,
                "/channels/" . $playlist->channel_code,
                $playlist
            );
        }
    }

    public function getPlaylistHeader(string $playlistCode, ?UserAuth $auth): PlaylistHeaderDTO
    {
        // Oynatma Listesi Mevcut Mu
        if (!$this->playlistRepository->existsByCode($playlistCode)) {
            throw new NotFoundException(NotFoundException::PLAYLIST_NOT_FOUND_TITLE, NotFoundException::PLAYLIST_NOT_FOUND_DESCRIPTION);
        }

        // Header'ı Al
        $header = $this->playlistRepository->getPlaylistHeaderByCode($playlistCode);

        // Oynatma Listesini Görüntüleme Yetkin Var Mı
        if (!PlaylistPolicy::canView($header, $auth)) {
            throw new AuthorizationException(AuthorizationException::PRIVATE_PLAYLIST_TITLE, AuthorizationException::PRIVATE_PLAYLIST_DESCRIPTION);
        }

        // Veriyi Döndür
        return PlaylistHeaderDTO::fromModel(
            "/channels/" . $header->channel_code,
            $header
        );
    }

    public function getPlaylistContentPagination(string $playlistCode, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::PLAYLIST_CONTENT_PER_PAGE;
        $totalVideos = $this->playlistContentRepository->getCountContentByPlaylistCode($playlistCode);
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
    public function getPlaylistContent(string $playlistCode, int $page, ?UserAuth $auth): \Generator
    {
        // Videoları Al
        $perPage = PaginationConfig::PLAYLIST_CONTENT_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $videos = $this->playlistContentRepository->getPaginatedContentByPlaylistCode($playlistCode, $offset, $limit);

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
                $type->url() . "/" . $video->code . "?playlist=$playlistCode&index=$order",
                "/channels/" . $video->channel_code,
                $video
            );
        }
    }
}
