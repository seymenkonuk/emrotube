<?php

use Seymen\PhpMvcTemplate\DTO\OptionDTO;

?>

<?php

/** @var string             $id */
/** @var string             $icon */
/** @var string             $label */
/** @var string             $description */
/** @var string|array             $errorMessage */
/** @var OptionDTO          $default */
/** @var array<OptionDTO>   $options */
/** @var string             $value */
/** @var bool               $isRequire */
/** @var bool               $disabled */

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

<select
    id="<?= $this->escape($id) ?>"
    name="<?= $this->escape($id) ?>"
    <?= ($isRequire) ? 'required' : '' ?>
    <?= ($disabled) ? 'disabled' : '' ?>
    class="
        w-full border-none focus:outline-none text-gray-700 bg-transparent
        <?= ($disabled) ? 'cursor-not-allowed' : 'cursor-pointer' ?>
    ">

    <option value="<?= $this->escape($default->value) ?>">
        <?= $this->escape($default->title) ?>
    </option>

    <?php foreach ($options as $option): ?>
        <option
            value="<?= $this->escape($option->value) ?>"
            <?= ((string)$value === $option->value) ? 'selected' : '' ?>>
            <?= $this->escape($option->title) ?>
        </option>
    <?php endforeach ?>
</select>