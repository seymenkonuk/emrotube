<?php
// ============================================================================
// File:    CategoryHeaderDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


use Seymen\PhpMvcTemplate\Config\DefaultImageConfig;
use Seymen\PhpMvcTemplate\Helpers\NumberHelper;
use Seymen\PhpMvcTemplate\Models\CategoryHeader;


/**
 * @property string     $title
 * @property ?string    $description
 * @property string     $banner
 * @property int        $videoCount
 * @property string     $videoCountFormatted
 */
class CategoryHeaderDTO
{
    private function __construct(
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

    public static function fromModel(CategoryHeader $header): self
    {
        return new self(
            $header->title,
            $header->description ?? null,
            $header->banner ?? DefaultImageConfig::DEFAULT_CATEGORY_BANNER,
            $header->video_count,
            NumberHelper::formatNumber($header->video_count),
        );
    }
}
