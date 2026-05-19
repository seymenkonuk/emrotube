<?php
// ============================================================================
// File:    ChannelHeaderDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


use Seymen\PhpMvcTemplate\Config\DefaultImageConfig;
use Seymen\PhpMvcTemplate\Helpers\NumberHelper;
use Seymen\PhpMvcTemplate\Models\ChannelHeader;


/**
 * @property string             $url
 * @property string             $title
 * @property string             $avatar
 * @property string             $banner
 * @property SubscriptionDTO    $subscriptionInfo
 * @property int                $subscriberCount
 * @property string             $subscriberCountFormatted
 * @property int                $videoCount
 * @property string             $videoCountFormatted
 */
class ChannelHeaderDTO
{
    private function __construct(
        private string          $url,
        private string          $title,
        private string          $avatar,
        private string          $banner,
        private SubscriptionDTO $subscriptionInfo,
        private int             $subscriberCount,
        private string          $subscriberCountFormatted,
        private int             $videoCount,
        private string          $videoCountFormatted,
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }

    public static function fromModel(string $url, ChannelHeader $header): self
    {
        return new self(
            $url,
            $header->title,
            $header->avatar ?? DefaultImageConfig::DEFAULT_CHANNEL_AVATAR,
            $header->banner ?? DefaultImageConfig::DEFAULT_CHANNEL_BANNER,
            SubscriptionDTO::create($header->subscription_type, $header->subscription_title),
            $header->subscriber_count,
            NumberHelper::formatNumber($header->subscriber_count),
            $header->video_count,
            NumberHelper::formatNumber($header->video_count),
        );
    }
}
