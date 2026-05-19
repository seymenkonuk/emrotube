<?php
// ============================================================================
// File:    ChannelDetail.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Models;


use DateTime;


class ChannelDetail
{
    public string           $code;
    public ?string          $description;
    public ?string          $instagram_url;
    public ?string          $twitter_url;
    public ?string          $facebook_url;
    public ?string          $linkedin_url;
    public ?string          $github_url;
    public int              $subscriber_count;
    public int              $video_count;
    public int              $view_count;
    public DateTime|string  $date;
}
