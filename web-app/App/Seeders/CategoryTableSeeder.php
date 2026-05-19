<?php
// ============================================================================
// File:    CategoryTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================


namespace Seymen\PhpMvcTemplate\Seeders;


require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "vendor" . DIRECTORY_SEPARATOR . "autoload.php");


use Seymen\PhpMvcTemplate\Core\Repository;


class CategoryTableSeeder extends Repository
{
    public const category_count = 20;

    public function Up()
    {
        $startTime = strtotime("2020-01-01 00:00:00");
        $endTime = strtotime("2020-12-31 23:59:59");
        $count = CategoryTableSeeder::category_count;
        // Rastgele Tarih Üret
        $dates = array_map(fn() => date('Y-m-d H:i:s', mt_rand($startTime, $endTime)), range(1, $count));
        sort($dates);
        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $this->pdo
                ->prepare("INSERT INTO category (code, title, created_at) VALUES (:code, :title, :created_at)")
                ->execute([
                    ":code" => $this->createUniqueCode(),
                    ":title" => "Kategori " . ($i + 1),
                    ":created_at" => $date,
                ]);
        }
    }

    public function Down() {}
}
