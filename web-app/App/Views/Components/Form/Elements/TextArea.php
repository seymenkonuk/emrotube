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

<textarea
    id="<?= $this->escape($id) ?>"
    name="<?= $this->escape($id) ?>"
    placeholder="<?= $this->escape($placeholder) ?>"
    <?= $disabled ? "disabled" : "" ?>
    <?= $isRequire ? "required" : "" ?>
    rows="1"
    oninput="autoResize(this)"
    class="flex-1 bg-transparent border-0 focus:ring-0 focus:outline-none resize-none"><?= $this->escape($value) ?></textarea>