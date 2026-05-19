<?php
// ============================================================================
// File:    ShortRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Repositories;


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Models\Media;
use Seymen\PhpMvcTemplate\Models\MediaEdit;


class ShortRepository extends Repository
{
    /**
     * Bu koda sahip kısa video olup olmadığını döner.
     * @param string $code
     * @return bool
     */
    public function existsByCode(string $code): bool
    {
        $sql = "SELECT 1 FROM vw_short_edit WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Kısa video'yu yükleyen kanalın kodunu döner.
     * @param string $code
     * @return string kısa video bulunamazsa "" döner.
     */
    public function getUploaderCodeByCode(string $code): string
    {
        $sql = "SELECT channel_code FROM vw_shorts WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        return (string) $stmt->fetchColumn();
    }

    /**
     * Kısa videonun edit detaylarını getirir.
     * @param string $code
     * @return ?MediaEdit
     */
    public function getShortForEditing(string $code): ?MediaEdit
    {
        $sql = "SELECT * FROM vw_short_edit WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, MediaEdit::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * Herkese açık olarak paylaşılmış kısa video sayısını döner.
     * @return int
     */
    public function getCountPublicShorts(): int
    {
        $sql = "SELECT COUNT(*) FROM vw_public_shorts";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * Herkese açık olarak paylaşılmış kısa videoları sayfalama yaparak getirir.
     * @param int $offset
     * @param int $limit
     * @return \Generator<int, Media>
     */
    public function getPaginatedPublicShorts(int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_public_shorts ORDER BY date DESC LIMIT :limit OFFSET :offset";
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
     * İlgili kanalın herkese açık olarak paylaştığı kısa video sayısını döner.
     * @param string $channelCode
     * @return int
     */
    public function getCountPublicShortsByChannelCode(string $channelCode): int
    {
        $sql = "SELECT COUNT(*) FROM vw_public_shorts WHERE channel_code = :channelCode";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * İlgili kanalın herkese açık olarak paylaştığı kısa videolarını sayfalama yaparak getirir.
     * @param string    $channelCode
     * @param int       $offset
     * @param int       $limit
     * @return \Generator<int, Media>
     */
    public function getPaginatedPublicShortsByChannelCode(string $channelCode, int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_public_shorts WHERE channel_code = :channelCode ORDER BY date DESC LIMIT :limit OFFSET :offset";
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
     * İlgili kanalın paylaştığı tüm kısa video sayısını döner.
     * @param string    $channelCode
     * @return int
     */
    public function getCountMyShortsByChannelCode(string $channelCode): int
    {
        $sql = "SELECT COUNT(*) FROM vw_shorts WHERE channel_code = :channelCode";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * İlgili kanalın paylaştığı tüm kısa videolarını sayfalama yaparak getirir.
     * @param string    $channelCode
     * @param int       $offset
     * @param int       $limit
     * @return \Generator<int, Media>
     */
    public function getPaginatedMyShortsByChannelCode(string $channelCode, int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_shorts WHERE channel_code = :channelCode ORDER BY date DESC LIMIT :limit OFFSET :offset";
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
