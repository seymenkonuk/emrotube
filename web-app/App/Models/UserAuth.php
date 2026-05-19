<?php
// ============================================================================
// File:    UserAuth.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Models;


class UserAuth
{
    public string   $code;
    public string   $channel_code;
    public string   $channel_title;
    public ?string  $channel_avatar;
}
