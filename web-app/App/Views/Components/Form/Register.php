<?php

use Seymen\PhpMvcTemplate\DTO\OptionDTO;

?>

<?php

/** @var array<OptionDTO>   $countries */
/** @var array              $errorMessages */
/** @var array              $defaultValues */
/** @var ?string            $redirectUri */

?>

<?= $this->layout("Components/Wrapper/PostForm", [
    "action" => "/register" . (($redirectUri !== null) ? "?redirect_uri=$redirectUri" : ""),
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/Title", ["text" => "Kayıt Ol"]) ?>

<!-- Ad -->
<?= $this->insert("Components/Form/Elements/TextInput", [
    "id" => "name",
    "icon" => "bi-person-lines-fill",
    "label" => "Ad",
    "placeholder" => "Adınızı giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["name"] ?? "",
    "value" => $defaultValues["body"]["name"] ?? "",
    "isRequire" => true,
    "disabled" => false,
]) ?>

<!-- Soyad -->
<?= $this->insert("Components/Form/Elements/TextInput", [
    "id" => "surname",
    "icon" => "bi-person-lines-fill",
    "label" => "Soyad",
    "placeholder" => "Soyadınızı giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["surname"] ?? "",
    "value" => $defaultValues["body"]["surname"] ?? "",
    "isRequire" => true,
    "disabled" => false,
]) ?>

<!-- Kullanıcı Adı -->
<?= $this->insert("Components/Form/Elements/TextInput", [
    "id" => "username",
    "icon" => "bi-person-fill",
    "label" => "Kullanıcı Adı",
    "placeholder" => "Kullanıcı adınızı giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["username"] ?? "",
    "value" => $defaultValues["body"]["username"] ?? "",
    "isRequire" => true,
    "disabled" => false,
]) ?>

<!-- Email -->
<?= $this->insert("Components/Form/Elements/EmailInput", [
    "id" => "email",
    "icon" => "bi-envelope-fill",
    "label" => "E-posta",
    "placeholder" => "E-posta adresinizi giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["email"] ?? "",
    "value" => $defaultValues["body"]["email"] ?? "",
    "isRequire" => true,
    "disabled" => false,
]) ?>

<!-- Parola -->
<?= $this->insert("Components/Form/Elements/PasswordInput", [
    "id" => "password",
    "icon" => "bi-lock-fill",
    "label" => "Parola",
    "placeholder" => "Parolanızı giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["password"] ?? "",
    "value" => "",
    "isRequire" => true,
    "disabled" => false,
]) ?>

<!-- Ülke -->
<?= $this->insert("Components/Form/Elements/DropDown", [
    "id" => "country",
    "icon" => "bi-globe",
    "label" => "Ülke",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["country"] ?? "",
    "value" => $defaultValues["body"]["country"] ?? "",
    "default" => new OptionDTO("", "Seçiniz"),
    "options" => $countries,
    "isRequire" => true,
    "disabled" => false,
]) ?>

<!-- Kayıt Ol -->
<?= $this->insert("Components/Form/Elements/Submit", [
    "text" => "Kayıt Ol",
    "icon" => "bi-person-plus-fill",
    "color" => "bg-blue-500",
    "hoverColor" => "bg-blue-600",
    "textColor" => "text-white",
]) ?>

<!-- Zaten hesabın var mı? Giriş Yap -->
<?= $this->insert("Components/Form/Elements/Link", [
    "label" => "Zaten hesabın var mı?",
    "text" => "Giriş Yap",
    "href" => "/login" . (($redirectUri !== null) ? "?redirect_uri=$redirectUri" : ""),
]) ?>