<?php
// ============================================================================
// File:    PlaylistHeaderDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


use Seymen\PhpMvcTemplate\Config\DefaultImageConfig;
use Seymen\PhpMvcTemplate\Helpers\NumberHelper;
use Seymen\PhpMvcTemplate\Helpers\TimeHelper;
use Seymen\PhpMvcTemplate\Models\PlaylistHeader;


/**
 * @property string         $title
 * @property ?string        $description
 * @property string         $banner
 * @property string         $channelUrl
 * @property string         $channelTitle
 * @property string         $channelAvatar
 * @property int            $videoCount
 * @property string         $videoCountFormatted
 * @property int            $totalDuration
 * @property string         $totalDurationFormatted
 * @property ViewTypeDTO    $viewType
 */
class PlaylistHeaderDTO
{
    private function __construct(
        private string      $title,
        private ?string     $description,
        private string      $banner,
        private string      $channelUrl,
        private string      $channelTitle,
        private string      $channelAvatar,
        private int         $videoCount,
        private string      $videoCountFormatted,
        private int         $totalDuration,
        private string      $totalDurationFormatted,
        private ViewTypeDTO $viewType,
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }

    public static function fromModel(string $channelUrl, PlaylistHeader $header): self
    {
        return new self(
            $header->title,
            $header->description ?? null,
            $header->banner ?? DefaultImageConfig::DEFAULT_PLAYLIST_BANNER,
            $channelUrl,
            $header->channel_title,
            $header->channel_avatar ?? DefaultImageConfig::DEFAULT_CHANNEL_AVATAR,
            $header->video_count,
            NumberHelper::formatNumber($header->video_count),
            $header->total_duration,
            TimeHelper::formatDuration($header->total_duration),
            ViewTypeDTO::fromViewType($header->view_type),
        );
    }
}
