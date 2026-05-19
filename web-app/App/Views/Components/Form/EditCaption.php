<?php

/** @var array $errorMessages */
/** @var array $defaultValues */

?>

<?= $this->layout("Components/Wrapper/PostForm", [
    "action" => "",
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/Title", ["text" => "Altyazıyı Düzenle"]) ?>

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

<!-- Değişiklikleri Kaydet -->
<?= $this->insert("Components/Form/Elements/Submit", [
    "text" => "Değişiklikleri Kaydet",
    "icon" => "bi-pencil-square",
    "color" => "bg-blue-500",
    "hoverColor" => "bg-blue-600",
    "textColor" => "text-white",
]) ?>