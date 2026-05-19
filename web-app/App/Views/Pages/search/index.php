<?php

/** @var string $search */

?>

<!-- Layout -->
<?= $this->layout("Layouts/MainLayout", [
    "title" => $search,
    "search" => $search,
    "activeNav" => "",
]) ?>

<!-- START CONTENT SECTION -->
<!-- END CONTENT SECTION -->

<!-- START SCRIPTS SECTION -->
<?= $this->start("scripts"); ?>
<?= $this->stop(); ?>
<!-- END SCRIPTS SECTION -->

<!-- START STYLES SECTION -->
<?= $this->start("styles"); ?>
<?= $this->stop(); ?>
<!-- END STYLES SECTION -->