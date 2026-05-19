<?php
// ============================================================================
// File:    SubscriptionTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================


namespace Seymen\PhpMvcTemplate\Seeders;


require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "vendor" . DIRECTORY_SEPARATOR . "autoload.php");


use Seymen\PhpMvcTemplate\Core\Repository;

class SubscriptionTableSeeder extends Repository
{
    public function Up()
    {
        $startTime = strtotime("2021-01-01 00:00:00");
        $endTime = time();

        $subscriptions = [];
        $user_count = UserTableSeeder::user_count;
        for ($i = 1; $i <= $user_count; $i++) {
            $chance = mt_rand(0, 70);
            for ($j = 1; $j <= $user_count; $j++) {
                // Kendine Abone Olamazsın
                if ($i === $j) continue;
                // 
                if (mt_rand(1, 100) <= $chance) {
                    $subscriptions[] = [$i, $j];
                }
            }
        }
        shuffle($subscriptions);
        $count = count($subscriptions);

        // Rastgele Tarih Üret
        $dates = array_map(fn() => date('Y-m-d H:i:s', mt_rand($startTime, $endTime)), range(1, $count));
        sort($dates);
        // Verileri Oluştur
        foreach ($dates as $i => $date) {
            $this->pdo
                ->prepare("INSERT INTO subscription (subscriber_id, subscribed_id, created_at) VALUES (:subscriber_id, :subscribed_id, :created_at)")
                ->execute([
                    ":subscriber_id" => $subscriptions[$i][0],
                    ":subscribed_id" => $subscriptions[$i][1],
                    ":created_at" => $date,
                ]);
        }
    }

    public function Down() {}
}
