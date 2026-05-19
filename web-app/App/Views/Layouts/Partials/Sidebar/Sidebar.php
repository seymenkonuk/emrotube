<?php

use Seymen\PhpMvcTemplate\Models\UserAuth;

?>

<?php

/** @var ?UserAuth $auth */
/** @var string $activeNav */
/** @var array $navMenus */
/** @var string $brandName */

?>

<aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-white shadow transform -translate-x-full xl:translate-x-0 transition-transform duration-200 z-50 flex flex-col">

    <div class="p-4 border-b">
        <?= $this->insert("Layouts/Partials/BrandName", ["brandName" => $brandName]) ?>
    </div>

    <?= $this->insert("Layouts/Partials/Navbar/Navbar", ["activeNav" => $activeNav, "navMenus" => $navMenus]) ?>

    <?= $this->insert("Layouts/Partials/Sidebar/Footer", ["auth" => $auth]) ?>

</aside>