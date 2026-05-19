<?php

use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\DTO\PlaylistCardDTO;

?>

<?php

/** @var \Generator<int, PlaylistCardDTO> $playlists */
/** @var PaginationDTO $pagination */

?>

<!-- Layout -->
<?= $this->layout("Layouts/StudioLayout", [
    "title" => "Yönetim",
    "activeNav" => "/studio/playlists",
]) ?>

<!-- START CONTENT SECTION -->
<section class="grid grid-cols-1">
    <?= $this->insert("Components/Form/Elements/LinkButton", [
        "text" => "Yeni Oluştur",
        "href" => "/studio/playlists/new",
        "icon" => "bi-plus",
        "color" => "bg-blue-500",
        "hoverColor" => "bg-blue-600",
        "textColor" => "text-white",
    ]); ?>
</section>

<?php if ($playlists->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Result/ResultInfo", [
        "entityName" => "oynatma listesi",
        "entityCount" => $pagination->total,
    ]); ?>

    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-6">
        <?php foreach ($playlists as $playlist): ?>
            <?= $this->insert("Components/Playlist/PlaylistListItem", [
                "playlist" => $playlist,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <p class="text-gray-500 mb-6">Henüz hiç oynatma listesi oluşturmadınız</p>
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