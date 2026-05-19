<?php

use Seymen\PhpMvcTemplate\DTO\OptionDTO;

?>

<?php

/** @var array<OptionDTO> $countries */
/** @var array $errorMessages */
/** @var array $defaultValues */

?>


<?= $this->layout("Components/Wrapper/PostForm", [
    "action" => "",
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/Title", ["text" => "Kullanıcıyı Düzenle"]) ?>

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
    "disabled" => true,
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
    "disabled" => true,
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
    "disabled" => true,
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

<!-- Değişiklikleri Kaydet -->
<?= $this->insert("Components/Form/Elements/Submit", [
    "text" => "Değişiklikleri Kaydet",
    "icon" => "bi-pencil-square",
    "color" => "bg-blue-500",
    "hoverColor" => "bg-blue-600",
    "textColor" => "text-white",
]) ?>