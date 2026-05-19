<?php

/** @var string $id */
/** @var string $icon */
/** @var string $label */
/** @var string $description */
/** @var string|array $errorMessage */
/** @var string $accept */
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

<input
    type="file"
    id="<?= $this->escape($id) ?>"
    name="<?= $this->escape($id) ?>"
    accept="<?= $this->escape($accept) ?>"
    class="
        w-full text-gray-700 hover:file:bg-blue-100 
        file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 
        <?= ($disabled) ? 'cursor-not-allowed' : 'cursor-pointer' ?>
        <?= ($disabled) ? 'file:cursor-not-allowed' : 'file:cursor-pointer' ?>
    "
    <?= ($isRequire) ? 'required' : '' ?>
    <?= ($disabled) ? 'disabled' : '' ?> />