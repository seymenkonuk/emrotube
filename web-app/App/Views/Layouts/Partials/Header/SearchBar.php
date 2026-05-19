<?php

/** @var string $search */

?>

<form action="/search" method="GET" class="flex w-full max-w-lg">
    <input
        type="text"
        name="q"
        value="<?= $this->escape($search) ?>"
        placeholder="Ara..."
        class="flex-grow border border-gray-300 rounded-l-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
    <button
        type="submit"
        class="bg-blue-500 text-white px-4 py-2 rounded-r-full hover:bg-blue-600 transition">
        <i class="bi bi-search"></i>
    </button>
</form>