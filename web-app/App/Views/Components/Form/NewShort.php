<?php

use Seymen\PhpMvcTemplate\DTO\OptionDTO;

?>

<?php

/** @var array<OptionDTO> $viewTypes */
/** @var array<OptionDTO> $commentTypes */
/** @var array $errorMessages */
/** @var array $defaultValues */

?>

<?= $this->layout("Components/Wrapper/PostForm", [
    "action" => "/studio/shorts/new",
    "enctype" => "multipart/form-data",
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/Title", ["text" => "Kısa Video Oluştur"]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/TextInput", [
    "id" => "title",
    "icon" => "bi-text-left",
    "label" => "Başlık",
    "placeholder" => "Kısa video başlığınızı giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["title"] ?? "",
    "value" => $defaultValues["body"]["title"] ?? "",
    "isRequire" => true,
    "disabled" => false,
]) ?>

<!-- Açıklama -->
<?= $this->insert("Components/Form/Elements/TextArea", [
    "id" => "description",
    "icon" => "bi-card-text",
    "label" => "Açıklama",
    "placeholder" => "Açıklama giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["description"] ?? "",
    "value" => $defaultValues["body"]["description"] ?? "",
    "isRequire" => false,
    "disabled" => false,
]) ?>

<!-- Görüntüleme Türü -->
<?= $this->insert("Components/Form/Elements/DropDown", [
    "id" => "view_type",
    "icon" => "bi-globe",
    "label" => "Görünürlük",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["view_type"] ?? "",
    "value" => $defaultValues["body"]["view_type"] ?? "",
    "default" => new OptionDTO("", "Seçiniz"),
    "options" => $viewTypes,
    "isRequire" => true,
    "disabled" => false,
]) ?>

<!-- Yorum İzinleri -->
<?= $this->insert("Components/Form/Elements/DropDown", [
    "id" => "comment_type",
    "icon" => "bi-globe",
    "label" => "Yorum İzni",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["comment_type"] ?? "",
    "value" => $defaultValues["body"]["comment_type"] ?? "",
    "default" => new OptionDTO("", "Seçiniz"),
    "options" => $commentTypes,
    "isRequire" => true,
    "disabled" => false,
]) ?>

<!-- Video File -->
<?= $this->insert("Components/Form/Elements/FileInput", [
    "id" => "video_file",
    "icon" => "bi-camera-video",
    "label" => "Video Dosyası",
    "description" => "Yalnızca MP4 dosyaları yükleyebilirsiniz.",
    "errorMessage" => $errorMessages["files"]["video_file"] ?? "",
    "accept" => ".mp4, video/mp4",
    "isRequire" => true,
    "disabled" => false,
]) ?>

<!-- Thumbnail Photo -->
<?= $this->insert("Components/Form/Elements/FileInput", [
    "id" => "thumbnail_photo",
    "icon" => "bi-image",
    "label" => "Kapak Fotoğrafı",
    "description" => "Yalnızca PNG veya JPG dosyaları yükleyebilirsiniz.",
    "errorMessage" => $errorMessages["files"]["thumbnail_photo"] ?? "",
    "accept" => ".png, .jpg, .jpeg, image/png, image/jpeg",
    "isRequire" => false,
    "disabled" => false,
]) ?>

<!-- Oluştur -->
<?= $this->insert("Components/Form/Elements/Submit", [
    "text" => "Oluştur",
    "icon" => "bi-plus",
    "color" => "bg-blue-500",
    "hoverColor" => "bg-blue-600",
    "textColor" => "text-white",
]) ?>