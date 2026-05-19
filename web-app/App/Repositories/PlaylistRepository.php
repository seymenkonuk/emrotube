<?php
// ============================================================================
// File:    PlaylistRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Repositories;


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Models\Playlist;
use Seymen\PhpMvcTemplate\Models\PlaylistEdit;
use Seymen\PhpMvcTemplate\Models\PlaylistHeader;


class PlaylistRepository extends Repository
{
    /**
     * Bu koda sahip oynatma listesi olup olmadığını döner.
     * @param string $code
     * @return bool
     */
    public function existsByCode(string $code): bool
    {
        $sql = "SELECT 1 FROM vw_playlist_edit WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Oynatma listesini oluşturan kanalın kodunu döner.
     * @param string $code
     * @return string oynatma listesi bulunamazsa "" döner.
     */
    public function getOwnerCodeByCode(string $code): string
    {
        $sql = "SELECT channel_code FROM vw_playlists WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        return (string) $stmt->fetchColumn();
    }

    /**
     * Oynatma listesinin edit detaylarını getirir.
     * @param string $code
     * @return ?PlaylistEdit
     */
    public function getPlaylistForEditing(string $code): ?PlaylistEdit
    {
        $sql = "SELECT * FROM vw_playlist_edit WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, PlaylistEdit::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * İlgili oynatma listesinin header bilgilerini döner.
     * @param string $code
     * @return ?PlaylistHeader
     */
    public function getPlaylistHeaderByCode(string $code): ?PlaylistHeader
    {
        $sql = "SELECT * FROM vw_playlist_header WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, PlaylistHeader::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * Herkese açık olarak paylaşılmış oynatma listesi sayısını döner.
     * @return int
     */
    public function getCountPublicPlaylists(): int
    {
        $sql = "SELECT COUNT(*) FROM vw_public_playlists";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * Herkese açık olarak paylaşılmış oynatma listelerini sayfalama yaparak getirir.
     * @param int $offset
     * @param int $limit
     * @return \Generator<int, Playlist>
     */
    public function getPaginatedPublicPlaylists(int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_public_playlists ORDER BY date DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Playlist::class);
        while ($row = $stmt->fetch()) {
            yield $row;
        }
    }

    /**
     * İlgili kanalın herkese açık olarak paylaştığı oynatma listesi sayısını döner.
     * @param string $channelCode
     * @return int
     */
    public function getCountPublicPlaylistsByChannelCode(string $channelCode): int
    {
        $sql = "SELECT COUNT(*) FROM vw_public_playlists WHERE channel_code = :channelCode";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * İlgili kanalın herkese açık olarak paylaştığı oynatma listelerini sayfalama yaparak getirir.
     * @param string    $channelCode
     * @param int       $offset
     * @param int       $limit
     * @return \Generator<int, Playlist>
     */
    public function getPaginatedPublicPlaylistsByChannelCode(string $channelCode, int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_public_playlists WHERE channel_code = :channelCode ORDER BY date DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Playlist::class);
        while ($row = $stmt->fetch()) {
            yield $row;
        }
    }

    /**
     * İlgili kanalın paylaştığı tüm oynatma listesi sayısını döner.
     * @param string $channelCode
     * @return int
     */
    public function getCountMyPlaylistsByChannelCode(string $channelCode): int
    {
        $sql = "SELECT COUNT(*) FROM vw_playlists WHERE channel_code = :channelCode";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * İlgili kanalın paylaştığı tüm oynatma listelerini sayfalama yaparak getirir.
     * @param string    $channelCode
     * @param int       $offset
     * @param int       $limit
     * @return \Generator<int, Playlist>
     */
    public function getPaginatedMyPlaylistsByChannelCode(string $channelCode, int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_playlists WHERE channel_code = :channelCode ORDER BY date DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Playlist::class);
        while ($row = $stmt->fetch()) {
            yield $row;
        }
    }
}
