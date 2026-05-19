<?php
// ============================================================================
// File:    HistoryRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Repositories;


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Models\HistoryHeader;
use Seymen\PhpMvcTemplate\Models\Media;


class HistoryRepository extends Repository
{
    /**
     * İlgili oynatma listesinin header bilgilerini döner.
     * @param string $channelCode
     * @return ?HistoryHeader
     */
    public function getHistoryHeaderByChannelCode(string $channelCode): ?HistoryHeader
    {
        $sql = "SELECT * FROM vw_history_header WHERE channel_code = :channelCode LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, HistoryHeader::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * İlgili oynatma listesine ait tüm video sayısını döner.
     * @param string $channelCode
     * @return int
     */
    public function getCountContentFromHistory(string $channelCode): int
    {
        $sql = "SELECT video_count FROM vw_history_header WHERE channel_code = :channelCode LIMIT 1";
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
    public function getPaginatedContentFromHistory(string $channelCode, int $offset, int $limit): \Generator
    {
        $sql = "
            SELECT vam.*
            FROM vw_history_content vhc
            JOIN vw_all_media vam ON vam.code = vhc.video_code
            WHERE vhc.channel_code = :channelCode
            ORDER BY vhc.created_at ASC
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
