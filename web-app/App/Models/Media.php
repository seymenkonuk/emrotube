<?php
// ============================================================================
// File:    Media.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Models;


use DateTime;


class Media
{
    public string           $code;
    public int              $type;
    public int              $view_type;
    public string           $title;
    public ?string          $thumbnail;
    public string           $channel_code;
    public string           $channel_title;
    public ?string          $channel_avatar;
    public int              $duration;
    public int              $view_count;
    public DateTime|string $date;
}
