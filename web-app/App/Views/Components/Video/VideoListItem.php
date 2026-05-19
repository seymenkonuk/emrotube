<?php

use Seymen\PhpMvcTemplate\DTO\MediaListItemDTO;

?>

<?php

/** @var MediaListItemDTO $video */

?>

<div
    class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md hover:shadow-xl transition duration-300 cursor-pointer group border border-gray-200 hover:border-blue-400 flex items-center p-4 gap-4">

    <!-- Sıra numarası -->
    <?php if ($video->order !== 0): ?>
        <div class="w-10 text-center font-extrabold text-gray-700 text-lg flex-shrink-0">
            <?= $this->escape($video->order) ?>
        </div>
    <?php endif ?>

    <!-- Video resmi -->
    <a
        href="<?= $this->escape($video->url) ?>"
        class="relative rounded-xl overflow-hidden w-[20%] aspect-video">
        <img
            src="<?= $this->escape($video->thumbnail) ?>"
            alt="Video Resmi"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />

        <!-- Sağ alt köşedeki video süresi -->
        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs font-semibold px-2 py-0.5 select-none">
            <?= $this->escape($video->durationFormatted) ?>
        </div>
    </a>

    <!-- Video bilgileri -->
    <div class="flex flex-col flex-grow min-w-0 gap-1">
        <!-- Başlık -->
        <a
            href="<?= $this->escape($video->url) ?>"
            title="<?= $this->escape($video->title) ?>"
            class="font-extrabold text-base text-gray-900 hover:text-blue-600 transition-colors truncate">
            <?= $this->escape($video->title) ?>
        </a>

        <!-- Kanal -->
        <a
            href="<?= $this->escape($video->channelUrl) ?>"
            title="<?= $this->escape($video->channelTitle) ?>"
            class="flex items-center gap-2 min-w-0">
            <img
                src="<?= $this->escape($video->channelAvatar) ?>"
                alt="Kanal Profil Resmi"
                class="rounded-full w-8 h-8 object-cover flex-shrink-0" />
            <span class="text-gray-800 font-semibold text-sm truncate hover:text-blue-600 transition-colors">
                <?= $this->escape($video->channelTitle) ?>
            </span>
        </a>

        <!-- Alt bilgiler -->
        <p
            title="<?= $this->escape($video->viewCount) ?> görüntüleme · <?= $this->escape($video->date) ?>"
            class="text-gray-500 text-xs mt-1 truncate">
            <?= $this->escape($video->viewCountFormatted) ?> görüntüleme · <?= $this->escape($video->dateFormatted) ?>
        </p>
    </div>
</div>