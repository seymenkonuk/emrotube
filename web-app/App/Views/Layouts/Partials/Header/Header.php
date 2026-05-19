<?php

use Seymen\PhpMvcTemplate\Models\UserAuth;

?>

<?php

/** @var ?UserAuth $auth */
/** @var string $search */
/** @var string $brandName */

?>

<?= $this->insert("Layouts/Partials/Header/MobileHeader", [
    "brandName" => $brandName,
    "search" => $search
]) ?>

<?= $this->insert("Layouts/Partials/Header/DesktopHeader", [
    "auth" => $auth,
    "search" => $search,
]) ?>
