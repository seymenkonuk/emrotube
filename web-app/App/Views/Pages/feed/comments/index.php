<?php

use Seymen\PhpMvcTemplate\DTO\PaginationDTO;
use Seymen\PhpMvcTemplate\DTO\CommentCardDTO;

?>

<?php

/** @var \Generator<int, CommentCardDTO> $comments */
/** @var PaginationDTO $pagination */

?>

<!-- Layout -->
<?= $this->layout("Layouts/MainLayout", [
    "title" => "Yorumların",
    "activeNav" => "/feed/comments",
]) ?>

<!-- START CONTENT SECTION -->
<?php if ($comments->valid()): ?>
    <!-- Sonuç Adedi  -->
    <?= $this->insert("Components/Result/ResultInfo", [
        "entityName" => "yorum",
        "entityCount" => $pagination->total,
    ]); ?>

    <!-- Sonuçlar -->
    <section class="grid grid-cols-1 gap-6">
        <?php foreach ($comments as $comment): ?>
            <?= $this->insert("Components/Comment/CommentCard", [
                "comment" => $comment,
            ]); ?>
        <?php endforeach ?>
    </section>
<?php else: ?>
    <p class="text-gray-500 mb-6">Henüz hiç yorum yapmadınız</p>
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