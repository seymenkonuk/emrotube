<?php
// ============================================================================
// File:    PlaylistCardDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


use Seymen\PhpMvcTemplate\Config\DefaultImageConfig;
use Seymen\PhpMvcTemplate\Helpers\NumberHelper;
use Seymen\PhpMvcTemplate\Models\Playlist;


/**
 * @property string         $url
 * @property string         $title
 * @property string         $banner
 * @property string         $channelUrl
 * @property string         $channelTitle
 * @property string         $channelAvatar
 * @property int            $videoCount
 * @property string         $videoCountFormatted
 * @property ViewTypeDTO    $viewType
 */
class PlaylistCardDTO
{
    private function __construct(
        private string      $url,
        private string      $title,
        private string      $banner,
        private string      $channelUrl,
        private string      $channelTitle,
        private string      $channelAvatar,
        private int         $videoCount,
        private string      $videoCountFormatted,
        private ViewTypeDTO $viewType,
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }

    public static function fromModel(string $url, string $channelUrl, Playlist $playlist): self
    {
        return new self(
            $url,
            $playlist->title,
            $playlist->banner ?? DefaultImageConfig::DEFAULT_PLAYLIST_BANNER,
            $channelUrl,
            $playlist->channel_title,
            $playlist->channel_avatar ?? DefaultImageConfig::DEFAULT_CHANNEL_AVATAR,
            $playlist->video_count,
            NumberHelper::formatNumber($playlist->video_count),
            ViewTypeDTO::fromViewType($playlist->view_type),
        );
    }
}
