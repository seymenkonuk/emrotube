<?php

use Seymen\PhpMvcTemplate\DTO\ChannelCardDTO;

?>

<?php

/** @var ChannelCardDTO $channel */

?>

<?= $this->layout("Components/Wrapper/Card") ?>

<!-- Üst Parça -->
<div class="flex items-center p-4 space-x-4">
    <!-- Kanal fotoğrafı -->
    <a
        href="<?= $this->escape($channel->url) ?>"
        class="flex-shrink-0">
        <img
            src="<?= $this->escape($channel->avatar) ?>"
            alt="Kanal Profil Resmi"
            class="rounded-full w-16 h-16 object-cover border border-gray-300" />
    </a>

    <!-- Kanal bilgileri -->
    <div class="flex flex-col min-w-0">
        <a
            href="<?= $this->escape($channel->url) ?>"
            title="<?= $this->escape($channel->title) ?>"
            class="font-bold text-lg text-gray-900 hover:text-blue-600 transition-colors truncate">
            <?= $this->escape($channel->title) ?>
        </a>
        <p
            title="<?= $this->escape($channel->subscriberCount) ?> Abone · <?= $this->escape($channel->videoCount) ?> Video"
            class="text-sm text-gray-600 truncate">
            <?= $this->escape($channel->subscriberCountFormatted) ?> Abone · <?= $this->escape($channel->videoCountFormatted) ?> Video
        </p>
    </div>
</div>

<!-- Alt Parça -->
<div class="flex items-center justify-between px-4 pb-4 space-x-3">
    <?= $this->insert("Components/Channel/SubscribeButton", [
        "subscriptionInfo" => $channel->subscriptionInfo,
    ]) ?>
    <?= $this->insert("Components/Form/Elements/LinkButton", [
        "text" => "Kanalı Görüntüle",
        "href" => $channel->url,
        "color" => "bg-gray-500",
        "hoverColor" => "bg-gray-600",
        "textColor" => "text-white",
    ]) ?>
</div>