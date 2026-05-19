<?php
// ============================================================================
// File:    StudioService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Services;

use Seymen\PhpMvcTemplate\Config\PaginationConfig;
use Seymen\PhpMvcTemplate\DTO\ChannelListItemDTO;
use Seymen\PhpMvcTemplate\DTO\MediaListItemDTO;
use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\DTO\PlaylistListItemDTO;
use Seymen\PhpMvcTemplate\Exceptions\NotFoundException;
use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Repositories\ChannelRepository;
use Seymen\PhpMvcTemplate\Repositories\MusicRepository;
use Seymen\PhpMvcTemplate\Repositories\PlaylistRepository;
use Seymen\PhpMvcTemplate\Repositories\ShortRepository;
use Seymen\PhpMvcTemplate\Repositories\VideoRepository;

class StudioService
{
    private ChannelRepository $channelRepository;
    private VideoRepository $videoRepository;
    private ShortRepository $shortRepository;
    private MusicRepository $musicRepository;
    private PlaylistRepository $playlistRepository;

    public function __construct()
    {
        $this->channelRepository = new ChannelRepository();
        $this->videoRepository = new VideoRepository();
        $this->shortRepository = new ShortRepository();
        $this->musicRepository = new MusicRepository();
        $this->playlistRepository = new PlaylistRepository();
    }

    // KANALLARIM

    public function getMyChannelsPagination(?UserAuth $auth, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::STUDIO_CHANNEL_PER_PAGE;
        $totalPlaylists = $this->channelRepository->getCountMyChannelsByUserCode($auth->code);
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
     * @return \Generator<ChannelListItemDTO>
     */
    public function getMyChannels(?UserAuth $auth, int $page): \Generator
    {
        // Oynatma Listelerini Al
        $perPage = PaginationConfig::STUDIO_CHANNEL_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $channels = $this->channelRepository->getPaginatedMyChannelsByUserCode($auth->code, $offset, $limit);

        // Veriyi Döndür
        foreach ($channels as $channel) {
            yield ChannelListItemDTO::fromModel(
                null,
                "/studio/channels/" . $channel->code . "/edit",
                $channel
            );
        }
    }

    //  VİDEOLARIM

    public function getMyVideosPagination(?UserAuth $auth, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::STUDIO_VIDEO_PER_PAGE;
        $totalVideos = $this->videoRepository->getCountMyVideosByChannelCode($auth->channel_code);
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
     * @return \Generator<MediaListItemDTO>
     */
    public function getMyVideos(?UserAuth $auth, int $page): \Generator
    {
        // Videoları Al
        $perPage = PaginationConfig::STUDIO_VIDEO_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $videos = $this->videoRepository->getPaginatedMyVideosByChannelCode($auth->channel_code, $offset, $limit);

        // Veriyi Döndür
        foreach ($videos as $video) {
            yield MediaListItemDTO::fromModel(
                null,
                "/studio/videos/" . $video->code . "/edit",
                "/channels/" . $video->channel_code,
                $video
            );
        }
    }

    // KISA VİDEOLARIM

    public function getMyShortsPagination(?UserAuth $auth, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::STUDIO_SHORT_PER_PAGE;
        $totalShorts = $this->shortRepository->getCountMyShortsByChannelCode($auth->channel_code);
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
     * @return \Generator<MediaListItemDTO>
     */
    public function getMyShorts(?UserAuth $auth, int $page): \Generator
    {
        // Kısa Videoları Al
        $perPage = PaginationConfig::STUDIO_SHORT_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $shorts = $this->shortRepository->getPaginatedMyShortsByChannelCode($auth->channel_code, $offset, $limit);

        // Veriyi Döndür
        foreach ($shorts as $short) {
            yield MediaListItemDTO::fromModel(
                null,
                "/studio/shorts/" . $short->code . "/edit",
                "/channels/" . $short->channel_code,
                $short
            );
        }
    }

    // MÜZİKLERİM

    public function getMyMusicsPagination(?UserAuth $auth, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::STUDIO_MUSIC_PER_PAGE;
        $totalMusics = $this->musicRepository->getCountMyMusicsByChannelCode($auth->channel_code);
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
     * @return \Generator<MediaListItemDTO>
     */
    public function getMyMusics(?UserAuth $auth, int $page): \Generator
    {
        // Müzikleri Al
        $perPage = PaginationConfig::STUDIO_MUSIC_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $musics = $this->musicRepository->getPaginatedMyMusicsByChannelCode($auth->channel_code, $offset, $limit);

        // Veriyi Döndür
        foreach ($musics as $music) {
            yield MediaListItemDTO::fromModel(
                null,
                "/studio/musics/" . $music->code . "/edit",
                "/channels/" . $music->channel_code,
                $music
            );
        }
    }

    // OYNATMA LİSTELERİM

    public function getMyPlaylistsPagination(?UserAuth $auth, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::STUDIO_PLAYLIST_PER_PAGE;
        $totalPlaylists = $this->playlistRepository->getCountMyPlaylistsByChannelCode($auth->channel_code);
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
     * @return \Generator<PlaylistListItemDTO>
     */
    public function getMyPlaylists(?UserAuth $auth, int $page): \Generator
    {
        // Oynatma Listelerini Al
        $perPage = PaginationConfig::STUDIO_PLAYLIST_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $playlists = $this->playlistRepository->getPaginatedMyPlaylistsByChannelCode($auth->channel_code, $offset, $limit);

        // Veriyi Döndür
        foreach ($playlists as $playlist) {
            yield PlaylistListItemDTO::fromModel(
                null,
                "/studio/playlists/" . $playlist->code . "/edit",
                "/channels/" . $playlist->channel_code,
                $playlist
            );
        }
    }
}
