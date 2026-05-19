<?php

/** @var ?string $layout */
/** @var ?string $title */
/** @var ?string $message */
/** @var ?string $auth */

?>

<?php
$layout = $layout ?? str_starts_with($_SERVER["REQUEST_URI"], "/studio/") ? "StudioLayout" : "MainLayout";
$title = $title ?? "Erişim Engellendi";
$message = $message ?? "Bu işlemi gerçekleştirme yetkiniz yok.";
$auth = $auth ?? null;
?>

<?= $this->layout("Layouts/$layout", [
    "title" => $title,
    "auth" => $auth,
]) ?>

<div class="flex flex-1 items-center justify-center">
    <div class="text-center">
        <h1 class="text-7xl sm:text-9xl font-extrabold text-gray-800">403</h1>

        <div class="mt-4 flex flex-col items-center">
            <p class="text-xl font-semibold text-gray-700"><?= $this->escape($title) ?></p>
            <p class="text-gray-500 mb-6"><?= $this->escape($message) ?></p>
        </div>

        <a href="/"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md transition-colors">
            Ana Sayfaya Dön
        </a>
    </div>
</div>