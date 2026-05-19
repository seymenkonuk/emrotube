<?php
// ============================================================================
// File:    ChannelDetailsDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


use DateTime;

use Seymen\PhpMvcTemplate\Helpers\NumberHelper;
use Seymen\PhpMvcTemplate\Helpers\TimeHelper;
use Seymen\PhpMvcTemplate\Models\ChannelDetail;


/**
 * @property ?string                $description
 * @property array<SocialLinkDTO>   $links
 * @property int                    $subscriberCount
 * @property string                 $subscriberCountFormatted
 * @property int                    $videoCount
 * @property string                 $videoCountFormatted
 * @property int                    $viewCount
 * @property string                 $viewCountFormatted
 * @property DateTime|string        $joinDate
 * @property string                 $joinDateFormatted
 */
class ChannelDetailsDTO
{
    private function __construct(
        private ?string             $description,
        private array               $links,
        private int                 $subscriberCount,
        private string              $subscriberCountFormatted,
        private int                 $videoCount,
        private string              $videoCountFormatted,
        private int                 $viewCount,
        private string              $viewCountFormatted,
        private DateTime|string     $joinDate,
        private string              $joinDateFormatted
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }

    public static function fromModel(ChannelDetail $details): self
    {
        $links = array_filter([
            new SocialLinkDTO($details->linkedin_url ?? "", "bi-linkedin", "LinkedIn"),
            new SocialLinkDTO($details->github_url ?? "", "bi-github", "GitHub"),
            new SocialLinkDTO($details->instagram_url ?? "", "bi-instagram", "Instagram"),
            new SocialLinkDTO($details->twitter_url ?? "", "bi-twitter", "Twitter"),
            new SocialLinkDTO($details->facebook_url ?? "", "bi-facebook", "Facebook"),
        ], fn($link) => $link->url !== "");

        return new self(
            $details->description ?? null,
            $links,
            $details->subscriber_count,
            NumberHelper::formatNumber($details->subscriber_count),
            $details->video_count,
            NumberHelper::formatNumber($details->video_count),
            $details->view_count,
            NumberHelper::formatNumber($details->view_count),
            $details->date,
            TimeHelper::formatTime($details->date),
        );
    }
}
