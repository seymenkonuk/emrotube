<?php
// ============================================================================
// File:    VideoTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================


namespace Seymen\PhpMvcTemplate\Seeders;


require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "vendor" . DIRECTORY_SEPARATOR . "autoload.php");


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Enums\CommentType;
use Seymen\PhpMvcTemplate\Enums\VideoType;
use Seymen\PhpMvcTemplate\Enums\ViewType;

class VideoTableSeeder extends Repository
{
    public const video_count = 1000;

    public function Up()
    {
        $startTime = strtotime("2021-01-01 00:00:00");
        $endTime = time();
        $count = VideoTableSeeder::video_count;
        // Rastgele Tarih Üret
        $dates = array_map(fn() => date('Y-m-d H:i:s', mt_rand($startTime, $endTime)), range(1, $count));
        sort($dates);
        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $video_type = mt_rand(1, count(VideoType::cases())) - 1;
            $view_type = mt_rand(1, count(ViewType::cases())) - 1;
            $comment_type = mt_rand(1, count(CommentType::cases())) - 1;

            $this->pdo
                ->prepare("INSERT INTO video (code, title, uploader_id, video_type, view_type, comment_type, duration, created_at) VALUES (:code, :title, :uploader_id, :video_type, :view_type, :comment_type, :duration, :created_at)")
                ->execute([
                    ":code" => $this->createUniqueCode(),
                    ":title" => VideoType::from($video_type)->label() . " " . ($i + 1),
                    ":uploader_id" => mt_rand(1, UserTableSeeder::user_count),
                    ":video_type" => $video_type,
                    ":view_type" => $view_type,
                    ":comment_type" => $comment_type,
                    ":duration" => mt_rand(100, 1000),
                    ":created_at" => $date,
                ]);
        }
    }

    public function Down() {}
}
