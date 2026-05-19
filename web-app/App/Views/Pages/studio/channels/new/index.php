<?php

/** @var array $errorMessages */
/** @var array $defaultValues */

?>

<!-- Layout -->
<?= $this->layout("Layouts/StudioLayout", [
    "title" => "Kanal Oluştur",
    "activeNav" => "",
]) ?>

<!-- START CONTENT SECTION -->
<?= $this->insert("Components/Form/NewChannel", [
    "errorMessages" => $errorMessages,
    "defaultValues" => $defaultValues,
]) ?>
<!-- END CONTENT SECTION -->

<!-- START SCRIPTS SECTION -->
<?= $this->start("scripts"); ?>
<?= $this->stop(); ?>
<!-- END SCRIPTS SECTION -->

<!-- START STYLES SECTION -->
<?= $this->start("styles"); ?>
<?= $this->stop(); ?>
<!-- END STYLES SECTION -->