<?php

/** @var string $url */
/** @var string $title */
/** @var string $description */
/** @var string $channelCode */
/** @var bool   $disabled */

?>

<?php
$disabled = $disabled ?? false;
?>

<?= $this->layout("Components/Wrapper/PostForm", [
    "action" => $url,
]) ?>

<!-- Sil -->
<?= $this->insert("Components/Form/Elements/Title", ["text" => $title]) ?>

<p>
    <?= $this->escape($description) ?>
</p>

<input type="hidden" name="channel_code" value="<?= $channelCode; ?>">

<?= $this->insert("Components/Form/Elements/Submit", [
    "text" => "Aktif Kanal Olarak Belirle",
    "icon" => "bi-check",
    "color" => "bg-blue-500",
    "hoverColor" => "bg-blue-600",
    "textColor" => "text-white",
    "disabled" => $disabled,
]) ?>