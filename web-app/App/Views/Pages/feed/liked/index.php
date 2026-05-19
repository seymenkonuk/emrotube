<?php

use Seymen\PhpMvcTemplate\DTO\LikedHeaderDTO;
use Seymen\PhpMvcTemplate\DTO\MediaListItemDTO;
use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\Enums\VideoType;

?>

<?php

/** @var LikedHeaderDTO $header */
/** @var \Generator<int, ?MediaListItemDTO> $videos */
/** @var PaginationDTO $pagination */

?>

<!-- Layout -->
<?= $this->layout("Layouts/MainLayout", [
    "title" => "Beğendiklerin",
    "activeNav" => "/feed/liked",
]) ?>

<!-- START CONTENT SECTION -->
<section class="grid grid-cols-1 gap-6">
    <?= $this->insert("Components/Liked/LikedHeader", [
        "header" => $header,
    ]); ?>
</section>

<?php if ($videos->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Result/ResultInfo", [
        "entityName" => "video",
        "entityCount" => $pagination->total,
    ]); ?>

    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-6">
        <?php $flag = true; ?>
        <?php foreach ($videos as $video): ?>
            <?php if ($video !== null): ?>
                <!-- Video Kartını Göster -->
                <?php if ($video->type == VideoType::VIDEO): ?>
                    <?= $this->insert("Components/Video/VideoListItem", [
                        "video" => $video,
                    ]); ?>
                <?php elseif ($video->type == VideoType::SHORT): ?>
                    <?= $this->insert("Components/Short/ShortListItem", [
                        "short" => $video,
                    ]); ?>
                <?php elseif ($video->type == VideoType::MUSIC): ?>
                    <?= $this->insert("Components/Music/MusicListItem", [
                        "music" => $video,
                    ]); ?>
                <?php endif ?>
                <!-- Flagi Set Et -->
                <?php $flag = true; ?>
            <?php elseif ($flag): ?>
                <!-- Video Gösterilemiyorsa Bildir -->
                <?= $this->insert("Components/Divider", [
                    "text" => "Kullanılamayan videolar gizlendi",
                ]); ?>
                <!-- Flagi Set Et -->
                <?php $flag = false; ?>
            <?php endif ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <p class="text-gray-500 mb-6">Henüz bir içerik beğenmediniz</p>
<?php endif ?>

<section class="grid grid-cols-1 gap-6">
    <?= $this->insert("Components/Pagination/Pagination", [
        "pagination" => $pagination,
    ]); ?>
</section>
<!-- END CONTENT SECTION -->

<!-- START SCRIPTS SECTION -->
<?= $this->start("scripts"); ?>
<?= $this->stop(); ?>
<!-- END SCRIPTS SECTION -->

<!-- START STYLES SECTION -->
<?= $this->start("styles"); ?>
<?= $this->stop(); ?>
<!-- END STYLES SECTION -->