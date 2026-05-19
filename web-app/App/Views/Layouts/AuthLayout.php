<?php

use Seymen\PhpMvcTemplate\Config\AppConfig;

?>

<?php

/** @var string $title */

?>

<?php
$brandName = AppConfig::APP_NAME;
?>

<!-- Layout -->
<?= $this->layout("Layouts/BaseLayout", ["title" => $title]) ?>

<!-- START CONTENT SECTION -->
<div class="min-h-screen w-full flex items-center justify-center p-6">
    <?= $this->section('content') ?>
</div>
<!-- END CONTENT SECTION -->

<!-- START SCRIPTS SECTION -->
<?= $this->start("scripts"); ?>
<?= $this->section("scripts"); ?>
<?= $this->stop(); ?>
<!-- END SCRIPTS SECTION -->

<!-- START STYLES SECTION -->
<?= $this->start("styles"); ?>
<?= $this->section("styles"); ?>
<?= $this->stop(); ?>
<!-- END STYLES SECTION -->