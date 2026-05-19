<?php

use Seymen\PhpMvcTemplate\DTO\ChannelDetailsDTO;

?>

<?php

/** @var ChannelDetailsDTO $details */

?>

<!-- Hakkında Kartı -->
<div class="space-y-4">
    <h2 class="text-xl font-extrabold text-gray-900 mb-4">Hakkında</h2>
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md hover:shadow-xl transition duration-300 cursor-pointer group border border-gray-200 hover:border-blue-400 p-4">
        <p class="text-gray-700 text-sm <?= isset($details->description) ? '' : 'italic' ?>">
            <?php if (isset($details->description)): ?>
                <?= $this->escape($details->description) ?>
            <?php else: ?>
                Açıklama Yok
            <?php endif ?>
        </p>
    </div>
</div>

<!-- Sosyal Medya Kartları -->
<?php if (count($details->links) > 0): ?>
    <div class="space-y-4">
        <h2 class="text-xl font-extrabold text-gray-900 mb-4">Sosyal Medya</h2>

        <?php foreach ($details->links as $link): ?>
            <?= $this->insert("Components/Channel/SocialLinkCard", [
                "link" => $link,
            ]) ?>
        <?php endforeach ?>
    </div>
<?php endif ?>

<!-- İstatistik Kartları -->
<div class="space-y-4">
    <h2 class="text-xl font-extrabold text-gray-900 mb-4">İstatistikler</h2>

    <?= $this->insert("Components/Channel/StatCard", [
        "title" => "Abone Sayısı",
        "value" => $details->subscriberCount,
        "valueFormatted" => $details->subscriberCountFormatted,
    ]) ?>
    <?= $this->insert("Components/Channel/StatCard", [
        "title" => "İzlenme Sayısı",
        "value" => $details->viewCount,
        "valueFormatted" => $details->viewCountFormatted,
    ]) ?>
    <?= $this->insert("Components/Channel/StatCard", [
        "title" => "Video Sayısı",
        "value" => $details->videoCount,
        "valueFormatted" => $details->videoCountFormatted,
    ]) ?>
    <?= $this->insert("Components/Channel/StatCard", [
        "title" => "Katıldığı Tarih",
        "value" => $details->joinDate,
        "valueFormatted" => $details->joinDateFormatted,
    ]) ?>
</div>