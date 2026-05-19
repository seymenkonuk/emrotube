<?php
// ============================================================================
// File:    OptionDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


/**
 * @property string $value
 * @property string $title
 */
class OptionDTO
{
    public function __construct(
        private string $value,
        private string $title,
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }
}
