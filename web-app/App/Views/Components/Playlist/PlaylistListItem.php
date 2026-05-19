<?php

use Seymen\PhpMvcTemplate\DTO\PlaylistListItemDTO;

?>

<?php

/** @var PlaylistListItemDTO $playlist */

?>

<div
    class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md hover:shadow-xl transition duration-300 cursor-pointer group border border-gray-200 hover:border-blue-400 flex items-center p-4 gap-4">

    <!-- Sıra numarası -->
    <?php if ($playlist->order !== 0): ?>
        <div class="w-10 text-center font-extrabold text-gray-700 text-lg flex-shrink-0">
            <?= $this->escape($playlist->order) ?>
        </div>
    <?php endif ?>

    <!-- Oynatma listesi resmi -->
    <a
        href="<?= $this->escape($playlist->url) ?>"
        class="relative rounded-xl overflow-hidden w-[20%] aspect-video">
        <img
            src="<?= $this->escape($playlist->banner) ?>"
            alt="Oynatma Listesi Resmi"
            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" />

        <!-- Sol üst köşedeki yuvarlak ikon -->
        <div
            class="absolute top-2 left-2 bg-black bg-opacity-70 rounded-full w-7 h-7 flex items-center justify-center shadow">
            <i class="bi bi-collection-play-fill text-white text-sm"></i>
        </div>

        <!-- Sağ alt köşedeki video sayısı -->
        <div
            title="<?= $this->escape($playlist->videoCount) ?> video"
            class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs font-semibold px-2 py-0.5 select-none">
            <?= $this->escape($playlist->videoCountFormatted) ?> video
        </div>
    </a>

    <!-- Oynatma listesi bilgileri -->
    <div class="flex flex-col flex-grow min-w-0 gap-1">
        <!-- Başlık -->
        <a
            href="<?= $this->escape($playlist->url) ?>"
            title="<?= $this->escape($playlist->title) ?>"
            class="font-extrabold text-base text-gray-900 hover:text-blue-600 transition-colors truncate">
            <?= $this->escape($playlist->title) ?>
        </a>

        <!-- Kanal -->
        <a
            href="<?= $this->escape($playlist->channelUrl) ?>"
            title="<?= $this->escape($playlist->channelTitle) ?>"
            class="flex items-center gap-2 min-w-0">
            <img
                src="<?= $this->escape($playlist->channelAvatar) ?>"
                alt="Kanal Resmi"
                class="rounded-full w-8 h-8 object-cover flex-shrink-0" />
            <span class="text-gray-800 font-semibold text-sm truncate hover:text-blue-600 transition-colors">
                <?= $this->escape($playlist->channelTitle) ?>
            </span>
        </a>
    </div>
</div>