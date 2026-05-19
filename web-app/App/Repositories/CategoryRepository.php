<?php
// ============================================================================
// File:    CategoryRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Repositories;


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Models\Category;
use Seymen\PhpMvcTemplate\Models\CategoryHeader;


class CategoryRepository extends Repository
{
    /**
     * Bu koda sahip kategori olup olmadığını döner.
     * @param string $code
     * @return bool
     */
    public function existsByCode(string $code): bool
    {
        $sql = "SELECT 1 FROM vw_category_edit WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    /**
     * İlgili kategorinin header bilgilerini döner.
     * @param string $code
     * @return ?CategoryHeader
     */
    public function getCategoryHeaderByCode(string $code): ?CategoryHeader
    {
        $sql = "SELECT * FROM vw_category_header WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, CategoryHeader::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * Herkese açık olarak paylaşılmış kategori sayısını döner.
     * @return int
     */
    public function getCountPublicCategories(): int
    {
        $sql = "SELECT COUNT(*) FROM vw_public_categories";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * Herkese açık olarak paylaşılmış kategorileri sayfalama yaparak getirir.
     * @param int $offset
     * @param int $limit
     * @return \Generator<int, Category>
     */
    public function getPaginatedPublicCategories(int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_public_categories ORDER BY title ASC LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Category::class);
        while ($row = $stmt->fetch()) {
            yield $row;
        }
    }
}
