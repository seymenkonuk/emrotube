<?php

/** @var string $url */
/** @var string $title */
/** @var string $description */
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

<?= $this->insert("Components/Form/Elements/Submit", [
    "text" => "Kalıcı Olarak Sil",
    "icon" => "bi-trash",
    "color" => "bg-red-500",
    "hoverColor" => "bg-red-600",
    "textColor" => "text-white",
    "disabled" => $disabled,
]) ?>