<?php

/** @var array  $errorMessages */
/** @var array  $defaultValues */

?>

<?= $this->layout("Components/Wrapper/PostForm", [
    "action" => "",
    "enctype" => "multipart/form-data",
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/Title", ["text" => "Altyazı Oluştur"]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/TextInput", [
    "id" => "language_code",
    "icon" => "bi-text-left",
    "label" => "Dil Kodu",
    "placeholder" => "Dil kodunu giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["language_code"] ?? "",
    "value" => $defaultValues["body"]["language_code"] ?? "",
    "isRequire" => true,
    "disabled" => false,
]) ?>

<!-- Açıklama -->
<?= $this->insert("Components/Form/Elements/TextInput", [
    "id" => "language_name",
    "icon" => "bi-text-left",
    "label" => "Dil İsmi",
    "placeholder" => "Dil ismini giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["language_name"] ?? "",
    "value" => $defaultValues["body"]["language_name"] ?? "",
    "isRequire" => true,
    "disabled" => false,
]) ?>

<!-- Altyazı Dosyası -->
<?= $this->insert("Components/Form/Elements/FileInput", [
    "id" => "caption_file",
    "icon" => "bi-cc-circle",
    "label" => "Altyazı Dosyası",
    "description" => "Yalnızca SRT veya VTT altyazı dosyası yükleyebilirsiniz.",
    "errorMessage" => $errorMessages["files"]["caption_file"] ?? "",
    "accept" => ".srt,.vtt,text/plain",
    "isRequire" => true,
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