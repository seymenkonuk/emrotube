<?php
?>

<!-- Layout -->
<?= $this->layout("Layouts/MainLayout", [
    "title" => "Ana Sayfa"
]) ?>

<div class="flex flex-col-reverse xl:flex-row gap-6 p-4">

    <!-- Video + Açıklama + Yorumlar -->
    <div class="flex-1 flex flex-col gap-4 xl:w-3/5">
        <!-- Video Player -->
        <?= $this->insert("Components/Video/VideoPlayer", []); ?>

        <!-- Video Açıklaması -->
        <?= $this->insert("Components/Video/Details", []); ?>

        <!-- Yorumlar -->
        <div class="bg-white rounded-xl shadow-md p-4">
            <h3 class="font-semibold mb-2">Yorumlar</h3>
            <p class="text-gray-600 text-sm">Henüz yorum yok.</p>
        </div>
    </div>

    <!-- Playlist (Desktop sağ, Mobil açılır/kapanır üstte) -->
    <div class="xl:w-2/5 flex-shrink-0">
        <details class="bg-white rounded-xl shadow-md overflow-hidden">
            <summary class="cursor-pointer p-4 font-semibold text-gray-800 hover:bg-gray-100 transition">Playlist (15 Video)</summary>
            <div class="flex flex-col divide-y divide-gray-200">
                <!-- Playlist Item Örneği -->
                <?= $this->insert("Components/Music/MusicListItem", [
                    "order" => "1",
                    "url" => "",
                    "title" => "Video 1",
                    "duration" => "00:56",
                    "thumbnail" => "/static/defaults/videos/default.png",
                    "channel_avatar" => "/static/defaults/channels/default-avatar.png",
                    "channel_title" => "Kanal İsmi",
                    "view_count" => "100",
                    "date" => "1 gün önce",
                ]); ?>
                <?= $this->insert("Components/Music/MusicListItem", [
                    "order" => "2",
                    "url" => "",
                    "title" => "Video 1",
                    "duration" => "23:32",
                    "thumbnail" => "/static/defaults/videos/default.png",
                    "channel_avatar" => "/static/defaults/channels/default-avatar.png",
                    "channel_title" => "Kanal İsmi",
                    "view_count" => "100",
                    "date" => "1 gün önce",
                ]); ?>
                <!-- Diğer video itemları buraya eklenir -->
            </div>
        </details>
    </div>
</div>