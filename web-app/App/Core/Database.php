<?php
// ============================================================================
// File:    Database.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Core;


use PDO;
use PDOException;

use Seymen\PhpMvcTemplate\Config\DatabaseConfig;


class Database
{
    private ?PDO $pdo = NULL;
    private string $privateSalt;
    private static ?Database $instance = NULL;

    public static function getInstance()
    {
        if (self::$instance === NULL) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public static function generateToken(int $byte)
    {
        return bin2hex(random_bytes($byte));
    }

    private function __construct()
    {
        $host    = getenv('MYSQL_HOST') ?: DatabaseConfig::MYSQL_HOST;
        $port    = getenv('MYSQL_PORT') ?: DatabaseConfig::MYSQL_PORT;
        $dbname  = getenv('MYSQL_DB_NAME') ?: DatabaseConfig::MYSQL_DB_NAME;
        $user    = getenv('MYSQL_USER') ?: DatabaseConfig::MYSQL_USER;
        $pass    = getenv('MYSQL_PASSWORD') ?: DatabaseConfig::MYSQL_PASSWORD;
        $charset = getenv('MYSQL_CHARSET') ?: DatabaseConfig::MYSQL_CHARSET;
        $this->privateSalt = getenv('PRIVATE_SALT') ?: DatabaseConfig::PRIVATE_SALT;
        // Connect Database
        try {
            $this->pdo = new \PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=$charset", $user, $pass);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
        } catch (PDOException $e) {
            ErrorHandler::show(500, [
                "auth" => ["code" => ""], // auth atanmazsa, DB'den auth bilgisi çekilmeye çalışılır, bu da sonsuz döngüye yol açar.
                "message" => $e->getMessage(), // hata ayıklama için, lütfen gerçek uygulamada yorum satırına alınız
            ]);
        }
    }

    public function __destruct()
    {
        $this->pdo = NULL;
    }

    public function getPDO()
    {
        return $this->pdo;
    }

    public function getPrivateSalt()
    {
        return $this->privateSalt;
    }
}
