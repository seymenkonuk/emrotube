<?php

use Seymen\PhpMvcTemplate\DTO\PaginationDTO;

?>

<?php

/** @var PaginationDTO $pagination */

?>

<?php
$paginationUrl = function (int $pageNumber): string {
    $query = $_GET;
    $query["page"] = $pageNumber;
    $queryString = http_build_query($query);
    return '?' . $queryString;
};
?>

<?php if ($pagination->lastPage > 1): ?>
    <nav class="flex items-center justify-between text-sm gap-2">

        <?= $this->insert("Components/Pagination/Button", [
            "rightText" => "Önceki",
            "icon" => "bi-chevron-left",
            "href" => $paginationUrl($pagination->currentPage - 1),
            "isActive" => $pagination->currentPage > 1,
        ]) ?>

        <div class="hidden md:flex flex-wrap justify-center gap-2 flex-1">
            <?= $this->insert("Components/Pagination/DesktopPagination", [
                "pagination" => $pagination,
                "paginationUrl" => $paginationUrl,
            ]) ?>
        </div>

        <div class="flex md:hidden flex-1 justify-center">
            <?= $this->insert("Components/Pagination/MobilePagination", [
                "pagination" => $pagination,
            ]) ?>
        </div>

        <?= $this->insert("Components/Pagination/Button", [
            "leftText" => "Sonraki",
            "icon" => "bi-chevron-right",
            "href" => $paginationUrl($pagination->currentPage + 1),
            "isActive" => $pagination->currentPage < $pagination->lastPage,
        ]) ?>

    </nav>
<?php endif ?>