<?php
// ============================================================================
// File:    OptionListHelper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Helpers;


use Seymen\PhpMvcTemplate\Config\ValidationConfig;
use Seymen\PhpMvcTemplate\DTO\OptionDTO;
use Seymen\PhpMvcTemplate\Enums\CommentType;
use Seymen\PhpMvcTemplate\Enums\ViewType;


class OptionListHelper
{
    /**
     * Tüm ülke seçeneklerini OptionDTO dizisi formatında döner.
     * @return array<OptionDTO>
     */
    public static function getCountryOptions(): array
    {
        return array_map(fn($country) => new OptionDTO($country, $country), ValidationConfig::COUNTRIES);
    }

    /**
     * Tüm görüntüleme türlerini OptionDTO dizisi formatında döner.
     * @return array<OptionDTO>
     */
    public static function getViewTypeOptions(): array
    {
        $viewTypes = ViewType::cases();
        return array_map(fn($viewType) => new OptionDTO($viewType->value, $viewType->label()), $viewTypes);
    }

    /**
     * Tüm yorum türlerini OptionDTO dizisi formatında döner.
     * @return array<OptionDTO>
     */
    public static function getCommentTypeOptions(): array
    {
        $commentTypes = CommentType::cases();
        return array_map(fn($commentType) => new OptionDTO($commentType->value, $commentType->label()), $commentTypes);
    }
}
