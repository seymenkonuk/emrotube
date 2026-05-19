<?php

use Seymen\PhpMvcTemplate\DTO\CategoryCardDTO;
use Seymen\PhpMvcTemplate\DTO\PaginationDTO;

?>

<?php

/** @var \Generator<int, CategoryCardDTO> $categories */
/** @var PaginationDTO $pagination */

?>

<!-- Layout -->
<?= $this->layout("Layouts/MainLayout", [
    "title" => "Kategoriler",
    "activeNav" => "/categories",
]) ?>

<!-- START CONTENT SECTION -->
<?php if ($categories->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Result/ResultInfo", [
        "entityName" => "kategori",
        "entityCount" => $pagination->total,
    ]); ?>

    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-6">
        <?php foreach ($categories as $category): ?>
            <?= $this->insert("Components/Category/CategoryCard", [
                "category" => $category,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <p class="text-gray-500 mb-6">Bu platformda henüz hiç kategori yok</p>
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