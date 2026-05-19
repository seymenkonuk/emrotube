<?php
// ============================================================================
// File:    ChannelService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Services;

use Seymen\PhpMvcTemplate\Config\PaginationConfig;
use Seymen\PhpMvcTemplate\DTO\ChannelCardDTO;
use Seymen\PhpMvcTemplate\DTO\ChannelDetailsDTO;
use Seymen\PhpMvcTemplate\DTO\ChannelHeaderDTO;
use Seymen\PhpMvcTemplate\DTO\MusicCardDTO;
use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\DTO\PlaylistCardDTO;
use Seymen\PhpMvcTemplate\DTO\ShortCardDTO;
use Seymen\PhpMvcTemplate\DTO\VideoCardDTO;
use Seymen\PhpMvcTemplate\Exceptions\AuthorizationException;
use Seymen\PhpMvcTemplate\Exceptions\NotFoundException;
use Seymen\PhpMvcTemplate\Models\ChannelEdit;
use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Policies\ChannelPolicy;
use Seymen\PhpMvcTemplate\Repositories\ChannelRepository;
use Seymen\PhpMvcTemplate\Repositories\MusicRepository;
use Seymen\PhpMvcTemplate\Repositories\PlaylistRepository;
use Seymen\PhpMvcTemplate\Repositories\ShortRepository;
use Seymen\PhpMvcTemplate\Repositories\SubscriptionRepository;
use Seymen\PhpMvcTemplate\Repositories\VideoRepository;

class ChannelService
{
    private ChannelRepository $channelRepository;
    private VideoRepository $videoRepository;
    private ShortRepository $shortRepository;
    private MusicRepository $musicRepository;
    private PlaylistRepository $playlistRepository;
    private SubscriptionRepository $subscriptionRepository;

    public function __construct()
    {
        $this->channelRepository = new ChannelRepository();
        $this->videoRepository = new VideoRepository();
        $this->shortRepository = new ShortRepository();
        $this->musicRepository = new MusicRepository();
        $this->playlistRepository = new PlaylistRepository();
        $this->subscriptionRepository = new SubscriptionRepository();
    }

    public function getChannelEditData(string $channelCode, ?UserAuth $auth): ?ChannelEdit
    {
        // Kanal Mevcut Mu
        if (!$this->channelRepository->existsByCode($channelCode)) {
            throw new NotFoundException(NotFoundException::CHANNEL_NOT_FOUND_TITLE, NotFoundException::CHANNEL_NOT_FOUND_DESCRIPTION);
        }

        // Kanalı Düzenleme Yetkin Var Mı
        if (!ChannelPolicy::canEdit($channelCode, $auth)) {
            throw new AuthorizationException(AuthorizationException::CHANNEL_EDIT_PERMISSION_DENIED_TITLE, AuthorizationException::CHANNEL_EDIT_PERMISSION_DENIED_DESCRIPTION);
        }

        // Kanal Bilgisini Al
        $data = $this->channelRepository->getChannelForEditing($channelCode);

        // Veriyi Döndür
        return $data;
    }

    public function getChannelsPagination(int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::CHANNEL_PER_PAGE;
        $totalChannels = $this->channelRepository->getCountChannels();
        $lastPage = max(1, (int) ceil($totalChannels / $perPage));

        // Geçersiz sayfa numarası
        if ($page > $lastPage) {
            throw new NotFoundException(NotFoundException::INVALID_PAGE_TITLE, NotFoundException::INVALID_PAGE_DESCRIPTION);
        }

        // Mevcut Sayfadaki Veri Adedi
        $count = ($page !== $lastPage) ? $perPage : ($totalChannels - ($lastPage - 1) * $perPage);

        // Veriyi Döndür
        return new PaginationDTO($page, $lastPage, $perPage, $count, $totalChannels);
    }

    /**
     * @return \Generator<ChannelCardDTO>
     */
    public function getChannels(int $page, ?UserAuth $auth): \Generator
    {
        // Kanalları Al
        $perPage = PaginationConfig::CHANNEL_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $channels = $this->channelRepository->getPaginatedChannels($auth, $offset, $limit);

        // Veriyi Döndür
        foreach ($channels as $channel) {
            yield ChannelCardDTO::fromModel(
                "/channels/" . $channel->code,
                $channel
            );
        }
    }

    public function getChannelHeader(string $channelCode, ?UserAuth $auth): ChannelHeaderDTO
    {
        // Kanal Mevcut Mu
        if (!$this->channelRepository->existsByCode($channelCode)) {
            throw new NotFoundException(NotFoundException::CHANNEL_NOT_FOUND_TITLE, NotFoundException::CHANNEL_NOT_FOUND_DESCRIPTION);
        }

        // Header'ı Al
        $header = $this->channelRepository->getChannelHeaderByCode($channelCode, $auth);

        // Veriyi Döndür
        return ChannelHeaderDTO::fromModel(
            "/channels/" . $header->code,
            $header
        );
    }

    // KANAL VİDEOLARI

    public function getChannelVideosPagination(string $channelCode, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::CHANNEL_VIDEO_PER_PAGE;
        $totalVideos = $this->videoRepository->getCountPublicVideosByChannelCode($channelCode);
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
    public function getChannelVideos(string $channelCode, int $page): \Generator
    {
        // Videoları Al
        $perPage = PaginationConfig::CHANNEL_VIDEO_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $videos = $this->videoRepository->getPaginatedPublicVideosByChannelCode($channelCode, $offset, $limit);

        // Veriyi Döndür
        foreach ($videos as $video) {
            yield VideoCardDTO::fromModel(
                "/videos/" . $video->code,
                "/channels/" . $video->channel_code,
                $video
            );
        }
    }

    // KANAL KISA VİDEOLARI

    public function getChannelShortsPagination(string $channelCode, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::CHANNEL_SHORT_PER_PAGE;
        $totalShorts = $this->shortRepository->getCountPublicShortsByChannelCode($channelCode);
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
    public function getChannelShorts(string $channelCode, int $page): \Generator
    {
        // Kısa Videoları Al
        $perPage = PaginationConfig::CHANNEL_SHORT_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $shorts = $this->shortRepository->getPaginatedPublicShortsByChannelCode($channelCode, $offset, $limit);

        // Veriyi Döndür
        foreach ($shorts as $short) {
            yield ShortCardDTO::fromModel(
                "/shorts/" . $short->code,
                "/channels/" . $short->channel_code,
                $short
            );
        }
    }

    // KANAL MÜZİKLERİ

    public function getChannelMusicsPagination(string $channelCode, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::CHANNEL_MUSIC_PER_PAGE;
        $totalMusics = $this->musicRepository->getCountPublicMusicsByChannelCode($channelCode);
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
    public function getChannelMusics(string $channelCode, int $page): \Generator
    {
        // Müzikleri Al
        $perPage = PaginationConfig::CHANNEL_MUSIC_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $musics = $this->musicRepository->getPaginatedPublicMusicsByChannelCode($channelCode, $offset, $limit);

        // Veriyi Döndür
        foreach ($musics as $music) {
            yield MusicCardDTO::fromModel(
                "/musics/" . $music->code,
                "/channels/" . $music->channel_code,
                $music
            );
        }
    }

    // KANAL OYNATMA LİSTELERİ

    public function getChannelPlaylistsPagination(string $channelCode, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::CHANNEL_PLAYLIST_PER_PAGE;
        $totalPlaylists = $this->playlistRepository->getCountPublicPlaylistsByChannelCode($channelCode);
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
    public function getChannelPlaylists(string $channelCode, int $page): \Generator
    {
        // Oynatma Listelerini Al
        $perPage = PaginationConfig::CHANNEL_PLAYLIST_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $playlists = $this->playlistRepository->getPaginatedPublicPlaylistsByChannelCode($channelCode, $offset, $limit);

        // Veriyi Döndür
        foreach ($playlists as $playlist) {
            yield PlaylistCardDTO::fromModel(
                "/playlists/" . $playlist->code,
                "/channels/" . $playlist->channel_code,
                $playlist
            );
        }
    }

    // KANAL DETAYLARI

    public function getChannelDetails(string $channelCode): ChannelDetailsDTO
    {
        // Detaylar'ı Al
        $details = $this->channelRepository->getChannelDetailsByCode($channelCode);

        // Veriyi Döndür
        return ChannelDetailsDTO::fromModel($details);
    }

    // KANAL ABONELİKLERİ

    public function getChannelSubscriptionsPagination(string $channelCode, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::CHANNEL_CHANNEL_PER_PAGE;
        $totalChannels = $this->subscriptionRepository->getCountSubscribedChannelsByChannelCode($channelCode);
        $lastPage = max(1, (int) ceil($totalChannels / $perPage));

        // Geçersiz sayfa numarası
        if ($page > $lastPage) {
            throw new NotFoundException(NotFoundException::INVALID_PAGE_TITLE, NotFoundException::INVALID_PAGE_DESCRIPTION);
        }

        // Mevcut Sayfadaki Veri Adedi
        $count = ($page !== $lastPage) ? $perPage : ($totalChannels - ($lastPage - 1) * $perPage);

        // Veriyi Döndür
        return new PaginationDTO($page, $lastPage, $perPage, $count, $totalChannels);
    }

    public function getChannelSubscriptions(string $channelCode, int $page, ?UserAuth $auth): \Generator
    {
        // Kategorileri Al
        $perPage = PaginationConfig::CHANNEL_CHANNEL_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $channels = $this->subscriptionRepository->getPaginatedSubscribedChannelsByChannelCode($channelCode, $offset, $limit, $auth);

        // Veriyi Döndür
        foreach ($channels as $channel) {
            yield ChannelCardDTO::fromModel(
                "/channels/" . $channel->code,
                $channel
            );
        }
    }
}
