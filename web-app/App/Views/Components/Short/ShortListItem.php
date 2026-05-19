<?php

use Seymen\PhpMvcTemplate\DTO\MediaListItemDTO;

?>

<?php

/** @var MediaListItemDTO $short */

?>

<div
    class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md hover:shadow-xl transition duration-300 cursor-pointer group border border-gray-200 hover:border-blue-400 flex items-center p-4 gap-4">

    <!-- Sıra numarası -->
    <?php if ($short->order !== 0): ?>
        <div class="w-10 text-center font-extrabold text-gray-700 text-lg flex-shrink-0">
            <?= $this->escape($short->order) ?>
        </div>
    <?php endif ?>

    <!-- Kısa Video resmi -->
    <a
        href="<?= $this->escape($short->url) ?>"
        class="relative rounded-xl overflow-hidden w-[20%] aspect-video">
        <img
            src="<?= $this->escape($short->thumbnail) ?>"
            alt="Kısa Video Resmi"
            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" />

        <!-- Sol üst köşedeki yuvarlak ikon -->
        <div
            class="absolute top-2 left-2 bg-black bg-opacity-70 rounded-full w-7 h-7 flex items-center justify-center shadow">
            <i class="bi bi-lightning-charge-fill text-white text-sm"></i>
        </div>

        <!-- Sağ alt köşedeki video süresi -->
        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs font-semibold px-2 py-0.5 select-none">
            <?= $this->escape($short->durationFormatted) ?>
        </div>
    </a>

    <!-- Video bilgileri -->
    <div class="flex flex-col flex-grow min-w-0 gap-1">
        <!-- Başlık -->
        <a
            href="<?= $this->escape($short->url) ?>"
            title="<?= $this->escape($short->title) ?>"
            class="font-extrabold text-base text-gray-900 hover:text-blue-600 transition-colors truncate">
            <?= $this->escape($short->title) ?>
        </a>

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

        <!-- Alt bilgiler -->
        <p
            title="<?= $this->escape($short->viewCount) ?> görüntüleme · <?= $this->escape($short->date) ?>"
            class="text-gray-500 text-xs mt-1 truncate">
            <?= $this->escape($short->viewCountFormatted) ?> görüntüleme · <?= $this->escape($short->dateFormatted) ?>
        </p>
    </div>
</div>