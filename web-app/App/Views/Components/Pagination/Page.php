<?php

/** @var string $text */
/** @var string $href */
/** @var bool   $isActive */

?>

<?php if ($isActive): ?>
    <a
        href="<?= $this->escape($href) ?>"
        class="
            flex items-center bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md border border-gray-200 p-4
            hover:shadow-xl transition-shadow duration-300 hover:border-blue-400
        ">
        <?= $this->escape($text ?? "") ?>
    </a>
<?php else: ?>
    <button
        disabled
        class="
            flex items-center bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md border p-4
            text-blue-400 border-blue-400 cursor-not-allowed pointer-events-none
        ">
        <?= $this->escape($text ?? "") ?>
    </button>
<?php endif ?>