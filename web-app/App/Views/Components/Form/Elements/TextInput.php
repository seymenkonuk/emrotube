<?php

/** @var string $id */
/** @var string $icon */
/** @var string $label */
/** @var string $placeholder */
/** @var string $description */
/** @var string|array $errorMessage */
/** @var string $value */
/** @var bool   $isRequire */
/** @var bool   $disabled */

?>

<?= $this->layout("Components/Form/Partials/InputWrapper", [
    "id" => $id,
    "icon" => $icon,
    "label" => $label,
    "description" => $description,
    "errorMessage" => $errorMessage,
    "isRequire" => $isRequire,
    "disabled" => $disabled,
]) ?>

<?= $this->insert("Components/Form/Partials/Input", [
    "id" => $id,
    "type" => "text",
    "placeholder" => $placeholder,
    "value" => $value,
    "isRequire" => $isRequire,
    "disabled" => $disabled,
]) ?>
