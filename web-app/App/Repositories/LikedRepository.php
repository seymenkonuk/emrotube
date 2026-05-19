<?php
// ============================================================================
// File:    LikedRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Repositories;


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Models\LikedHeader;
use Seymen\PhpMvcTemplate\Models\Media;


class LikedRepository extends Repository
{
    /**
     * İlgili oynatma listesinin header bilgilerini döner.
     * @param string $channelCode
     * @return ?LikedHeader
     */
    public function getLikedHeaderByChannelCode(string $channelCode): ?LikedHeader
    {
        $sql = "SELECT * FROM vw_liked_header WHERE channel_code = :channelCode LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, LikedHeader::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * İlgili oynatma listesine ait tüm video sayısını döner.
     * @param string $channelCode
     * @return int
     */
    public function getCountContentFromLiked(string $channelCode): int
    {
        $sql = "SELECT video_count FROM vw_liked_header WHERE channel_code = :channelCode LIMIT 1";
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
    public function getPaginatedContentFromLiked(string $channelCode, int $offset, int $limit): \Generator
    {
        $sql = "
            SELECT vam.*
            FROM vw_liked_content vlc
            JOIN vw_all_media vam ON vam.code = vlc.video_code
            WHERE vlc.channel_code = :channelCode
            ORDER BY vlc.created_at ASC
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
