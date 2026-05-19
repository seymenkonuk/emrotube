<?php

use Seymen\PhpMvcTemplate\DTO\PlaylistCardDTO;

?>

<?php

/** @var PlaylistCardDTO $playlist */

?>

<?= $this->layout("Components/Wrapper/Card") ?>

<!-- Playlist Kapak Resmi -->
<a
    href="<?= $this->escape($playlist->url) ?>"
    class="relative w-full aspect-video overflow-hidden rounded-t-xl">

    <img
        src="<?= $this->escape($playlist->banner) ?>"
        alt="Oynatma Listesi Kapak Resmi"
        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />

    <!-- Playlist ikon + toplam video sayısı -->
    <div
        title="<?= $this->escape($playlist->videoCount) ?> video"
        class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-white font-semibold text-lg">
        <i class="bi bi-list-ul text-3xl mb-2"></i>
        <?= $this->escape($playlist->videoCountFormatted) ?> video
    </div>
</a>

<!-- İçerik -->
<div class="p-4 flex flex-col gap-3">
    <!-- Başlık -->
    <a
        href="<?= $this->escape($playlist->url) ?>"
        title="<?= $this->escape($playlist->title) ?>"
        class="font-extrabold text-lg text-gray-900 hover:text-blue-600 transition-colors truncate">
        <?= $this->escape($playlist->title) ?>
    </a>

    <!-- Kanal + Görünürlük -->
    <div class="flex items-center justify-between">
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

        <!-- Görünürlük -->
        <span class="flex items-center gap-1 text-gray-500 text-sm">
            <i class="bi <?= $this->escape($playlist->viewType->icon) ?>"></i>
            <?= $this->escape($playlist->viewType->label) ?>
        </span>
    </div>
</div>