<?php
// ============================================================================
// File:    PaginationDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


/**
 * @property int    $currentPage
 * @property int    $lastPage
 * @property int    $perPage
 * @property int    $count
 * @property int    $total
 */
class PaginationDTO
{
    public function __construct(
        private int $currentPage,
        private int $lastPage,
        private int $perPage,
        private int $count,
        private int $total,
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }
}
