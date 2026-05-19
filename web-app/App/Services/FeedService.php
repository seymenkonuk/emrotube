<?php
// ============================================================================
// File:    FeedService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Services;

use Seymen\PhpMvcTemplate\Config\PaginationConfig;
use Seymen\PhpMvcTemplate\DTO\ChannelCardDTO;
use Seymen\PhpMvcTemplate\DTO\HistoryHeaderDTO;
use Seymen\PhpMvcTemplate\DTO\LikedHeaderDTO;
use Seymen\PhpMvcTemplate\DTO\MediaListItemDTO;
use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\DTO\PlaylistCardDTO;
use Seymen\PhpMvcTemplate\DTO\WatchLaterHeaderDTO;
use Seymen\PhpMvcTemplate\Enums\VideoType;
use Seymen\PhpMvcTemplate\Exceptions\NotFoundException;
use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Policies\MediaPolicy;
use Seymen\PhpMvcTemplate\Repositories\HistoryRepository;
use Seymen\PhpMvcTemplate\Repositories\LikedRepository;
use Seymen\PhpMvcTemplate\Repositories\PlaylistRepository;
use Seymen\PhpMvcTemplate\Repositories\SubscriptionRepository;
use Seymen\PhpMvcTemplate\Repositories\WatchLaterRepository;

class FeedService
{
    private SubscriptionRepository $subscriptionRepository;
    private PlaylistRepository $playlistRepository;
    private WatchLaterRepository $watchLaterRepository;
    private HistoryRepository $historyRepository;
    private LikedRepository $likedRepository;

    public function __construct()
    {
        $this->subscriptionRepository = new SubscriptionRepository();
        $this->playlistRepository = new PlaylistRepository();
        $this->watchLaterRepository = new WatchLaterRepository();
        $this->historyRepository = new HistoryRepository();
        $this->likedRepository = new LikedRepository();
    }

    public function getFeedPagination(?UserAuth $auth, int $page): PaginationDTO
    {
        return new PaginationDTO(1, 1, 0, 0, 0);
    }

    public function getFeed(?UserAuth $auth, int $page): \Generator
    {
        yield from [];
    }

    public function getSubscriptionsPagination(?UserAuth $auth, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::FEED_CHANNEL_PER_PAGE;
        $totalChannels = $this->subscriptionRepository->getCountMySubscribedChannelsByChannelCode($auth);
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

    public function getSubscriptions(?UserAuth $auth, int $page): \Generator
    {
        // Kanalları Al
        $perPage = PaginationConfig::FEED_CHANNEL_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $channels = $this->subscriptionRepository->getPaginatedMySubscribedChannelsByChannelCode($auth, $offset, $limit);

        // Veriyi Döndür
        foreach ($channels as $channel) {
            yield ChannelCardDTO::fromModel(
                "/channels/" . $channel->code,
                $channel
            );
        }
    }

    public function getSubscriptionVideosPagination(?UserAuth $auth, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::FEED_SUBSCRIPTION_CONTENT_PER_PAGE;
        $totalVideos = $this->subscriptionRepository->getCountPublicContentBySubscriberCode($auth->channel_code);
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

    public function getSubscriptionVideos(?UserAuth $auth, int $page): \Generator
    {
        // Videoları Al
        $perPage = PaginationConfig::FEED_SUBSCRIPTION_CONTENT_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $videos = $this->subscriptionRepository->getPaginatedPublicContentBySubscriberCode($auth->channel_code, $offset, $limit);

        // Veriyi Döndür
        foreach ($videos as $video) {
            // Görüntüleme Yetkin Yok
            if (!MediaPolicy::canView($video, $auth)) {
                continue;
            }
            // Yetkin Var Görüntüleyebilirsin
            $type = VideoType::from($video->type);
            yield MediaListItemDTO::fromModel(
                null,
                $type->url() . "/" . $video->code,
                "/channels/" . $video->channel_code,
                $video
            );
        }
    }

    public function getCommentsPagination(?UserAuth $auth, int $page): PaginationDTO
    {
        return new PaginationDTO(1, 1, 1, 0, 0);
    }

    public function getComments(?UserAuth $auth, int $page): \Generator
    {
        yield from [];
    }

    public function getPlaylistsPagination(?UserAuth $auth, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::FEED_PLAYLIST_PER_PAGE;
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
     * @return \Generator<PlaylistCardDTO>
     */
    public function getPlaylists(?UserAuth $auth, int $page): \Generator
    {
        // Oynatma Listelerini Al
        $perPage = PaginationConfig::FEED_PLAYLIST_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $playlists = $this->playlistRepository->getPaginatedMyPlaylistsByChannelCode($auth->channel_code, $offset, $limit);

        // Veriyi Döndür
        foreach ($playlists as $playlist) {
            yield PlaylistCardDTO::fromModel(
                "/playlists/" . $playlist->code,
                "/channels/" . $playlist->channel_code,
                $playlist
            );
        }
    }

    public function getWatchLaterHeader(?UserAuth $auth): WatchLaterHeaderDTO
    {
        // Header'ı Al
        $header = $this->watchLaterRepository->getWatchLaterHeaderByChannelCode($auth->channel_code);

        // Veriyi Döndür
        return WatchLaterHeaderDTO::fromModel($header);
    }

    public function getWatchLaterPagination(?UserAuth $auth, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::WATCH_LATER_CONTENT_PER_PAGE;
        $totalVideos = $this->watchLaterRepository->getCountContentFromWatchLater($auth->channel_code);
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

    public function getWatchLater(?UserAuth $auth, int $page): \Generator
    {
        // Videoları Al
        $perPage = PaginationConfig::WATCH_LATER_CONTENT_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $videos = $this->watchLaterRepository->getPaginatedContentFromWatchLater($auth->channel_code, $offset, $limit);

        // Videoları Düzenle
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
                $type->url() . "/" . $video->code . "?playlist=WL&index=$order",
                "/channels/" . $video->channel_code,
                $video
            );
        }

        // Veriyi Döndür
        yield from [];
    }

    public function getHistoryHeader(?UserAuth $auth): HistoryHeaderDTO
    {
        // Header'ı Al
        $header = $this->historyRepository->getHistoryHeaderByChannelCode($auth->channel_code);

        // Veriyi Döndür
        return HistoryHeaderDTO::fromModel($header);
    }

    public function getHistoryPagination(?UserAuth $auth, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::HISTORY_CONTENT_PER_PAGE;
        $totalVideos = $this->historyRepository->getCountContentFromHistory($auth->channel_code);
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

    public function getHistory(?UserAuth $auth, int $page): \Generator
    {
        // Videoları Al
        $perPage = PaginationConfig::HISTORY_CONTENT_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $videos = $this->historyRepository->getPaginatedContentFromHistory($auth->channel_code, $offset, $limit);

        // Videoları Düzenle
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
                $type->url() . "/" . $video->code . "?playlist=HL&index=$order",
                "/channels/" . $video->channel_code,
                $video
            );
        }

        // Veriyi Döndür
        yield from [];
    }

    public function getLikedHeader(?UserAuth $auth): LikedHeaderDTO
    {
        // Header'ı Al
        $header = $this->likedRepository->getLikedHeaderByChannelCode($auth->channel_code);

        // Veriyi Döndür
        return LikedHeaderDTO::fromModel($header);
    }

    public function getLikedPagination(?UserAuth $auth, int $page): PaginationDTO
    {
        // Son Sayfa Numarasını Bul
        $perPage = PaginationConfig::LIKED_CONTENT_PER_PAGE;
        $totalVideos = $this->likedRepository->getCountContentFromLiked($auth->channel_code);
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

    public function getLiked(?UserAuth $auth, int $page): \Generator
    {
        // Videoları Al
        $perPage = PaginationConfig::LIKED_CONTENT_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;
        $videos = $this->likedRepository->getPaginatedContentFromLiked($auth->channel_code, $offset, $limit);

        // Videoları Düzenle
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
                $type->url() . "/" . $video->code . "?playlist=LL&index=$order",
                "/channels/" . $video->channel_code,
                $video
            );
        }

        // Veriyi Döndür
        yield from [];
    }
}
