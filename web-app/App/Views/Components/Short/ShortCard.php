<?php

use Seymen\PhpMvcTemplate\DTO\ShortCardDTO;

?>

<?php

/** @var ShortCardDTO $short */

?>

<?= $this->layout("Components/Wrapper/Card") ?>

<!-- Kısa Video resmi ve ikonlar -->
<a
    href="<?= $this->escape($short->url) ?>"
    class="relative rounded-t-xl overflow-hidden aspect-[9/16]">
    <img
        src="<?= $this->escape($short->thumbnail) ?>"
        alt="Kısa Video Resmi"
        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />

    <!-- Sol üst köşedeki yuvarlak müzik ikonu -->
    <div
        class="absolute top-2 left-2 bg-black bg-opacity-70 rounded-full w-7 h-7 flex items-center justify-center shadow">
        <i class="bi bi-lightning-charge-fill text-white text-sm"></i>
    </div>

    <!-- Sağ alt köşedeki video süresi -->
    <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs font-semibold px-2 py-0.5 select-none">
        <?= $this->escape($short->durationFormatted) ?>
    </div>
</a>

<!-- Kısa Video metni, kanal ismi ve diğer bilgiler -->
<div class="p-4">
    <a
        href="<?= $this->escape($short->url) ?>"
        title="<?= $this->escape($short->title) ?>"
        class="block font-extrabold text-lg mb-2 text-gray-900 hover:text-blue-600 transition-colors duration-300 truncate">
        <?= $this->escape($short->title) ?>
    </a>

    <div class="flex items-center justify-between space-x-3">
        <!-- Kanal -->
        <a
            href="<?= $this->escape($short->channelUrl) ?>"
            title="<?= $this->escape($short->channelTitle) ?>"
            class="flex items-center gap-2 min-w-0">
            <img
                src="<?= $this->escape($short->channelAvatar) ?>"
                alt="Kanal Profil Resmi"
                class="rounded-full w-8 h-8 object-cover flex-shrink-0" />
            <span class="text-gray-800 font-semibold text-sm truncate hover:text-blue-600 transition-colors">
                <?= $this->escape($short->channelTitle) ?>
            </span>
        </a>

        <p
            title="<?= $this->escape($short->viewCount) ?> görüntüleme · <?= $this->escape($short->date) ?>"
            class="text-gray-600 text-sm truncate ml-auto">
            <?= $this->escape($short->viewCountFormatted) ?> görüntüleme · <?= $this->escape($short->dateFormatted) ?>
        </p>
    </div>
</div>