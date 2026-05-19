<?php

/** @var string $deleteUrl */
/** @var string $channelCode */
/** @var string $changeActiveChannelUrl */
/** @var array $errorMessages */
/** @var array $defaultValues */
/** @var bool  $isActive */

?>

<!-- Layout -->
<?= $this->layout("Layouts/StudioLayout", [
    "title" => "Kanal Düzenle",
    "activeNav" => "",
]) ?>

<!-- START CONTENT SECTION -->
<?= $this->insert("Components/Form/ChangeActiveChannel", [
    "url" => $changeActiveChannelUrl,
    "channelCode" => $channelCode,
    "title" => "Hesap Değiştir",
    "description" => "Bu işlem sonrasında seçtiğiniz kanala geçiş yapacaksınız.",
    "disabled" => $isActive,
]) ?>

<?= $this->insert("Components/Form/EditChannel", [
    "errorMessages" => $errorMessages,
    "defaultValues" => $defaultValues,
]) ?>

<?= $this->insert("Components/Form/Delete", [
    "url" => $deleteUrl,
    "title" => "Kanalı Kalıcı Olarak Sil",
    "description" => "Bu işlem sonrasında kanal geri getirilemez. Kanalın silinmesini onaylıyor musunuz?",
    "disabled" => !$isActive,
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