<?php
// ============================================================================
// File:    ChannelHeader.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Models;


class ChannelHeader
{
    public string   $code;
    public string   $title;
    public ?string  $avatar;
    public ?string  $banner;
    public int      $subscriber_count;
    public int      $video_count;
    public int      $subscription_type;
    public ?string  $subscription_title;
}
