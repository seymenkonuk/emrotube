<?php
// ============================================================================
// File:    UploadController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\UploadService;

class UploadController extends Controller
{
    private AuthService $authService;
    private UploadService $uploadService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->uploadService = new UploadService();
    }

    public function GetChannelBanner(string $channelCode, string $fileName)
    {
        return $this->StreamFile("", "");
    }

    public function GetChannelAvatar(string $channelCode, string $fileName)
    {
        return $this->StreamFile("", "");
    }

    public function GetPlaylistBanner(string $playlistCode, string $fileName)
    {
        return $this->StreamFile("", "");
    }

    public function GetVideoFile(string $videoCode, string $fileName)
    {
        return $this->StreamFile("", "");
    }

    public function GetVideoThumbnail(string $videoCode, string $fileName)
    {
        return $this->StreamFile("", "");
    }

    public function GetVideoCaption(string $videoCode, string $fileName)
    {
        return $this->StreamFile("", "");
    }

    public function GetShortFile(string $shortCode, string $fileName)
    {
        return $this->StreamFile("", "");
    }

    public function GetShortThumbnail(string $shortCode, string $fileName)
    {
        return $this->StreamFile("", "");
    }

    public function GetShortCaption(string $shortCode, string $fileName)
    {
        return $this->StreamFile("", "");
    }

    public function GetMusicFile(string $musicCode, string $fileName)
    {
        return $this->StreamFile("", "");
    }

    public function GetMusicThumbnail(string $musicCode, string $fileName)
    {
        return $this->StreamFile("", "");
    }

    public function GetMusicCaption(string $musicCode, string $fileName)
    {
        return $this->StreamFile("", "");
    }

    public function GetCategoryBanner(string $categoryCode, string $fileName)
    {
        return $this->StreamFile("", "");
    }
}
