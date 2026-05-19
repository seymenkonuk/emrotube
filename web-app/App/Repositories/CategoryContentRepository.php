<?php
// ============================================================================
// File:    CategoryContentRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Repositories;


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Models\Media;


class CategoryContentRepository extends Repository
{
    /**
     * İlgili kategoriye ait tüm video sayısını döner.
     * @param string $categoryCode
     * @return int
     */
    public function getCountContentByCategoryCode(string $categoryCode): int
    {
        $sql = "SELECT video_count FROM vw_category_header WHERE code = :categoryCode LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':categoryCode', $categoryCode);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * İlgili kategoriye ait tüm videoları sayfalama yaparak getirir.
     * @param string    $categoryCode
     * @param int       $offset
     * @param int       $limit
     * @return \Generator<int, Media>
     */
    public function getPaginatedContentByCategoryCode(string $categoryCode, int $offset, int $limit): \Generator
    {
        $sql = "
            SELECT vam.*
            FROM vw_category_content vcc
            JOIN vw_all_media vam ON vam.code = vcc.video_code
            WHERE vcc.category_code = :categoryCode
            ORDER BY vcc.created_at ASC
            LIMIT :limit OFFSET :offset
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':categoryCode', $categoryCode);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Media::class);
        while ($row = $stmt->fetch()) {
            yield $row;
        }
    }
}
