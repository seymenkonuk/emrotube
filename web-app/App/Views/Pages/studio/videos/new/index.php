<?php

use Seymen\PhpMvcTemplate\DTO\OptionDTO;

?>

<?php

/** @var array<OptionDTO> $viewTypes */
/** @var array<OptionDTO> $commentTypes */
/** @var array $errorMessages */
/** @var array $defaultValues */

?>

<!-- Layout -->
<?= $this->layout("Layouts/StudioLayout", [
    "title" => "Video Oluştur",
    "activeNav" => "",
]) ?>

<!-- START CONTENT SECTION -->
<?= $this->insert("Components/Form/NewVideo", [
    "viewTypes" => $viewTypes,
    "commentTypes" => $commentTypes,
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