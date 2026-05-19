<?php
// ============================================================================
// File:    LikedTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================


namespace Seymen\PhpMvcTemplate\Seeders;


require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "vendor" . DIRECTORY_SEPARATOR . "autoload.php");


use Seymen\PhpMvcTemplate\Core\Repository;

class LikedTableSeeder extends Repository
{
    public function Up()
    {
        $startTime = strtotime("2026-01-01 00:00:00");
        $endTime = time();

        $likes = [];
        $user_count = UserTableSeeder::user_count;
        $video_count = VideoTableSeeder::video_count;
        for ($i = 1; $i <= $video_count; $i++) {
            $chance = mt_rand(0, 70);
            for ($j = 1; $j <= $user_count; $j++) {
                // 
                if (mt_rand(1, 100) <= $chance) {
                    $likes[] = [$i, $j, 0];
                } else if (mt_rand(1, 100) <= $chance) {
                    $likes[] = [$i, $j, 1];
                }
            }
        }
        shuffle($likes);
        $count = count($likes);

        // Rastgele Tarih Üret
        $dates = array_map(fn() => date('Y-m-d H:i:s', mt_rand($startTime, $endTime)), range(1, $count));
        sort($dates);
        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $this->pdo
                ->prepare("INSERT INTO liked (channel_id, video_id, type, created_at) VALUES (:channel_id, :video_id, :type, :created_at)")
                ->execute([
                    ":video_id" => $likes[$i][0],
                    ":channel_id" => $likes[$i][1],
                    ":type" => $likes[$i][2],
                    ":created_at" => $date,
                ]);
        }
    }

    public function Down() {}
}
