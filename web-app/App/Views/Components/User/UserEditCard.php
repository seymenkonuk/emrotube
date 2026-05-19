<?php

/** @var string $href */

?>

<a
    href="<?= $this->escape($href) ?>"
    class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 group border border-gray-200 hover:border-blue-400 flex flex-col">

    <div class="flex items-center p-4 space-x-4">
        <i class="bi bi-person-lines-fill text-gray-600 text-3xl"></i>
        <div class="flex flex-col min-w-0">
            <span class="font-extrabold text-lg text-gray-900 truncate group-hover:text-blue-600 transition">
                Hesap Bilgileri
            </span>
            <p class="text-gray-600 text-sm truncate">
                Hesap bilgilerinizi güncelleyin
            </p>
        </div>
    </div>
</a>