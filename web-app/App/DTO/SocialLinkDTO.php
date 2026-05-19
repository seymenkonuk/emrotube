<?php
// ============================================================================
// File:    SocialLinkDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


/**
 * @property string $url
 * @property string $icon
 * @property string $name
 */
class SocialLinkDTO
{
    public function __construct(
        private string $url,
        private string $icon,
        private string $name,
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }
}
