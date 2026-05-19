<?php
// ============================================================================
// File:    PlaylistTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================


namespace Seymen\PhpMvcTemplate\Seeders;


require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "vendor" . DIRECTORY_SEPARATOR . "autoload.php");


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Enums\ViewType;

class PlaylistTableSeeder extends Repository
{
    public const playlist_count = 200;

    public function Up()
    {
        $startTime = strtotime("2021-01-01 00:00:00");
        $endTime = strtotime("2021-12-31 23:59:59");
        $count = PlaylistTableSeeder::playlist_count;
        // Rastgele Tarih Üret
        $dates = array_map(fn() => date('Y-m-d H:i:s', mt_rand($startTime, $endTime)), range(1, $count));
        sort($dates);
        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $this->pdo
                ->prepare("INSERT INTO playlist (code, channel_id, title, view_type, created_at) VALUES (:code, :channel_id, :title, :view_type, :created_at)")
                ->execute([
                    ":code" => $this->createUniqueCode(),
                    ":channel_id" => mt_rand(1, UserTableSeeder::user_count),
                    ":view_type" => mt_rand(1, count(ViewType::cases())) - 1,
                    ":title" => "Liste " . ($i + 1),
                    ":created_at" => $date,
                ]);
        }
    }

    public function Down() {}
}
