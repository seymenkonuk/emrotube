<?php

/** @var string $text */
/** @var string $icon */
/** @var string $color */
/** @var string $hoverColor */
/** @var string $textColor */
/** @var bool   $disabled */

?>

<?php
$disabled = $disabled ?? false;
?>

<button
    type="submit"
    class="
        w-full
        <?= $this->escape($color) ?>
        hover:<?= $this->escape($hoverColor) ?>
        <?= $this->escape($textColor) ?> 
        px-4 py-2 rounded-lg font-semibold shadow-md transition flex items-center justify-center space-x-2
        <?= $disabled
            ? 'cursor-not-allowed opacity-60'
            : ''
        ?>
    "

    <?= ($disabled) ? 'disabled' : '' ?>>
    <i class="bi <?= $this->escape($icon) ?> text-lg"></i>
    <span><?= $this->escape($text) ?></span>
</button>