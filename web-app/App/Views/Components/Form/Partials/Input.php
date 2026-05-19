<?php

/** @var string $id */
/** @var string $type */
/** @var string $placeholder */
/** @var string $value */
/** @var bool   $isRequire */
/** @var bool   $disabled */

?>

<input
    type="<?= $this->escape($type) ?>"
    id="<?= $this->escape($id) ?>"
    name="<?= $this->escape($id) ?>"
    placeholder="<?= $this->escape($placeholder) ?>"
    <?php if ($value !== ""): ?>
    value="<?= $this->escape($value) ?>"
    <?php endif ?>
    class="
        w-full border-none focus:outline-none text-gray-700 
        <?= ($disabled) ? 'cursor-not-allowed' : '' ?>
    "
    <?= ($isRequire) ? 'required' : '' ?>
    <?= ($disabled) ? 'disabled' : '' ?> />