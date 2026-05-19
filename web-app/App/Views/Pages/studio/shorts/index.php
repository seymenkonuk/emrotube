<?php

use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\DTO\ShortCardDTO;

?>

<?php

/** @var \Generator<int, ShortCardDTO> $shorts */
/** @var PaginationDTO $pagination */

?>

<!-- Layout -->
<?= $this->layout("Layouts/StudioLayout", [
    "title" => "Yönetim",
    "activeNav" => "/studio/shorts",
]) ?>

<!-- START CONTENT SECTION -->
<section class="grid grid-cols-1">
    <?= $this->insert("Components/Form/Elements/LinkButton", [
        "text" => "Yeni Oluştur",
        "href" => "/studio/shorts/new",
        "icon" => "bi-plus",
        "color" => "bg-blue-500",
        "hoverColor" => "bg-blue-600",
        "textColor" => "text-white",
    ]); ?>
</section>

<?php if ($shorts->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Result/ResultInfo", [
        "entityName" => "kısa video",
        "entityCount" => $pagination->total,
    ]); ?>

    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-6">
        <?php foreach ($shorts as $short): ?>
            <?= $this->insert("Components/Short/ShortListItem", [
                "short" => $short,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <p class="text-gray-500 mb-6">Henüz hiç kısa video oluşturmadınız</p>
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