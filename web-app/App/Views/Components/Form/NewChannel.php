<?php

/** @var array  $errorMessages */
/** @var array  $defaultValues */

?>

<?= $this->layout("Components/Wrapper/PostForm", [
    "action" => "/studio/channels/new",
    "enctype" => "multipart/form-data",
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/Title", ["text" => "Yeni Kanal Oluştur"]) ?>

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

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/TextInput", [
    "id" => "title",
    "icon" => "bi-text-left",
    "label" => "Başlık",
    "placeholder" => "Kanal başlığınızı giriniz",
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

<!-- Instagram -->
<?= $this->insert("Components/Form/Elements/UrlInput", [
    "id" => "instagram_url",
    "icon" => "bi-instagram",
    "label" => "Instagram",
    "placeholder" => "Instagram URL'ninizi giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["instagram_url"] ?? "",
    "value" => $defaultValues["body"]["instagram_url"] ?? "",
    "isRequire" => false,
    "disabled" => false,
]) ?>

<!-- Twitter -->
<?= $this->insert("Components/Form/Elements/UrlInput", [
    "id" => "twitter_url",
    "icon" => "bi-twitter",
    "label" => "Twitter",
    "placeholder" => "Twitter URL'ninizi giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["twitter_url"] ?? "",
    "value" => $defaultValues["body"]["twitter_url"] ?? "",
    "isRequire" => false,
    "disabled" => false,
]) ?>

<!-- Facebook -->
<?= $this->insert("Components/Form/Elements/UrlInput", [
    "id" => "facebook_url",
    "icon" => "bi-facebook",
    "label" => "Facebook",
    "placeholder" => "Facebook URL'ninizi giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["facebook_url"] ?? "",
    "value" => $defaultValues["body"]["facebook_url"] ?? "",
    "isRequire" => false,
    "disabled" => false,
]) ?>

<!-- LinkedIn -->
<?= $this->insert("Components/Form/Elements/UrlInput", [
    "id" => "linkedin_url",
    "icon" => "bi-linkedin",
    "label" => "LinkedIn",
    "placeholder" => "LinkedIn URL'ninizi giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["linkedin_url"] ?? "",
    "value" => $defaultValues["body"]["linkedin_url"] ?? "",
    "isRequire" => false,
    "disabled" => false,
]) ?>

<!-- Github -->
<?= $this->insert("Components/Form/Elements/UrlInput", [
    "id" => "github_url",
    "icon" => "bi-github",
    "label" => "Github",
    "placeholder" => "Github URL'ninizi giriniz",
    "description" => "",
    "errorMessage" => $errorMessages["body"]["github_url"] ?? "",
    "value" => $defaultValues["body"]["github_url"] ?? "",
    "isRequire" => false,
    "disabled" => false,
]) ?>

<!-- Profile Photo -->
<?= $this->insert("Components/Form/Elements/FileInput", [
    "id" => "profile_photo",
    "icon" => "bi-image",
    "label" => "Profil Fotoğrafı",
    "description" => "Yalnızca PNG veya JPG dosyaları yükleyebilirsiniz.",
    "errorMessage" => $errorMessages["files"]["profile_photo"] ?? "",
    "accept" => ".png, .jpg, .jpeg, image/png, image/jpeg",
    "isRequire" => false,
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