<?php
// ============================================================================
// File:    PlaylistHeader.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Models;


class PlaylistHeader
{
    public string   $code;
    public string   $title;
    public ?string  $description;
    public ?string  $banner;
    public string   $channel_code;
    public string   $channel_title;
    public ?string  $channel_avatar;
    public int      $video_count;
    public int      $total_duration;
    public int      $view_type;
}
