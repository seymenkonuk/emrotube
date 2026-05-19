<?php

/** @var ?string    $id */
/** @var string     $text */
/** @var string     $icon */
/** @var string     $color */
/** @var string     $hoverColor */
/** @var string     $textColor */

?>

<button
    <?php if (isset($id)): ?>
    id="<?= $this->escape($id) ?>"
    <?php endif ?>
    type="button"
    class="
        flex-1
        <?= $this->escape($color) ?>
        hover:<?= $this->escape($hoverColor) ?>
        <?= $this->escape($textColor) ?> 
        px-4 py-2 rounded-lg font-semibold shadow-md transition flex items-center justify-center space-x-2
    ">
    <i class="bi <?= $this->escape($icon) ?> text-lg"></i>
    <span><?= $this->escape($text) ?></span>
</button>