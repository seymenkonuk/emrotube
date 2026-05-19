<?php
// ============================================================================
// File:    ViewTypeDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


use Seymen\PhpMvcTemplate\Enums\ViewType;


/**
 * @property string $icon
 * @property string $label
 */
class ViewTypeDTO
{
    private function __construct(
        private string $icon,
        private string $label,
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }

    public static function fromViewType(int $view_type): self
    {
        $viewType = ViewType::from($view_type);
        return new self(
            $viewType->icon(),
            $viewType->label(),
        );
    }
}
