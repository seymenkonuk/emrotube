<?php
// ============================================================================
// File:    CaptionController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\CaptionService;

class CaptionController extends Controller
{
    private AuthService $authService;
    private CaptionService $captionService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->captionService = new CaptionService();
    }

    public function AddToVideoPage(string $videoCode)
    {
        // videoCode sorgulanmalı doğru mu diye!!
        return $this->View("/studio/videos/[id]/caption/new");
    }

    public function AddToVideo(string $videoCode)
    {
        return $this->LocalRedirect("/studio/videos/$videoCode/edit");
    }

    public function AddToShortPage(string $shortCode)
    {
        return $this->View("/studio/shorts/[id]/caption/new");
    }

    public function AddToShort(string $shortCode)
    {
        return $this->LocalRedirect("/studio/shorts/$shortCode/edit");
    }

    public function AddToMusicPage(string $musicCode)
    {
        return $this->View("/studio/musics/[id]/caption/new");
    }

    public function AddToMusic(string $musicCode)
    {
        return $this->LocalRedirect("/studio/musics/$musicCode/edit");
    }

    public function EditPage(string $captionCode)
    {
        return $this->View("/studio/caption/[id]/edit");
    }

    public function Edit(string $captionCode)
    {
        return $this->LocalRedirect("studio/videos");
        // return $this->LocalRedirect("/studio/videos/$videoCode/edit");
    }

    public function Delete(string $captionCode)
    {
        return $this->LocalRedirect("studio/videos");
        // return $this->LocalRedirect("/studio/videos/$videoCode/edit");
    }
}
