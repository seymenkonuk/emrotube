<?php

use Seymen\PhpMvcTemplate\DTO\ChannelHeaderDTO;
use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\DTO\VideoCardDTO;

?>

<?php

/** @var ChannelHeaderDTO $header */
/** @var \Generator<int, VideoCardDTO> $videos */
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
        "activeNav" => "/videos",
    ]); ?>
</section>

<?php if ($videos->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Result/ResultInfo", [
        "entityName" => "video",
        "entityCount" => $pagination->total,
    ]); ?>

    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-6">
        <?php foreach ($videos as $video): ?>
            <?= $this->insert("Components/Video/VideoCard", [
                "video" => $video,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <p class="text-gray-500 mb-6">Bu kanalda henüz hiç video yok</p>
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