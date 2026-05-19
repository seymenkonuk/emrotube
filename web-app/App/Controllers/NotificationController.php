<?php
// ============================================================================
// File:    NotificationController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Minishlink\WebPush\VAPID;
use Seymen\PhpMvcTemplate\Core\Controller;

class NotificationController extends Controller
{
    public function Subscribe()
    {
        $keys = VAPID::createVapidKeys();
        return $this->Json($keys);
    }
}
