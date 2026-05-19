<?php

use Seymen\PhpMvcTemplate\DTO\ChannelHeaderDTO;

?>

<?php

/** @var ChannelHeaderDTO $header */

?>

<!-- Layout -->
<?= $this->layout("Layouts/MainLayout", [
    "title" => $header->title,
    "activeNav" => "",
]) ?>

<!-- START CONTENT SECTION -->
<section class="grid grid-cols-1 gap-6">
    <?= $this->insert("Components/Channel/ChannelHeader", [
        "header" => $header,
        "activeNav" => "",
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