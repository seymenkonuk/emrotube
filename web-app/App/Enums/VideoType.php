<?php
// ============================================================================
// File:    VideoType.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Enums;


use Seymen\PhpMvcTemplate\Config\DefaultImageConfig;


enum VideoType: int
{
    case VIDEO = 0;
    case SHORT = 1;
    case MUSIC = 2;

    public function icon(): string
    {
        return match ($this) {
            self::VIDEO => 'bi-play-btn-fill',
            self::SHORT => 'bi-lightning-charge-fill',
            self::MUSIC => 'bi-music-note-beamed',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::VIDEO => 'Video',
            self::SHORT => 'Kısa Video',
            self::MUSIC => 'Müzik',
        };
    }

    public function url(): string
    {
        return match ($this) {
            self::VIDEO => '/videos',
            self::SHORT => '/shorts',
            self::MUSIC => '/musics',
        };
    }

    public function defaultThumbnail(): string
    {
        return match ($this) {
            self::VIDEO => DefaultImageConfig::DEFAULT_VIDEO_THUMBNAIL,
            self::SHORT => DefaultImageConfig::DEFAULT_SHORT_THUMBNAIL,
            self::MUSIC => DefaultImageConfig::DEFAULT_MUSIC_THUMBNAIL,
        };
    }
}
