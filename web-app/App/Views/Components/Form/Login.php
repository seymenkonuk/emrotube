<?php

/** @var array      $errorMessages */
/** @var array      $defaultValues */
/** @var ?string    $redirectUri */

?>

<?= $this->layout("Components/Wrapper/PostForm", [
    "action" => "/login" . (($redirectUri !== null) ? "?redirect_uri=$redirectUri" : ""),
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/Title", ["text" => "Giriş Yap"]) ?>

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

<!-- Giriş Yap -->
<?= $this->insert("Components/Form/Elements/Submit", [
    "text" => "Giriş Yap",
    "icon" => "bi-box-arrow-in-right",
    "color" => "bg-blue-500",
    "hoverColor" => "bg-blue-600",
    "textColor" => "text-white",
]) ?>

<!-- Hesabın yok mu? Kayıt Ol -->
<?= $this->insert("Components/Form/Elements/Link", [
    "label" => "Hesabın yok mu?",
    "text" => "Kayıt Ol",
    "href" => "/register" . (($redirectUri !== null) ? "?redirect_uri=$redirectUri" : ""),
]) ?>