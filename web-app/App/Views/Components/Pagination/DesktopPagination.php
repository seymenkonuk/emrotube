<?php

use Seymen\PhpMvcTemplate\DTO\PaginationDTO;

?>

<?php

/** @var PaginationDTO $pagination */
/** @var callable $paginationUrl */

?>

<?php
$getVisiblePageNumbers = function (int $currentPage, int $lastPage, int $delta = 3): array {
    $pages = [];

    // Aralıklar
    $start = max(2, $currentPage - $delta);
    $end = min($lastPage - 1, $currentPage + $delta);

    // İlk sayfa
    $pages[] = 1;

    // Başta ellipsis gerekiyorsa
    if ($start > 2) {
        $pages[] = '...';
    }

    // Ortadaki sayfalar
    for ($i = $start; $i <= $end; $i++) {
        $pages[] = $i;
    }

    // Sonda ellipsis gerekiyorsa
    if ($end < $lastPage - 1) {
        $pages[] = '...';
    }

    // Son sayfa
    if ($lastPage > 1) {
        $pages[] = $lastPage;
    }

    return $pages;
}
?>

<?php
foreach ($getVisiblePageNumbers($pagination->currentPage, $pagination->lastPage) as $page) {
    if ($page === '...') {
        $this->insert("Components/Pagination/Ellipsis");
    } else {
        $this->insert("Components/Pagination/Page", [
            "text" => $page,
            "href" => $paginationUrl($page),
            "isActive" => $page !== $pagination->currentPage,
        ]);
    }
}
?>
