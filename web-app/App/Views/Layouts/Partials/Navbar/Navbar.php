<?php

/** @var string $activeNav */
/** @var array $navMenus */

?>

<nav class="flex-1 overflow-y-auto p-4 space-y-2">

    <?php foreach ($navMenus as $menuName => $navItems): ?>

        <?php if ($menuName !== ''): ?>
            <hr>
            <?= $this->insert("Layouts/Partials/Navbar/Title", ["text" => $menuName]); ?>
        <?php endif ?>

        <?php foreach ($navItems as $navItem): ?>
            <?= $this->insert("Layouts/Partials/Navbar/Item", [...$navItem, "isActive" => $activeNav === $navItem["href"]]); ?>
        <?php endforeach ?>

    <?php endforeach ?>

</nav>