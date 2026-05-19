<?php
// ============================================================================
// File:    LikedHeaderDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


use Seymen\PhpMvcTemplate\Helpers\NumberHelper;
use Seymen\PhpMvcTemplate\Helpers\TimeHelper;
use Seymen\PhpMvcTemplate\Models\LikedHeader;


/**
 * @property int    $videoCount
 * @property string $videoCountFormatted
 * @property int    $totalDuration
 * @property string $totalDurationFormatted
 */
class LikedHeaderDTO
{
    private function __construct(
        private int     $videoCount,
        private string  $videoCountFormatted,
        private int     $totalDuration,
        private string  $totalDurationFormatted,
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }

    public static function fromModel(LikedHeader $header): self
    {
        return new self(
            $header->video_count,
            NumberHelper::formatNumber($header->video_count),
            $header->total_duration,
            TimeHelper::formatDuration($header->total_duration),
        );
    }
}
