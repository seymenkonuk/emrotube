<?php

use Seymen\PhpMvcTemplate\DTO\CategoryCardDTO;

?>

<?php

/** @var CategoryCardDTO $category */

?>

<?= $this->layout("Components/Wrapper/Card") ?>

<!-- Kategori resmi -->
<a
    href="<?= $this->escape($category->url) ?>"
    class="relative rounded-t-xl overflow-hidden aspect-video block">
    <img
        src="<?= $this->escape($category->banner) ?>"
        alt="Kategori Kapak Resmi"
        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />

    <!-- Üst sol kategori ikonu -->
    <div class="absolute top-2 left-2 bg-black bg-opacity-70 rounded-full w-8 h-8 flex items-center justify-center shadow">
        <i class="bi bi-tags-fill text-white text-base"></i>
    </div>
</a>

<!-- Kategori bilgileri -->
<div class="p-4 flex flex-col flex-grow">
    <!-- Kategori başlığı -->
    <a
        href="<?= $this->escape($category->url) ?>"
        title="<?= $this->escape($category->title) ?>"
        class="block font-extrabold text-lg mb-1 text-gray-900 hover:text-blue-600 transition-colors truncate">
        <?= $this->escape($category->title) ?>
    </a>

    <!-- kategori açıklaması -->
    <?php if (isset($category->description)): ?>
        <p
            title="<?= $this->escape($category->description) ?>"
            class="text-gray-600 text-sm mb-3 line-clamp-2">
            <?= $this->escape($category->description) ?>
        </p>
    <?php endif ?>

    <!-- Video sayısı badge -->
    <span
        title="<?= $this->escape($category->videoCount) ?> video"
        class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded-lg self-start">
        <?= $this->escape($category->videoCountFormatted) ?> video
    </span>
</div>