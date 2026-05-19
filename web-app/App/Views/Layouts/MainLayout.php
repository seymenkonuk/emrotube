<?php

use Seymen\PhpMvcTemplate\Config\AppConfig;
use Seymen\PhpMvcTemplate\Models\UserAuth;
use Seymen\PhpMvcTemplate\Services\AuthService;

?>

<?php

/** @var string $title */
/** @var ?string $search */
/** @var ?string $activeNav */
/** @var ?array $navMenus */
/** @var ?UserAuth $auth */

?>

<?php

$search = $search ?? "";
$brandName = AppConfig::APP_NAME;
$auth = $auth ?? (new AuthService())->getAuth();
$auth = $auth?->code != "" ? $auth : null;
$activeNav = $activeNav ?? "";
$navMenus = $navMenus ?? ($auth !== null ? [
    "" => [
        ["href" => "/", "text" => "Ana Sayfa", "icon" => "bi-house-door-fill"],
        ["href" => "/videos", "text" => "Videolar", "icon" => "bi-play-btn-fill"],
        ["href" => "/shorts", "text" => "Shorts", "icon" => "bi-lightning-charge-fill"],
        ["href" => "/musics", "text" => "Müzikler", "icon" => "bi-music-note-beamed"],
        ["href" => "/channels", "text" => "Kanallar", "icon" => "bi-people-fill"],
        ["href" => "/categories", "text" => "Kategoriler", "icon" => "bi-tags-fill"],
        ["href" => "/playlists", "text" => "Oynatma Listeleri", "icon" => "bi-collection-play-fill"],
    ],
    "Size Özel" =>  [
        ["href" => "/feed", "text" => "Tüm İçerikler", "icon" => "bi-grid-fill"],
        ["href" => "/feed/channels", "text" => "Kanallar", "icon" => "bi-people-fill"],
        ["href" => "/feed/subscriptions", "text" => "Abonelikler", "icon" => "bi-bell-fill"],
        ["href" => "/feed/comments", "text" => "Yorumların", "icon" => "bi-chat-left-text-fill"],
        ["href" => "/feed/playlists", "text" => "Oynatma Listelerin", "icon" => "bi-collection-play-fill"],
        ["href" => "/feed/watch-later", "text" => "Daha Sonra İzle", "icon" => "bi-clock-fill"],
        ["href" => "/feed/history", "text" => "Geçmiş", "icon" => "bi-clock-history"],
        ["href" => "/feed/liked", "text" => "Beğendiklerin", "icon" => "bi-hand-thumbs-up-fill"],
    ],
    "Yönetim" => [
        ["href" => "/studio", "text" => "Yönetim", "icon" => "bi-gear-fill"],
    ],
] : [
    "" => [
        ["href" => "/", "text" => "Ana Sayfa", "icon" => "bi-house-door-fill"],
        ["href" => "/videos", "text" => "Videolar", "icon" => "bi-play-btn-fill"],
        ["href" => "/shorts", "text" => "Shorts", "icon" => "bi-lightning-charge-fill"],
        ["href" => "/musics", "text" => "Müzikler", "icon" => "bi-music-note-beamed"],
        ["href" => "/channels", "text" => "Kanallar", "icon" => "bi-people-fill"],
        ["href" => "/categories", "text" => "Kategoriler", "icon" => "bi-tags-fill"],
        ["href" => "/playlists", "text" => "Oynatma Listeleri", "icon" => "bi-collection-play-fill"],
    ],
]);

?>

<!-- Layout -->
<?= $this->layout("Layouts/BaseLayout", ["title" => $title]) ?>

<!-- START CONTENT SECTION -->
<!-- Header -->
<?= $this->insert("Layouts/Partials/Header/Header", [
    "brandName" => $brandName,
    "auth" => $auth,
    "search" => $search,
]) ?>

<!-- Sidebar -->
<?= $this->insert("Layouts/Partials/Sidebar/Sidebar", [
    "brandName" => $brandName,
    "auth" => $auth,
    "activeNav" => $activeNav,
    "navMenus" => $navMenus,
]) ?>

<!-- Ana İçerik -->
<main class="xl:ml-64 mt-32 xl:mt-16 mb-16 p-6 flex flex-1 flex-col gap-6">
    <?= $this->section('content') ?>
</main>

<!-- Footer -->
<?= $this->insert("Layouts/Partials/Footer/Footer", ["brandName" => $brandName]) ?>
<!-- END CONTENT SECTION -->

<!-- START SCRIPTS SECTION -->
<?= $this->start("scripts"); ?>
<?= $this->section("scripts"); ?>
<?= $this->stop(); ?>
<!-- END SCRIPTS SECTION -->

<!-- START STYLES SECTION -->
<?= $this->start("styles"); ?>
<?= $this->section("styles"); ?>
<?= $this->stop(); ?>
<!-- END STYLES SECTION -->