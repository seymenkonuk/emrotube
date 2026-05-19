<?php
// ============================================================================
// File:    VideoRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Repositories;


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Models\Media;
use Seymen\PhpMvcTemplate\Models\MediaEdit;


class VideoRepository extends Repository
{
    /**
     * Bu koda sahip video olup olmadığını döner.
     * @param string $code
     * @return bool
     */
    public function existsByCode(string $code): bool
    {
        $sql = "SELECT 1 FROM vw_video_edit WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Video'yu yükleyen kanalın kodunu döner.
     * @param string $code
     * @return string video bulunamazsa "" döner.
     */
    public function getUploaderCodeByCode(string $code): string
    {
        $sql = "SELECT channel_code FROM vw_videos WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        return (string) $stmt->fetchColumn();
    }

    /**
     * Videonun edit detaylarını getirir.
     * @param string $code
     * @return ?MediaEdit
     */
    public function getVideoForEditing(string $code): ?MediaEdit
    {
        $sql = "SELECT * FROM vw_video_edit WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, MediaEdit::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * Herkese açık olarak paylaşılmış video sayısını döner.
     * @return int
     */
    public function getCountPublicVideos(): int
    {
        $sql = "SELECT COUNT(*) FROM vw_public_videos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * Herkese açık olarak paylaşılmış videoları sayfalama yaparak getirir.
     * @param int $offset
     * @param int $limit
     * @return \Generator<int, Media>
     */
    public function getPaginatedPublicVideos(int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_public_videos ORDER BY date DESC LIMIT :limit OFFSET :offset";
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
     * İlgili kanalın herkese açık olarak paylaştığı video sayısını döner.
     * @param string $channelCode
     * @return int
     */
    public function getCountPublicVideosByChannelCode(string $channelCode): int
    {
        $sql = "SELECT COUNT(*) FROM vw_public_videos WHERE channel_code = :channelCode";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * İlgili kanalın herkese açık olarak paylaştığı videolarını sayfalama yaparak getirir.
     * @param string    $channelCode
     * @param int       $offset
     * @param int       $limit
     * @return \Generator<int, Media>
     */
    public function getPaginatedPublicVideosByChannelCode(string $channelCode, int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_public_videos WHERE channel_code = :channelCode ORDER BY date DESC LIMIT :limit OFFSET :offset";
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
     * İlgili kanalın paylaştığı tüm video sayısını döner.
     * @param string $channelCode
     * @return int
     */
    public function getCountMyVideosByChannelCode(string $channelCode): int
    {
        $sql = "SELECT COUNT(*) FROM vw_videos WHERE channel_code = :channelCode";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * İlgili kanalın paylaştığı tüm videolarını sayfalama yaparak getirir.
     * @param string    $channelCode
     * @param int       $offset
     * @param int       $limit
     * @return \Generator<int, Media>
     */
    public function getPaginatedMyVideosByChannelCode(string $channelCode, int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_videos WHERE channel_code = :channelCode ORDER BY date DESC LIMIT :limit OFFSET :offset";
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
