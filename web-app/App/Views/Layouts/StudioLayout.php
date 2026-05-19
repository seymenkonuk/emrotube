<?php

/** @var string $title */
/** @var ?string $activeNav */

?>

<!-- Layout -->
<?= $this->layout("Layouts/MainLayout", [
    "title" => $title,
    "activeNav" => $activeNav ?? null,
    "navMenus" => [
        "" => [
            ["href" => "/studio", "text" => "Yönetim", "icon" => "bi-gear-fill"],
        ],
        "Yönetim" => [
            ["href" => "/studio/channels", "text" => "Kanallar", "icon" => "bi-people-fill"],
            ["href" => "/studio/videos", "text" => "Videolar", "icon" => "bi-play-btn-fill"],
            ["href" => "/studio/shorts", "text" => "Shorts", "icon" => "bi-lightning-charge-fill"],
            ["href" => "/studio/musics", "text" => "Müzikler", "icon" => "bi-music-note-beamed"],
            ["href" => "/studio/playlists", "text" => "Oynatma Listeleri", "icon" => "bi-collection-play-fill"],
        ],
    ],
]) ?>

<!-- START CONTENT SECTION -->
<?= $this->section('content') ?>
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