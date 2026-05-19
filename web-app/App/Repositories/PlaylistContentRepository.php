<?php
// ============================================================================
// File:    PlaylistContentRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Repositories;


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Models\Media;


class PlaylistContentRepository extends Repository
{
    /**
     * İlgili oynatma listesine ait tüm video sayısını döner.
     * @param string $playlistCode
     * @return int
     */
    public function getCountContentByPlaylistCode(string $playlistCode): int
    {
        $sql = "SELECT video_count FROM vw_playlist_header WHERE code = :playlistCode LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':playlistCode', $playlistCode);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * İlgili oynatma listesine ait tüm videoları sayfalama yaparak getirir.
     * @param string    $playlistCode
     * @param int       $offset
     * @param int       $limit
     * @return \Generator<int, Media>
     */
    public function getPaginatedContentByPlaylistCode(string $playlistCode, int $offset, int $limit): \Generator
    {
        $sql = "
            SELECT vam.*
            FROM vw_playlist_content vpc
            JOIN vw_all_media vam ON vam.code = vpc.video_code
            WHERE vpc.playlist_code = :playlistCode
            ORDER BY vpc.order ASC
            LIMIT :limit OFFSET :offset
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':playlistCode', $playlistCode);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Media::class);
        while ($row = $stmt->fetch()) {
            yield $row;
        }
    }
}
