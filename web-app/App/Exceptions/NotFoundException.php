<?php
// ============================================================================
// File:    NotFoundException.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Exceptions;


use Exception;


class NotFoundException extends Exception
{
    const INVALID_PAGE_TITLE = "Geçersiz Sayfa Numarası";
    const INVALID_PAGE_DESCRIPTION = "İstediğiniz sayfa numarası mevcut değil. Lütfen geçerli bir sayfa numarası girin.";

    const USER_NOT_FOUND_TITLE = "Kullanıcı Bulunamadı";
    const USER_NOT_FOUND_DESCRIPTION = "Aradığınız kullanıcı mevcut değil. Silinmiş, kaldırılmış ya da bağlantı hatalı olabilir.";

    const CHANNEL_NOT_FOUND_TITLE = "Kanal Bulunamadı";
    const CHANNEL_NOT_FOUND_DESCRIPTION = "Aradığınız kanal mevcut değil. Silinmiş, kaldırılmış ya da bağlantı hatalı olabilir.";

    const CATEGORY_NOT_FOUND_TITLE = "Kategori Bulunamadı";
    const CATEGORY_NOT_FOUND_DESCRIPTION = "Aradığınız kategori mevcut değil. Silinmiş, kaldırılmış ya da bağlantı hatalı olabilir.";

    const PLAYLIST_NOT_FOUND_TITLE = "Oynatma Listesi Bulunamadı";
    const PLAYLIST_NOT_FOUND_DESCRIPTION = "Aradığınız oynatma listesi mevcut değil. Silinmiş, kaldırılmış ya da bağlantı hatalı olabilir.";

    const VIDEO_NOT_FOUND_TITLE = "Video Bulunamadı";
    const VIDEO_NOT_FOUND_DESCRIPTION = "Aradığınız video mevcut değil. Silinmiş, kaldırılmış ya da bağlantı hatalı olabilir.";

    const SHORT_NOT_FOUND_TITLE = "Kısa Video Bulunamadı";
    const SHORT_NOT_FOUND_DESCRIPTION = "Aradığınız kısa video mevcut değil. Silinmiş, kaldırılmış ya da bağlantı hatalı olabilir.";

    const MUSIC_NOT_FOUND_TITLE = "Müzik Bulunamadı";
    const MUSIC_NOT_FOUND_DESCRIPTION = "Aradığınız müzik mevcut değil. Silinmiş, kaldırılmış ya da bağlantı hatalı olabilir.";

    protected string $title;
    protected string $description;

    public function __construct(string $title, string $description, string $message = "Bulunamadı!")
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
