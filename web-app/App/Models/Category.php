<?php
// ============================================================================
// File:    Category.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Models;


use DateTime;


class Category
{
    public string           $code;
    public string           $title;
    public ?string          $description;
    public ?string          $banner;
    public int              $video_count;
    public DateTime|string  $date;
}
