<?php
// ============================================================================
// File:    WatchLaterTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================


namespace Seymen\PhpMvcTemplate\Seeders;


require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "vendor" . DIRECTORY_SEPARATOR . "autoload.php");


use Seymen\PhpMvcTemplate\Core\Repository;

class WatchLaterTableSeeder extends Repository
{
    public function Up()
    {
        $startTime = strtotime("2026-01-01 00:00:00");
        $endTime = time();

        $lists = [];
        $user_count = UserTableSeeder::user_count;
        $video_count = VideoTableSeeder::video_count;
        for ($i = 1; $i <= $user_count; $i++) {
            $chance = mt_rand(0, 70);
            for ($j = 1; $j <= $video_count; $j++) {
                // 
                if (mt_rand(1, 100) <= $chance) {
                    $lists[] = [$i, $j];
                }
            }
        }
        shuffle($lists);
        $count = count($lists);

        // Rastgele Tarih Üret
        $dates = array_map(fn() => date('Y-m-d H:i:s', mt_rand($startTime, $endTime)), range(1, $count));
        sort($dates);
        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $this->pdo
                ->prepare("INSERT INTO watch_later (channel_id, video_id, created_at) VALUES (:channel_id, :video_id, :created_at)")
                ->execute([
                    ":channel_id" => $lists[$i][0],
                    ":video_id" => $lists[$i][1],
                    ":created_at" => $date,
                ]);
        }
    }

    public function Down() {}
}
