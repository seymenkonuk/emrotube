<?php
// ============================================================================
// File:    WatchLaterRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Repositories;


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Models\Media;
use Seymen\PhpMvcTemplate\Models\WatchLaterHeader;


class WatchLaterRepository extends Repository
{
    /**
     * İlgili oynatma listesinin header bilgilerini döner.
     * @param string $channelCode
     * @return ?WatchLaterHeader
     */
    public function getWatchLaterHeaderByChannelCode(string $channelCode): ?WatchLaterHeader
    {
        $sql = "SELECT * FROM vw_watch_later_header WHERE channel_code = :channelCode LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, WatchLaterHeader::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * İlgili oynatma listesine ait tüm video sayısını döner.
     * @param string $channelCode
     * @return int
     */
    public function getCountContentFromWatchLater(string $channelCode): int
    {
        $sql = "SELECT video_count FROM vw_watch_later_header WHERE channel_code = :channelCode LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * İlgili oynatma listesine ait tüm videoları sayfalama yaparak getirir.
     * @param string    $channelCode
     * @param int       $offset
     * @param int       $limit
     * @return \Generator<int, Media>
     */
    public function getPaginatedContentFromWatchLater(string $channelCode, int $offset, int $limit): \Generator
    {
        $sql = "
            SELECT vam.*
            FROM vw_watch_later_content vwlc
            JOIN vw_all_media vam ON vam.code = vwlc.video_code
            WHERE vwlc.channel_code = :channelCode
            ORDER BY vwlc.created_at ASC
            LIMIT :limit OFFSET :offset
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Media::class);
        while ($row = $stmt->fetch()) {
            yield $row;
        }
    }
}
