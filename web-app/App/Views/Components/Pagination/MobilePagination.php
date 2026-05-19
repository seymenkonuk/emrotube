<?php

use Seymen\PhpMvcTemplate\DTO\PaginationDTO;

?>

<?php

/** @var PaginationDTO $pagination */

?>

<span
    class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 border border-gray-200 hover:border-blue-400 p-4">
    <?= $this->escape($pagination->currentPage) ?> / <?= $this->escape($pagination->lastPage) ?>
</span>