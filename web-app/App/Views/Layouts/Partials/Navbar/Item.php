<?php

/** @var string $href */
/** @var string $icon */
/** @var string $text */
/** @var bool $isActive */

?>

<a
    href="<?= $this->escape($href) ?>"
    class="flex items-center px-3 py-2 rounded hover:bg-gray-200 
    <?php if ($isActive): ?> bg-gray-200 font-semibold <?php endif ?>">
    <?= $this->insert("Layouts/Partials/Navbar/Icon", ["icon" => $icon]) ?>
    <?= $this->escape($text) ?>
</a>