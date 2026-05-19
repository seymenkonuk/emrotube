<?php

use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\DTO\VideoCardDTO;

?>

<?php

/** @var \Generator<int, VideoCardDTO> $videos */
/** @var PaginationDTO $pagination */

?>

<!-- Layout -->
<?= $this->layout("Layouts/StudioLayout", [
    "title" => "Yönetim",
    "activeNav" => "/studio/videos",
]) ?>

<!-- START CONTENT SECTION -->
<section class="grid grid-cols-1">
    <?= $this->insert("Components/Form/Elements/LinkButton", [
        "text" => "Yeni Oluştur",
        "href" => "/studio/videos/new",
        "icon" => "bi-plus",
        "color" => "bg-blue-500",
        "hoverColor" => "bg-blue-600",
        "textColor" => "text-white",
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
        <?php foreach ($videos as $video): ?>
            <?= $this->insert("Components/Video/VideoListItem", [
                "video" => $video,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <p class="text-gray-500 mb-6">Henüz hiç video oluşturmadınız</p>
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