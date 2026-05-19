<?php

use Seymen\PhpMvcTemplate\DTO\OptionDTO;

?>

<?php

/** @var string $deleteUrl */
/** @var array<OptionDTO> $viewTypes */
/** @var array<OptionDTO> $commentTypes */
/** @var array $errorMessages */
/** @var array $defaultValues */

?>
<!-- Layout -->
<?= $this->layout("Layouts/StudioLayout", [
    "title" => "Shorts Düzenle",
    "activeNav" => "",
]) ?>

<!-- START CONTENT SECTION -->
<?= $this->insert("Components/Form/EditShort", [
    "viewTypes" => $viewTypes,
    "commentTypes" => $commentTypes,
    "errorMessages" => $errorMessages,
    "defaultValues" => $defaultValues,
    "captions" => [],
]) ?>

<?= $this->insert("Components/Form/Delete", [
    "url" => $deleteUrl,
    "title" => "Kısa Videoyu Kalıcı Olarak Sil",
    "description" => "Bu işlem sonrasında kısa video geri getirilemez. Kısa videonun silinmesini onaylıyor musunuz?",
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