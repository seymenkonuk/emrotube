<!-- Layout -->
<?= $this->layout("Layouts/MainLayout", ["title" => "Ana Sayfa"]) ?>

<!-- START CONTENT SECTION -->
<section class="grid grid-cols-1 gap-6">
    <?= $this->insert("Components/Video/VideoPlayer", [
        "video" => "https://www.w3schools.com/html/mov_bbb.mp4",
        "thumbnail" => "https://i.ytimg.com/vi/abc123/hqdefault.jpg",
        "t" => 5,
    ]); ?>

    <?= $this->insert("Components/Video/Details", []); ?>

    <?php for ($i = 0; $i < 20; $i++): ?>
        <?= $this->insert("Components/Comment/CommentCard"); ?>
    <?php endfor ?>
</section>
<!-- END CONTENT SECTION -->

<!-- START SCRIPTS SECTION -->
<?= $this->start("scripts"); ?>
<?= $this->stop(); ?>
<!-- END SCRIPTS SECTION -->

<!-- START STYLES SECTION -->
<?= $this->start("styles"); ?>
<?= $this->stop(); ?>
<!-- END STYLES SECTION -->