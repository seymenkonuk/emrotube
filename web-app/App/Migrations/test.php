<?php
// ============================================================================
// File:    ChannelRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Migrations;


use Seymen\PhpMvcTemplate\Core\Repository;


class TestMigration extends Repository
{
    public function Up()
    {
        // $sql = "SELECT 1 FROM vw_channel_edit WHERE code = :code LIMIT 1";
        // $stmt = $this->pdo->prepare($sql);
        // $stmt->bindValue(':code', $code);
        // $stmt->execute();
        // return (bool) $stmt->fetchColumn();
    }

    public function Down()
    {
        // $sql = "SELECT 1 FROM vw_channel_edit WHERE code = :code LIMIT 1";
        // $stmt = $this->pdo->prepare($sql);
        // $stmt->bindValue(':code', $code);
        // $stmt->execute();
        // return (bool) $stmt->fetchColumn();
    }
}
