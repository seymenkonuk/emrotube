<?php

/** @var string $brandName */
/** @var string $search */

?>

<header class="xl:hidden fixed top-0 left-0 right-0 z-40 flex justify-between items-center bg-white p-4 shadow h-16">
    <?= $this->insert("Layouts/Partials/BrandName", ["brandName" => $brandName]) ?>

    <button id="mobile-menu-button" class="text-gray-600 focus:outline-none">
        <i class="bi bi-list w-6 h-6 text-3xl"></i>
    </button>
</header>

<div class="xl:hidden fixed top-16 left-0 right-0 bg-white px-4 py-2 shadow z-30 flex item-center justify-center h-16">
    <?= $this->insert("Layouts/Partials/Header/SearchBar", ["search" => $search]); ?>
</div>