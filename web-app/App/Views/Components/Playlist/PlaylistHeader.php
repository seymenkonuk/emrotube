<?php

use Seymen\PhpMvcTemplate\DTO\PlaylistHeaderDTO;

?>

<?php

/** @var PlaylistHeaderDTO $header */

?>

<?= $this->layout("Components/Wrapper/Card") ?>

<!-- Banner -->
<div class="w-full h-48 overflow-hidden relative rounded-t-xl">
    <img
        src="<?= $this->escape($header->banner) ?>"
        alt="Oynatma Listesi Kapak Resmi"
        class="w-full h-full object-cover" />

    <!-- Kanal bilgisi overlay -->
    <a
        href="<?= $this->escape($header->channelUrl) ?>"
        title="<?= $this->escape($header->channelTitle) ?>"
        class="absolute bottom-4 left-4 flex items-center gap-4 bg-black bg-opacity-50 px-4 py-2 rounded-lg hover:bg-opacity-70 transition">

        <img
            src="<?= $this->escape($header->channelAvatar) ?>"
            alt="Kanal Profil Resmi"
            class="w-12 h-12 rounded-full border-2 border-white shadow-md object-cover" />

        <span class="text-white font-semibold text-lg truncate"><?= $this->escape($header->channelTitle) ?></span>
    </a>
</div>

<!-- Playlist bilgileri -->
<div class="p-6 flex flex-col gap-4">
    <!-- Playlist başlığı -->
    <h1
        title="<?= $this->escape($header->title) ?>"
        class="text-2xl sm:text-3xl font-extrabold text-gray-900 truncate group-hover:text-blue-600 transition">
        <?= $this->escape($header->title) ?>
    </h1>

    <!-- Açıklama -->
    <?php if (isset($header->description)): ?>
        <p
            title="<?= $this->escape($header->description) ?>"
            class="text-gray-600 text-sm line-clamp-2">
            <?= $this->escape($header->description) ?>
        </p>
    <?php endif ?>

    <!-- İstatistikler -->
    <div class="flex items-center gap-4 text-sm text-gray-500 flex-wrap">
        <span title="<?= $this->escape($header->videoCount) ?> video">
            <i class="bi bi-collection-play"></i>
            <?= $this->escape($header->videoCountFormatted) ?> video
        </span>
        <span>
            <i class="bi bi-clock"></i>
            Toplam <?= $this->escape($header->totalDurationFormatted) ?>
        </span>
        <span>
            <i class="bi <?= $this->escape($header->viewType->icon) ?>"></i>
            <?= $this->escape($header->viewType->label) ?>
        </span>
    </div>
</div>