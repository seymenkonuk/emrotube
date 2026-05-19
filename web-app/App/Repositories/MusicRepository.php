<?php
// ============================================================================
// File:    MusicRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Repositories;


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Models\Media;
use Seymen\PhpMvcTemplate\Models\MediaEdit;


class MusicRepository extends Repository
{
    /**
     * Bu koda sahip müzik olup olmadığını döner.
     * @param string $code
     * @return bool
     */
    public function existsByCode(string $code): bool
    {
        $sql = "SELECT 1 FROM vw_music_edit WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Müziği yükleyen kanalın kodunu döner.
     * @param string $code
     * @return string müzik bulunamazsa "" döner.
     */
    public function getUploaderCodeByCode(string $code): string
    {
        $sql = "SELECT channel_code FROM vw_musics WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        return (string) $stmt->fetchColumn();
    }

    /**
     * Müziğin edit detaylarını getirir.
     * @param string $code
     * @return ?MediaEdit
     */
    public function getMusicForEditing(string $code): ?MediaEdit
    {
        $sql = "SELECT * FROM vw_music_edit WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, MediaEdit::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * Herkese açık olarak paylaşılmış müzik sayısını döner.
     * @return int
     */
    public function getCountPublicMusics(): int
    {
        $sql = "SELECT COUNT(*) FROM vw_public_musics";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * Herkese açık olarak paylaşılmış müzikleri sayfalama yaparak getirir.
     * @param int $offset
     * @param int $limit
     * @return \Generator<int, Media>
     */
    public function getPaginatedPublicMusics(int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_public_musics ORDER BY date DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Media::class);
        while ($row = $stmt->fetch()) {
            yield $row;
        }
    }

    /**
     * İlgili kanalın herkese açık olarak paylaştığı müzik sayısını döner.
     * @param string $channelCode
     * @return int
     */
    public function getCountPublicMusicsByChannelCode(string $channelCode): int
    {
        $sql = "SELECT COUNT(*) FROM vw_public_musics WHERE channel_code = :channelCode";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * İlgili kanalın herkese açık olarak paylaştığı müziklerini sayfalama yaparak getirir.
     * @param string    $channelCode
     * @param int       $offset
     * @param int       $limit
     * @return \Generator<int, Media>
     */
    public function getPaginatedPublicMusicsByChannelCode(string $channelCode, int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_public_musics WHERE channel_code = :channelCode ORDER BY date DESC LIMIT :limit OFFSET :offset";
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

    /**
     * İlgili kanalın paylaştığı tüm müzik sayısını döner.
     * @param string $channelCode
     * @return int
     */
    public function getCountMyMusicsByChannelCode(string $channelCode): int
    {
        $sql = "SELECT COUNT(*) FROM vw_musics WHERE channel_code = :channelCode";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * İlgili kanalın paylaştığı tüm müziklerini sayfalama yaparak getirir.
     * @param string    $channelCode
     * @param int       $offset
     * @param int       $limit
     * @return \Generator<int, Media>
     */
    public function getPaginatedMyMusicsByChannelCode(string $channelCode, int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_musics WHERE channel_code = :channelCode ORDER BY date DESC LIMIT :limit OFFSET :offset";
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
