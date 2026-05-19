<?php

use Seymen\PhpMvcTemplate\DTO\ChannelHeaderDTO;

?>

<?php

/** @var ChannelHeaderDTO   $header */
/** @var ?string            $activeNav */
/** @var ?array             $navItems */

?>

<?php

$navItems = $navItems ?? [
    ["text" => "Ana Sayfa", "href" => ""],
    ["text" => "Videolar", "href" => "/videos"],
    ["text" => "Shorts", "href" => "/shorts"],
    ["text" => "Müzikler", "href" => "/musics"],
    ["text" => "Oynatma Listeleri", "href" => "/playlists"],
    ["text" => "Abonelikler", "href" => "/subscriptions"],
    ["text" => "Hakkında", "href" => "/details"],
];
?>

<?= $this->layout("Components/Wrapper/Card") ?>

<!-- 1. Banner -->
<div class="w-full aspect-[4/1] overflow-hidden rounded-t-xl">
    <img
        src="<?= $this->escape($header->banner) ?>"
        alt="Kanal Kapak Resmi"
        class="w-full h-full object-cover" />
</div>

<!-- 2. Kanal bilgileri -->
<div class="flex items-center p-6">
    <!-- Sol: Profil fotoğrafı -->
    <div class="flex-shrink-0">
        <img
            src="<?= $this->escape($header->avatar) ?>"
            alt="Kanal Profil Resmi"
            class="w-32 h-32 rounded-full border-4 border-white shadow-md object-cover" />
    </div>

    <!-- Sağ: Kanal bilgileri -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between w-full ml-4">
        <div>
            <h1
                title="<?= $this->escape($header->title) ?>"
                class="text-2xl font-extrabold text-gray-900">
                <?= $this->escape($header->title) ?>
            </h1>
            <p
                title="<?= $this->escape($header->subscriberCount) ?> Abone · <?= $this->escape($header->videoCount) ?> Video"
                class="text-gray-600 text-sm">
                <?= $this->escape($header->subscriberCountFormatted) ?> Abone · <?= $this->escape($header->videoCountFormatted) ?> Video
            </p>
        </div>
        <div class="mt-3 sm:mt-0 text-white font-semibold">
            <?= $this->insert("Components/Channel/SubscribeButton", [
                "subscriptionInfo" => $header->subscriptionInfo,
            ]) ?>
        </div>
    </div>
</div>

<!-- 3. Navigasyon -->
<div class="border-t border-gray-200 mt-4">
    <nav class="flex flex-nowrap overflow-x-auto px-6 py-3 gap-x-6 gap-y-2 scrollbar-hide">

        <?php foreach ($navItems as $navItem): ?>
            <a
                href="<?= $this->escape($header->url) ?><?= $this->escape($navItem["href"]) ?>"
                class="
                    hover:text-blue-600 transition-colors whitespace-nowrap
                    <?= ($activeNav === $navItem["href"]) ? "text-blue-600 font-semibold border-b-2 border-blue-600 pb-1" : "" ?>
                ">
                <?= $this->escape($navItem["text"]) ?>
            </a>
        <?php endforeach ?>
    </nav>
</div>