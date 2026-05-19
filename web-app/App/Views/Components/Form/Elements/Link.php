<?php

/** @var string $label */
/** @var string $text */
/** @var string $href */

?>

<p class="text-center text-sm text-gray-600 mt-4">
    <?= $this->escape($label) ?>
    <a
        href="<?= $this->escape($href) ?>"
        class="text-blue-500 hover:underline font-semibold">
        <?= $this->escape($text) ?>
    </a>
</p>