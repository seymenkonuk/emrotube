<?php
// ============================================================================
// File:    CategoryHeader.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Models;


class CategoryHeader
{
    public string   $code;
    public string   $title;
    public ?string  $description;
    public ?string  $banner;
    public int      $video_count;
}
