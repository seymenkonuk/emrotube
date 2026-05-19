<?php

use Seymen\PhpMvcTemplate\Models\UserAuth;

?>

<?php

/** @var ?UserAuth $auth */

?>

<?php if ($auth === null): ?>

    <!-- GİRİŞ YAP MENÜSÜ -->
    <?= $this->insert("Components/Form/Elements/LinkButton", [
        "text" => "Giriş Yap",
        "href" => "/login",
        "icon" => "bi-box-arrow-in-right",
        "color" => "bg-blue-500",
        "hoverColor" => "bg-blue-600",
        "textColor" => "text-white",
    ]); ?>

<?php else: ?>

    <!-- ÇIKIŞ YAP MENÜSÜ -->
    <a
        class="flex font-semibold hover:text-blue-600 items-center text-gray-800 transition-colors max-w-[24ch]"
        href="/channels/<?= $this->escape($auth->channel_code) ?>">
        <i class="bi bi-person-circle mr-1 text-xl"></i>
        <span class="truncate"><?= $this->escape($auth->channel_title) ?></span>
    </a>

    <?= $this->insert("Components/Form/Logout") ?>

<?php endif ?>