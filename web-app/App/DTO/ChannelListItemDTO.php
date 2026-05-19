<?php
// ============================================================================
// File:    ChannelListItemDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


use Seymen\PhpMvcTemplate\Config\DefaultImageConfig;
use Seymen\PhpMvcTemplate\Helpers\NumberHelper;
use Seymen\PhpMvcTemplate\Models\Channel;


/**
 * @property ?int               $order
 * @property string             $url
 * @property string             $title
 * @property string             $avatar
 * @property int                $subscriberCount
 * @property string             $subscriberCountFormatted
 * @property int                $videoCount
 * @property string             $videoCountFormatted
 */
class ChannelListItemDTO
{
    private function __construct(
        private ?int        $order,
        private string      $url,
        private string      $title,
        private string      $avatar,
        private int         $subscriberCount,
        private string      $subscriberCountFormatted,
        private int         $videoCount,
        private string      $videoCountFormatted,
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }

    public static function fromModel(?int $order, string $url, Channel $channel): self
    {
        return new self(
            $order ?? null,
            $url,
            $channel->title,
            $channel->avatar ?? DefaultImageConfig::DEFAULT_CHANNEL_AVATAR,
            $channel->subscriber_count,
            NumberHelper::formatNumber($channel->subscriber_count),
            $channel->video_count,
            NumberHelper::formatNumber($channel->video_count),
        );
    }
}
