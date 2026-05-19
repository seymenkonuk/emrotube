<?php

// ============================================================================
// File:    Repository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Core;


use PDO;

use Seymen\PhpMvcTemplate\Config\ValidationConfig;


class Repository
{
    protected Database $database;
    protected PDO $pdo;
    protected string $privateSalt;

    public function __construct()
    {
        $this->database = Database::getInstance();
        $this->pdo = $this->database->getPDO();
        $this->privateSalt = $this->database->getPrivateSalt();
    }

    public function existsByCode(string $code): bool
    {
        return false;
    }

    protected function createUniqueCode(): string
    {
        do {
            $code = Database::generateToken(ValidationConfig::CODE_MAX_LEN / 2);
        } while ($this->existsByCode($code));

        return $code;
    }
}
