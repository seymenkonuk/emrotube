<?php

use Seymen\PhpMvcTemplate\DTO\LikedHeaderDTO;

?>

<?php

/** @var LikedHeaderDTO $header */

?>

<?= $this->layout("Components/Wrapper/Card") ?>

<!-- Banner -->
<div class="p-6 flex flex-col gap-4">
    <!-- Playlist başlığı -->
    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 truncate group-hover:text-blue-600 transition">
        Beğendiklerin
    </h1>

    <!-- Açıklama -->
    <p class="text-gray-600 text-sm line-clamp-2">
        Beğendiğin videolar ve içerikler tek bir yerde toplandı.
        En sevdiklerine buradan tekrar göz atabilirsin.
    </p>

    <!-- İstatistikler -->
    <div class="flex items-center gap-4 text-sm text-gray-500 flex-wrap">
        <span
            title="<?= $this->escape($header->videoCount) ?> video">
            <i class="bi bi-collection-play"></i>
            <?= $this->escape($header->videoCountFormatted) ?> video
        </span>
        <span>
            <i class="bi bi-clock"></i>
            Toplam <?= $this->escape($header->totalDurationFormatted) ?>
        </span>
    </div>
</div>