<?php
// ============================================================================
// File:    UserTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================


namespace Seymen\PhpMvcTemplate\Seeders;


require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "vendor" . DIRECTORY_SEPARATOR . "autoload.php");


use Seymen\PhpMvcTemplate\Core\Repository;


class UserTableSeeder extends Repository
{
    public const user_count = 100;

    public function Up()
    {
        $startTime = strtotime("2020-01-01 00:00:00");
        $endTime = strtotime("2020-12-31 23:59:59");
        $count = UserTableSeeder::user_count;
        // Rastgele Tarih Üret
        $dates = array_map(fn() => date('Y-m-d H:i:s', mt_rand($startTime, $endTime)), range(1, $count));
        sort($dates);
        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $username = "User" . ($i + 1);
            $channelName = "Kanal " . ($i + 1);
            // Kullanıcıları Oluştur
            $this->pdo
                ->prepare("INSERT INTO user (code, username, email, name, surname, country, password_hash, created_at) VALUES (:code, :username, :email, :name, :surname, :country, :password_hash, :created_at)")
                ->execute([
                    ":code" => $this->createUniqueCode(),
                    ":username" => $username,
                    ":email" => strtolower($username) . "@emrotube.local",
                    ":name" => "İsim " . ($i + 1),
                    ":surname" => "Soyisim " . ($i + 1),
                    ":country" => "Türkiye",
                    ":password_hash" => password_hash($username, PASSWORD_DEFAULT),
                    ":created_at" => $date,
                ]);
            // İlk Kanallarını Oluştur
            $this->pdo
                ->prepare("INSERT INTO channel (code, user_id, name, title, created_at) VALUES (:code, :user_id, :name, :title, :created_at)")
                ->execute([
                    ":code" => $this->createUniqueCode(),
                    ":user_id" => ($i + 1),
                    ":name" => "@kanal" . ($i + 1),
                    ":title" => $channelName,
                    ":created_at" => $date,
                ]);
            // Kullanıcının Aktif Kanalını Güncelle
            $this->pdo
                ->prepare("UPDATE user SET active_channel_id = :id WHERE id = :id")
                ->execute([
                    ":id" => ($i + 1)
                ]);
        }
    }

    public function Down() {}
}
