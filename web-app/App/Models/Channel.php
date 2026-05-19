<?php
// ============================================================================
// File:    Channel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Models;


use DateTime;


class Channel
{
    public string           $code;
    public string           $title;
    public ?string          $avatar;
    public int              $subscriber_count;
    public int              $video_count;
    public DateTime|string  $date;
    public string           $user_code;
    public int              $subscription_type;
    public ?string          $subscription_title;
}
