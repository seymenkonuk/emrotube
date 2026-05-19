<?php

use Seymen\PhpMvcTemplate\DTO\OptionDTO;

?>

<?php

/** @var array<OptionDTO> $viewTypes */
/** @var array $errorMessages */
/** @var array $defaultValues */

?>

<?= $this->layout("Components/Wrapper/PostForm", [
    "action" => "/studio/playlists/new",
    "enctype" => "multipart/form-data",
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/Title", ["text" => "Oynatma Listesi Oluştur"]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/TextInput", [
    "id" => "title",
    "icon" => "bi-text-left",
    "label" => "Başlık",
    "placeholder" => "Oynatma listesi başlığınızı giriniz",
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

<!-- Banner Photo -->
<?= $this->insert("Components/Form/Elements/FileInput", [
    "id" => "banner_photo",
    "icon" => "bi-image",
    "label" => "Banner Fotoğrafı",
    "description" => "Yalnızca PNG, JPG veya GIF dosyaları yükleyebilirsiniz.",
    "errorMessage" => $errorMessages["files"]["banner_photo"] ?? "",
    "accept" => ".png, .jpg, .jpeg, .gif, image/png, image/jpeg, image/gif",
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