<?php

use Seymen\PhpMvcTemplate\DTO\VideoCardDTO;

?>

<?php

/** @var VideoCardDTO $video */

?>

<?= $this->layout("Components/Wrapper/Card") ?>

<!-- Video resmi ve ikonlar -->
<a
    href="<?= $this->escape($video->url) ?>"
    class="relative rounded-t-xl overflow-hidden aspect-video">
    <img
        src="<?= $this->escape($video->thumbnail) ?>"
        alt="Video Resmi"
        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />

    <!-- Sağ alt köşedeki video süresi -->
    <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs font-semibold px-2 py-0.5 select-none">
        <?= $this->escape($video->durationFormatted) ?>
    </div>
</a>

<!-- Video metni, kanal ismi ve diğer bilgiler -->
<div class="p-4">
    <a
        href="<?= $this->escape($video->url) ?>"
        title="<?= $this->escape($video->title) ?>"
        class="block font-extrabold text-lg mb-2 text-gray-900 hover:text-blue-600 transition-colors duration-300 truncate">
        <?= $this->escape($video->title) ?>
    </a>

    <div class="flex items-center justify-between space-x-3">
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

        <p
            title="<?= $this->escape($video->viewCount) ?> görüntüleme · <?= $this->escape($video->date) ?>"
            class="text-gray-600 text-sm truncate ml-auto">
            <?= $this->escape($video->viewCountFormatted) ?> görüntüleme · <?= $this->escape($video->dateFormatted) ?>
        </p>
    </div>
</div>