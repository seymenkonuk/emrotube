<?php

use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\DTO\ShortCardDTO;

?>

<?php

/** @var \Generator<int, ShortCardDTO> $shorts */
/** @var PaginationDTO $pagination */

?>

<!-- Layout -->
<?= $this->layout("Layouts/MainLayout", [
    "title" => "Kısa Videolar",
    "activeNav" => "/shorts",
]) ?>

<!-- START CONTENT SECTION -->
<?php if ($shorts->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Result/ResultInfo", [
        "entityName" => "kısa video",
        "entityCount" => $pagination->total,
    ]); ?>

    <!-- Sonuçlar -->
    <section class="grid grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-6">
        <?php foreach ($shorts as $short): ?>
            <?= $this->insert("Components/Short/ShortCard", [
                "short" => $short,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <p class="text-gray-500 mb-6">Bu platformda henüz hiç kısa video yok</p>
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