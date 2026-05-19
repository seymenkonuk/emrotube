<?php

use Seymen\PhpMvcTemplate\Models\UserAuth;

?>

<?php

/** @var ?UserAuth $auth */
/** @var string $search */

?>

<header class="hidden xl:flex fixed top-0 left-64 right-0 z-40 justify-end items-center bg-white px-6 py-4 shadow h-16">
    <div class="flex-1 flex justify-center">
        <?= $this->insert("Layouts/Partials/Header/SearchBar", ["search" => $search]); ?>
    </div>

    <div id="desktop-user-info" class="flex items-center space-x-3">
        <?= $this->insert("Layouts/Partials/AuthInfo", ["auth" => $auth]); ?>
    </div>
</header>