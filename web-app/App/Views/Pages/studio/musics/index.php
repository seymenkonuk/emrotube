<?php

use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\DTO\MusicCardDTO;

?>

<?php

/** @var \Generator<int, MusicCardDTO> $musics */
/** @var PaginationDTO $pagination */

?>

<!-- Layout -->
<?= $this->layout("Layouts/StudioLayout", [
    "title" => "Yönetim",
    "activeNav" => "/studio/musics",
]) ?>

<!-- START CONTENT SECTION -->
<section class="grid grid-cols-1">
    <?= $this->insert("Components/Form/Elements/LinkButton", [
        "text" => "Yeni Oluştur",
        "href" => "/studio/musics/new",
        "icon" => "bi-plus",
        "color" => "bg-blue-500",
        "hoverColor" => "bg-blue-600",
        "textColor" => "text-white",
    ]); ?>
</section>

<?php if ($musics->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Result/ResultInfo", [
        "entityName" => "müzik",
        "entityCount" => $pagination->total,
    ]); ?>

    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-6">
        <?php foreach ($musics as $music): ?>
            <?= $this->insert("Components/Music/MusicListItem", [
                "music" => $music,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <p class="text-gray-500 mb-6">Henüz hiç müzik oluşturmadınız</p>
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