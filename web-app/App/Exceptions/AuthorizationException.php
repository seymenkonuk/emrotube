<?php
// ============================================================================
// File:    AuthorizationException.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Exceptions;


use Exception;


class AuthorizationException extends Exception
{
    const PRIVATE_CATEGORY_TITLE = "Kategori Gizli";
    const PRIVATE_CATEGORY_DESCRIPTION = "Bu kategori yalnızca belirli kişilerle paylaşılmış. Erişim izniniz olmayabilir.";

    const PRIVATE_PLAYLIST_TITLE = "Oynatma Listesi Gizli";
    const PRIVATE_PLAYLIST_DESCRIPTION = "Bu oynatma listesi yalnızca belirli kişilerle paylaşılmış. Erişim izniniz olmayabilir.";

    const PRIVATE_VIDEO_TITLE = "Video Gizli";
    const PRIVATE_VIDEO_DESCRIPTION = "Bu video yalnızca belirli kişilerle paylaşılmış. Erişim izniniz olmayabilir.";

    const PRIVATE_SHORT_TITLE = "Kısa Video Gizli";
    const PRIVATE_SHORT_DESCRIPTION = "Bu kısa video yalnızca belirli kişilerle paylaşılmış. Erişim izniniz olmayabilir.";

    const PRIVATE_MUSIC_TITLE = "Müzik Gizli";
    const PRIVATE_MUSIC_DESCRIPTION = "Bu müzik yalnızca belirli kişilerle paylaşılmış. Erişim izniniz olmayabilir.";

    const USER_EDIT_PERMISSION_DENIED_TITLE = "Düzenleme Yetkiniz Yok";
    const USER_EDIT_PERMISSION_DENIED_DESCRIPTION = "Bu kullanıcı size ait değil. Sadece kullanıcının kendisi düzenleme işlemi yapabilir.";

    const CHANNEL_EDIT_PERMISSION_DENIED_TITLE = "Düzenleme Yetkiniz Yok";
    const CHANNEL_EDIT_PERMISSION_DENIED_DESCRIPTION = "Bu kanal size ait değil. Sadece kanal sahibi düzenleme işlemi yapabilir.";

    const CATEGORY_EDIT_PERMISSION_DENIED_TITLE = "Düzenleme Yetkiniz Yok";
    const CATEGORY_EDIT_PERMISSION_DENIED_DESCRIPTION = "Bu kategori size ait değil. Sadece kategori sahibi düzenleme işlemi yapabilir.";

    const PLAYLIST_EDIT_PERMISSION_DENIED_TITLE = "Düzenleme Yetkiniz Yok";
    const PLAYLIST_EDIT_PERMISSION_DENIED_DESCRIPTION = "Bu oynatma listesi size ait değil. Sadece oynatma listesi sahibi düzenleme işlemi yapabilir.";

    const VIDEO_EDIT_PERMISSION_DENIED_TITLE = "Düzenleme Yetkiniz Yok";
    const VIDEO_EDIT_PERMISSION_DENIED_DESCRIPTION = "Bu video size ait değil. Sadece video sahibi düzenleme işlemi yapabilir.";

    const SHORT_EDIT_PERMISSION_DENIED_TITLE = "Düzenleme Yetkiniz Yok";
    const SHORT_EDIT_PERMISSION_DENIED_DESCRIPTION = "Bu kısa video size ait değil. Sadece kısa video sahibi düzenleme işlemi yapabilir.";

    const MUSIC_EDIT_PERMISSION_DENIED_TITLE = "Düzenleme Yetkiniz Yok";
    const MUSIC_EDIT_PERMISSION_DENIED_DESCRIPTION = "Bu müzik size ait değil. Sadece müzik sahibi düzenleme işlemi yapabilir.";

    protected string $title;
    protected string $description;

    public function __construct(string $title, string $description, string $message = "Yetki yok!")
    {
        parent::__construct($message);
        $this->title = $title;
        $this->description = $description;
    }

    public function getErrors(): array
    {
        return [
            "title" => $this->title,
            "message" => $this->description,
        ];
    }
}
