<!-- Layout -->
<?= $this->layout("Layouts/MainLayout", [
    "auth" => null,
    "title" => "Çevrimdışı",
]) ?>

<!-- START CONTENT SECTION -->
<?= $this->section('content') ?>
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