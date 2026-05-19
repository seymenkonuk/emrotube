<?php

use Seymen\PhpMvcTemplate\DTO\OptionDTO;

?>

<?php

/** @var string $deleteUrl */
/** @var array<OptionDTO> $countries */
/** @var array $errorMessages */
/** @var array $defaultValues */

?>

<!-- Layout -->
<?= $this->layout("Layouts/StudioLayout", [
    "title" => "Kullanıcıyı Düzenle",
    "activeNav" => "",
]) ?>

<!-- START CONTENT SECTION -->
<?= $this->insert("Components/Form/EditUser", [
    "countries" => $countries,
    "errorMessages" => $errorMessages,
    "defaultValues" => $defaultValues,
]) ?>

<?= $this->insert("Components/Form/Delete", [
    "url" => $deleteUrl,
    "title" => "Kullanıcıyı Kalıcı Olarak Sil",
    "description" => "Bu işlem sonrasında kullanıcı geri getirilemez. Kullanıcının silinmesini onaylıyor musunuz?",
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