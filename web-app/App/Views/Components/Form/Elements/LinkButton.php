<?php

/** @var string $text */
/** @var string $href */
/** @var string $icon */
/** @var string $color */
/** @var string $hoverColor */
/** @var string $textColor */

?>

<a
    href="<?= $this->escape($href) ?>"
    class="
        flex-1
        <?= $this->escape($color) ?>
        hover:<?= $this->escape($hoverColor) ?>
        <?= $this->escape($textColor) ?> 
        px-4 py-2 rounded-lg font-semibold shadow-md transition flex items-center justify-center space-x-2
    ">
    <i class="bi <?= $this->escape($icon) ?> text-lg"></i>
    <span><?= $this->escape($text) ?></span>
</a>