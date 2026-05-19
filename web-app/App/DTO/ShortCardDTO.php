<?php
// ============================================================================
// File:    ShortCardDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


use DateTime;

use Seymen\PhpMvcTemplate\Config\DefaultImageConfig;
use Seymen\PhpMvcTemplate\Helpers\NumberHelper;
use Seymen\PhpMvcTemplate\Helpers\TimeHelper;
use Seymen\PhpMvcTemplate\Models\Media;


/**
 * @property string             $url
 * @property string             $title
 * @property string             $thumbnail
 * @property string             $channelUrl
 * @property string             $channelTitle
 * @property string             $channelAvatar
 * @property int                $duration
 * @property string             $durationFormatted
 * @property int                $viewCount
 * @property string             $viewCountFormatted
 * @property DateTime|string    $date
 * @property string             $dateFormatted
 */
class ShortCardDTO
{
    private function __construct(
        private string              $url,
        private string              $title,
        private string              $thumbnail,
        private string              $channelUrl,
        private string              $channelTitle,
        private string              $channelAvatar,
        private int                 $duration,
        private string              $durationFormatted,
        private int                 $viewCount,
        private string              $viewCountFormatted,
        private DateTime|string     $date,
        private string              $dateFormatted,
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }

    public static function fromModel(string $url, string $channelUrl, Media $media): self
    {
        return new self(
            $url,
            $media->title,
            $media->thumbnail ?? DefaultImageConfig::DEFAULT_SHORT_THUMBNAIL,
            $channelUrl,
            $media->channel_title,
            $media->channel_avatar ?? DefaultImageConfig::DEFAULT_CHANNEL_AVATAR,
            $media->duration,
            TimeHelper::formatHms($media->duration),
            $media->view_count,
            NumberHelper::formatNumber($media->view_count),
            $media->date,
            TimeHelper::formatTime($media->date),
        );
    }
}
