<?php

use Seymen\PhpMvcTemplate\DTO\CategoryHeaderDTO;

?>

<?php

/** @var CategoryHeaderDTO $header */

?>

<?= $this->layout("Components/Wrapper/Card") ?>

<!-- Banner -->
<div class="w-full h-48 overflow-hidden relative rounded-t-xl">
    <img
        src="<?= $this->escape($header->banner) ?>"
        alt="Kategori Kapak Resmi"
        class="w-full h-full object-cover" />
</div>

<!-- Kategori bilgileri -->
<div class="p-6 flex flex-col gap-4">
    <!-- Kategori başlığı -->
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

    <!-- Video sayısı -->
    <div
        title="<?= $this->escape($header->videoCount) ?> video"
        class="flex items-center gap-2 text-gray-500 text-sm">
        <i class="bi bi-play-circle"></i>
        <span> <?= $this->escape($header->videoCountFormatted) ?> video</span>
    </div>
</div>