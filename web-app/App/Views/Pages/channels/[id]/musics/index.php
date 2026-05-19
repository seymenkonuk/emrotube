<?php

use Seymen\PhpMvcTemplate\DTO\ChannelHeaderDTO;
use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\DTO\MusicCardDTO;

?>

<?php

/** @var ChannelHeaderDTO $header */
/** @var \Generator<int, MusicCardDTO> $musics */
/** @var PaginationDTO $pagination */

?>

<!-- Layout -->
<?= $this->layout("Layouts/MainLayout", [
    "title" => $header->title,
    "activeNav" => "",
]) ?>

<!-- START CONTENT SECTION -->
<section class="grid grid-cols-1 gap-6">
    <?= $this->insert("Components/Channel/ChannelHeader", [
        "header" => $header,
        "activeNav" => "/musics",
    ]); ?>
</section>

<?php if ($musics->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Result/ResultInfo", [
        "entityName" => "müzik",
        "entityCount" => $pagination->total,
    ]); ?>

    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 2xl:grid-cols-4 gap-6">
        <?php foreach ($musics as $music): ?>
            <?= $this->insert("Components/Music/MusicCard", [
                "music" => $music,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <p class="text-gray-500 mb-6">Bu kanalda henüz hiç müzik yok</p>
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