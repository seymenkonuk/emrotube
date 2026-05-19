<?php

/** @var string $editUrl */
/** @var string $changePasswordUrl */
/** @var string $deleteUrl */

?>

<!-- Layout -->
<?= $this->layout("Layouts/StudioLayout", [
    "title" => "Yönetim",
    "activeNav" => "/studio",
]) ?>

<!-- START CONTENT SECTION -->
<section class="grid grid-cols-1 gap-6">
    <?= $this->insert("Components/User/UserEditCard", [
        "href" => $editUrl,
    ]); ?>
    <?= $this->insert("Components/User/PasswordEditCard", [
        "href" => $changePasswordUrl,
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