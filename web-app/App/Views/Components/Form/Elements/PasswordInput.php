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
    "type" => "password",
    "placeholder" => $placeholder,
    "value" => $value,
    "isRequire" => $isRequire,
    "disabled" => $disabled,
]) ?>

<button
    type="button"
    class="text-gray-500 hover:text-gray-700 focus:outline-none"
    onclick="togglePassword(this)"
    <?= $disabled ? 'disabled' : '' ?>>
    <?= $this->insert("Components/Form/Partials/Icon", ["icon" => "bi-eye-slash"]) ?>
</button>