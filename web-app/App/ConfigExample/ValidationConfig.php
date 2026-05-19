<?php
// ============================================================================
// File:    ValidationConfig.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Config;


class ValidationConfig
{
    // A-Z, a-z İçerebilir
    // En Az 2, En Fazla 2 Karakter
    const LANGUAGE_CODE_REGEX_ERROR = "Bu alan yalnızca A-Z, a-z karakterlerini içerebilir!";
    const LANGUAGE_CODE_REGEX_RULE = "/^[A-Za-z]+$/u";
    const LANGUAGE_CODE_MIN_LEN = 2;
    const LANGUAGE_CODE_MAX_LEN = 2;

    // a-f, 0-9 İçerebilir
    // En Az 64, En Fazla 64 Karakter
    const CSRF_TOKEN_REGEX_ERROR = "Bu alan yalnızca a-f, 0-9 karakterlerini içerebilir!";
    const CSRF_TOKEN_REGEX_RULE = "/^[a-f0-9]+$/u";
    const CSRF_TOKEN_MIN_LEN = 64;
    const CSRF_TOKEN_MAX_LEN = 64;

    // a-f, 0-9 İçerebilir
    // En Az 16, En Fazla 16 Karakter
    const CODE_REGEX_ERROR = "Bu alan yalnızca a-f, 0-9 karakterlerini içerebilir!";
    const CODE_REGEX_RULE = "/^[a-z0-9]+$/u";
    const CODE_MIN_LEN = 16;
    const CODE_MAX_LEN = 16;

    // A-Z, a-z, 0-9 İçerebilir
    // En Az 2, En Fazla 20 Karakter
    const USERNAME_REGEX_ERROR = "Bu alan yalnızca A-Z, a-z, 0-9 karakterlerini içerebilir!";
    const USERNAME_REGEX_RULE = "/^[A-Za-z0-9]+$/u";
    const USERNAME_MIN_LEN = 2;
    const USERNAME_MAX_LEN = 20;

    // En Az 5, En Fazla 254 Karakter
    const EMAIL_REGEX_ERROR = "Bu alan email formatında olmalıdır!";
    const EMAIL_REGEX_RULE = "/^[[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}+$/u";
    const EMAIL_MIN_LEN = 5;
    const EMAIL_MAX_LEN = 254;

    // En Az 1 Büyük Harf (Türkçe Karakterler Dahil)
    // En Az 1 Küçük Harf (Türkçe Karakterler Dahil)
    // En Az 1 Özel Karakter (!@#$%^&*()_\-+=])
    // En Az 8, En Fazla 20 Karakter
    const PASSWORD_REGEX_ERROR = "Bu alan en az bir büyük harf, bir küçük harf, bir rakam ve bir özel karakter içermelidir!";
    const PASSWORD_REGEX_RULE = "/^(?=.*[a-zçğıöşü])(?=.*[A-ZÇĞİÖŞÜ])(?=.*\d)(?=.*[!@#$%^&*()_\-+=])[A-Za-zçğıöşüÇĞİÖŞÜ\d!@#$%^&*()_\-+=]+$/u";
    const PASSWORD_MIN_LEN =  8;
    const PASSWORD_MAX_LEN = 20;

    // Türkçe Karakterler ve Boşluk İçerebilir
    // En Az 2, En Fazla 20 Karakter
    const NAME_REGEX_ERROR = "Bu alan yalnızca Türkçe harfler ve boşluklar içerebilir!";
    const NAME_REGEX_RULE = "/^[a-zA-ZçÇğĞıİöÖşŞüÜ\s]+$/u";
    const NAME_MIN_LEN = 2;
    const NAME_MAX_LEN = 20;

    // Türkçe Karakterler ve Boşluk İçerebilir
    // En Az 2, En Fazla 20 Karakter
    const SURNAME_REGEX_ERROR = "Bu alan yalnızca Türkçe harfler ve boşluklar içerebilir!";
    const SURNAME_REGEX_RULE = "/^[a-zA-ZçÇğĞıİöÖşŞüÜ\s]+$/u";
    const SURNAME_MIN_LEN = 2;
    const SURNAME_MAX_LEN = 20;

    // Türkçe Karakterler ve Boşluk İçerebilir
    // En Az 5, En Fazla 20 Karakter
    const TITLE_REGEX_ERROR = "Bu alan yalnızca Türkçe harfler ve boşluklar içerebilir!";
    const TITLE_REGEX_RULE = "/^[a-zA-ZçÇğĞıİöÖşŞüÜ\s]+$/u";
    const TITLE_MIN_LEN = 5;
    const TITLE_MAX_LEN = 20;

    // Her Şeyi İçerebilir
    // En Az 20, En Fazla 1000 Karakter
    const DESC_REGEX_ERROR = "Bu alan beklenmedik karakterler içeriyor!";
    const DESC_REGEX_RULE = "/^.*$/su";
    const DESC_MIN_LEN = 20;
    const DESC_MAX_LEN = 1000;

    // Local URL
    const LOCAL_URL_REGEX_ERROR = "Bu alan beklenmedik karakterler içeriyor!";
    const LOCAL_URL_REGEX_RULE = "/^(\/[^\/]|\.\.\/|\.\/)[^\s]*$/su";
    const LOCAL_URL_MIN_LEN = 2;
    const LOCAL_URL_MAX_LEN = 255;

    // Dosya Adı
    const FILE_NAME_REGEX_ERROR = "Bu alan beklenmedik karakterler içeriyor!";
    const FILE_NAME_REGEX_RULE = "/^(\w)*\.(\w)+$/su";
    const FILE_NAME_MIN_LEN = 2;
    const FILE_NAME_MAX_LEN = 255;

    // Şehirler
    const COUNTRIES = [
        "Türkiye",
    ];

    // Dosya Türü İzinleri
    const ALLOW_AVATAR_FILES = ["image/png", "image/jpeg"];
    const ALLOW_BANNER_FILES = ["image/png", "image/jpeg", "image/gif"];
    const ALLOW_THUMBNAIL_FILES = ["image/png", "image/jpeg"];
    const ALLOW_CAPTION_FILES = ["text/vtt", "text/plain"];
    const ALLOW_VIDEO_FILES = ["video/mp4"];
    const ALLOW_SHORT_FILES = ["video/mp4"];
    const ALLOW_MUSIC_FILES = ["audio/mpeg"];

    // Dosya İsim İzinleri
    const AVATAR_FILE_NAME_REGEX_ERROR = "Yalnızca PNG, JPG ve JPEG dosyalarına izin veriliyor!";
    const AVATAR_FILE_NAME_REGEX_RULE = "/^(\w)*\.(png|jpg|jpeg)$/";
    const BANNER_FILE_NAME_REGEX_ERROR = "Yalnızca PNG, JPG, JPEG ve GIF dosyalarına izin veriliyor!";
    const BANNER_FILE_NAME_REGEX_RULE = "/^(\w)*\.(png|jpg|jpeg|gif)$/";
    const THUMBNAIL_FILE_NAME_REGEX_ERROR = "Yalnızca PNG, JPG ve JPEG dosyalarına izin veriliyor!";
    const THUMBNAIL_FILE_NAME_REGEX_RULE = "/^(\w)*\.(png|jpg|jpeg)$/";
    const CAPTION_FILE_NAME_REGEX_ERROR = "Yalnızca VTT ve SRT dosyalarına izin veriliyor!";
    const CAPTION_FILE_NAME_REGEX_RULE = "/^(\w)*\.(vtt|srt)$/";
    const VIDEO_FILE_NAME_REGEX_ERROR = "Yalnızca MP4 dosyalarına izin veriliyor!";
    const VIDEO_FILE_NAME_REGEX_RULE = "/^(\w)*\.(mp4)$/";
    const SHORT_FILE_NAME_REGEX_ERROR = "Yalnızca MP4 dosyalarına izin veriliyor!";
    const SHORT_FILE_NAME_REGEX_RULE = "/^(\w)*\.(mp4)$/";
    const MUSIC_FILE_NAME_REGEX_ERROR = "Yalnızca MP3 dosyalarına izin veriliyor!";
    const MUSIC_FILE_NAME_REGEX_RULE = "/^(\w)*\.(mp3)$/";

    // Dosya Boyut İzinleri
    const MIN_AVATAR_FILE_SIZE = 0;
    const MAX_AVATAR_FILE_SIZE = 16 * 1024 * 1024;          // 16 MiB
    const MIN_BANNER_FILE_SIZE = 0;
    const MAX_BANNER_FILE_SIZE = 64 * 1024 * 1024;          // 64 MiB
    const MIN_THUMBNAIL_FILE_SIZE = 0;
    const MAX_THUMBNAIL_FILE_SIZE = 32 * 1024 * 1024;       // 32 MiB
    const MIN_CAPTION_FILE_SIZE = 0;
    const MAX_CAPTION_FILE_SIZE = 4 * 1024 * 1024;          // 4 MiB
    const MIN_VIDEO_FILE_SIZE = 0;
    const MAX_VIDEO_FILE_SIZE = 32 * 1024 * 1024 * 1024;    // 32 GiB
    const MIN_SHORT_FILE_SIZE = 0;
    const MAX_SHORT_FILE_SIZE = 8 * 1024 * 1024 * 1024;     // 8 GiB
    const MIN_MUSIC_FILE_SIZE = 0;
    const MAX_MUSIC_FILE_SIZE = 1 * 1024 * 1024 * 1024;     // 1 GiB

    // Erişim İzinleri
    const VIEW_TYPES = ["0", "1", "2"];
    const COMMENT_TYPES = ["0", "1"];

    // Filtreler
    const CONTENT_TYPE_FILTERS = ["video", "music", "short", "channel", "playlist"];
    const DURATION_FILTERS = ["short", "medium", "long"];
    const SORT_FILTERS = ["views", "recent", "rating", "duration"];
    const DATE_FILTERS = ["today", "week", "month", "year"];
}
