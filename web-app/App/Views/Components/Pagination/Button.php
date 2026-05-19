<?php

/** @var ?string $leftText */
/** @var ?string $rightText */
/** @var string $icon */
/** @var string $href */
/** @var bool   $isActive */

?>

<?php if ($isActive): ?>
    <a
        href="<?= $this->escape($href) ?>"
        class="
            flex items-center bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md border border-gray-200 p-4
            hover:shadow-xl transition-shadow duration-300 hover:border-blue-400 gap-2
        ">
        <?= $this->escape($leftText ?? "") ?>
        <i class="bi <?= $this->escape($icon) ?>"></i>
        <?= $this->escape($rightText ?? "") ?>
    </a>
<?php else: ?>
    <button
        disabled
        class="
            flex items-center bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md border border-gray-200 p-4
            text-gray-400 opacity-50 cursor-not-allowed pointer-events-none
        ">
        <?= $this->escape($leftText ?? "") ?>
        <i class="bi <?= $this->escape($icon) ?>"></i>
        <?= $this->escape($rightText ?? "") ?>
    </button>
<?php endif ?>