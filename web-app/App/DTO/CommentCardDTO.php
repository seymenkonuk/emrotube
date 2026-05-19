<?php
// ============================================================================
// File:    CommentCardDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


use Seymen\PhpMvcTemplate\Config\DefaultImageConfig;
use Seymen\PhpMvcTemplate\Helpers\NumberHelper;
use Seymen\PhpMvcTemplate\Helpers\TimeHelper;


/**
 * @property ?string            $url
 * @property string             $message
 * @property string             $channelUrl
 * @property string             $channelTitle
 * @property string             $channelAvatar
 * @property int                $likeCount
 * @property string             $likeCountFormatted
 * @property int                $dislikeCount
 * @property string             $dislikeCountFormatted
 * @property \DateTime|string   $date
 * @property string             $dateFormatted
 */
class CommentCardDTO
{
    private function __construct(
        private ?string             $url,
        private string              $message,
        private string              $channelUrl,
        private string              $channelTitle,
        private string              $channelAvatar,
        private int                 $likeCount,
        private string              $likeCountFormatted,
        private int                 $dislikeCount,
        private string              $dislikeCountFormatted,
        private \DateTime|string    $date,
        private string              $dateFormatted,
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }

    public static function fromArray(array $row): self
    {
        // return new self(
        //     $row['url'] ?? null,
        //     $row['message'],
        //     $row['channel_url'],
        //     $row['channel_title'],
        //     $row['channel_avatar'] ?? DefaultImageConfig::DEFAULT_CHANNEL_AVATAR,
        //     (int) $row['like_count'],
        //     NumberHelper::formatNumber((int) $row['like_count']),
        //     (int) $row['dislike_count'],
        //     NumberHelper::formatNumber((int) $row['dislike_count']),
        //     $row['date'],
        //     TimeHelper::formatTime($row['date']),
        // );
    }
}
