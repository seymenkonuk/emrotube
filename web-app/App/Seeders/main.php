<?php
// ============================================================================
// File:    main.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================


namespace Seymen\PhpMvcTemplate\Seeders;


require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "vendor" . DIRECTORY_SEPARATOR . "autoload.php");


echo "\n1. Kategoriler Oluşturuluyor...";
(new CategoryTableSeeder())->Up();

echo "\n2. Kullanıcılar ve Kanallar Oluşturuluyor...";
(new UserTableSeeder())->Up();

echo "\n3. Abonelikler Oluşturuluyor...";
(new SubscriptionTableSeeder())->Up();

echo "\n4. Oynatma Listeleri Oluşturuluyor...";
(new PlaylistTableSeeder())->Up();

echo "\n5. Videolar Oluşturuluyor...";
(new VideoTableSeeder())->Up();

echo "\n6. Videolar Kategorilere Ekleniyor...";
(new VideoCategoryTableSeeder())->Up();

echo "\n7. Videolar Oynatma Listelerine Ekleniyor...";
(new PlaylistVideoTableSeeder())->Up();

echo "\n8. Videolar Geçmişe Ekleniyor...";
(new HistoryTableSeeder())->Up();

echo "\n9. Videolar Beğenilenlere Ekleniyor...";
(new LikedTableSeeder())->Up();

echo "\n10. Videolar Daha Sonra İzleye Ekleniyor...";
(new WatchLaterTableSeeder())->Up();
