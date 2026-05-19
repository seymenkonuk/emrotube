<?php

/** @var string $id */
/** @var string $icon */
/** @var string $label */
/** @var string $description */
/** @var string|array $errorMessage */
/** @var string $text */
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

<input
    type="checkbox"
    id="<?= $this->escape($id) ?>"
    name="<?= $this->escape($id) ?>"
    <?php if ($value !== ""): ?>
    value="<?= $this->escape($value) ?>"
    <?php endif ?>
    class="
        w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 
        <?= ($disabled) ? 'cursor-not-allowed' : 'cursor-pointer' ?>
    "
    <?= ($isRequire) ? 'required' : '' ?>
    <?= ($disabled) ? 'disabled' : '' ?>>

<label
    for="<?= $this->escape($id) ?>"
    class="ml-3 text-gray-700 cursor-pointer">
    <?= $this->escape($text) ?>
</label>