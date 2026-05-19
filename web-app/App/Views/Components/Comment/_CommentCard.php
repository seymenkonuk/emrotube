<?php

use Seymen\PhpMvcTemplate\DTO\CommentCardDTO;

?>

<?php

/** @var CommentCardDTO $comment */

?>

<?= $this->layout("Components/Wrapper/Card") ?>

<!-- Ana Yorum -->
<div class="flex space-x-3 p-4">
    <!-- Kanal resmi -->
    <a
        href="<?= $this->escape($comment->channelUrl) ?>"
        class="flex-shrink-0">
        <img
            src="<?= $this->escape($comment->channelAvatar) ?>"
            alt="Kanal Resmi"
            class="w-10 h-10 rounded-full object-cover">
    </a>

    <div class="flex-1">
        <!-- Kullanıcı adı + tarih -->
        <div class="flex items-center justify-between">
            <a
                href="<?= $this->escape($comment->channelUrl) ?>"
                title="<?= $this->escape($comment->channelTitle) ?>"
                class="font-semibold text-gray-900 hover:text-blue-600 transition-colors duration-200">
                <?= $this->escape($comment->channelTitle) ?>
            </a>
            <span
                title="<?= $this->escape($comment->date) ?>"
                class="text-xs text-gray-500">
                <?= $this->escape($comment->dateFormatted) ?>
            </span>
        </div>

        <!-- Yorum metni -->
        <p class="text-gray-700 mt-1">
            <?= $this->escape($comment->message) ?>
        </p>

        <!-- Aksiyon butonları -->
        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-600">
            <button class="flex items-center space-x-1 hover:text-blue-600">
                <i class="bi bi-hand-thumbs-up"></i>
                <span title="<?= $this->escape($comment->likeCount) ?>">
                    <?= $this->escape($comment->likeCountFormatted) ?>
                </span>
            </button>
            <button class="flex items-center space-x-1 hover:text-blue-600">
                <i class="bi bi-hand-thumbs-down"></i>
                <span title="<?= $this->escape($comment->dislikeCount) ?>">
                    <?= $this->escape($comment->dislikeCountFormatted) ?>
                </span>
            </button>
            <button class="flex items-center space-x-1 hover:text-blue-600">
                <i class="bi bi-reply"></i>
                <span>Yanıtla</span>
            </button>
        </div>
    </div>
</div>