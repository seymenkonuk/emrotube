<?php
// ============================================================================
// File:    CategoryCardDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


use Seymen\PhpMvcTemplate\Config\DefaultImageConfig;
use Seymen\PhpMvcTemplate\Helpers\NumberHelper;
use Seymen\PhpMvcTemplate\Models\Category;


/**
 * @property string     $url
 * @property string     $title
 * @property ?string    $description
 * @property string     $banner
 * @property int        $videoCount
 * @property string     $videoCountFormatted
 */
class CategoryCardDTO
{
    private function __construct(
        private string  $url,
        private string  $title,
        private ?string $description,
        private string  $banner,
        private int     $videoCount,
        private string  $videoCountFormatted,
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }

    public static function fromModel(string $url, Category $category): self
    {
        return new self(
            $url,
            $category->title,
            $category->description ?? null,
            $category->banner ?? DefaultImageConfig::DEFAULT_CATEGORY_BANNER,
            $category->video_count,
            NumberHelper::formatNumber($category->video_count),
        );
    }
}
