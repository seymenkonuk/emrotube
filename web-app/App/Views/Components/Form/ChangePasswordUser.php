<?php

/** @var array $errorMessages */
/** @var array $defaultValues */

?>

<?= $this->layout("Components/Wrapper/PostForm", [
    "action" => "",
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/Title", ["text" => "Parolayı Değiştir"]) ?>

<!-- Eski Parola -->
<?= $this->insert("Components/Form/Elements/PasswordInput", [
    "id" => "old_password",
    "icon" => "bi-lock-fill",
    "label" => "Mevcut Parola",
    "placeholder" => "Mevcut parolanızı giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["old_password"] ?? "",
    "value" => "",
    "isRequire" => true,
    "disabled" => false,
]) ?>

<!-- Yeni Parola -->
<?= $this->insert("Components/Form/Elements/PasswordInput", [
    "id" => "new_password",
    "icon" => "bi-lock-fill",
    "label" => "Yeni Parola",
    "placeholder" => "Yeni parolanızı giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["new_password"] ?? "",
    "value" => "",
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