<?php
$video = $video ?? "";
$thumbnail = $thumbnail ?? "";
$subtitles = $subtitles ?? [];
$t = $t ?? 0;
?>

<div class="w-full">
    <video
        id="videoPlayer"
        preload="metadata"
        class="w-full rounded-xl shadow-md"
        poster="<?= $this->escape($thumbnail) ?>"
        onloadedmetadata="this.currentTime=<?= $this->escape($t) ?>"
        controls>

        <!-- Video Dosyası -->
        <source src="<?= $this->escape($video) ?>" type="video/mp4">

        <!-- Altyazılar -->
        <?php foreach ($subtitles as $subtitle): ?>
            <track
                kind="subtitles"
                src="<?= $this->escape($subtitle["src"]) ?>"
                srclang="<?= $this->escape($subtitle["srclang"]) ?>"
                label="<?= $this->escape($subtitle["label"]) ?>">
        <?php endforeach ?>
    </video>
</div>