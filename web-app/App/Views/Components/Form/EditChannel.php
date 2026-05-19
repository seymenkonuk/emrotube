<?php

/** @var array $errorMessages */
/** @var array $defaultValues */

?>

<?= $this->layout("Components/Wrapper/PostForm", [
    "action" => "",
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/Title", ["text" => "Kanalı Düzenle"]) ?>

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
    "disabled" => true,
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

<!-- Değişiklikleri Kaydet -->
<?= $this->insert("Components/Form/Elements/Submit", [
    "text" => "Değişiklikleri Kaydet",
    "icon" => "bi-pencil-square",
    "color" => "bg-blue-500",
    "hoverColor" => "bg-blue-600",
    "textColor" => "text-white",
]) ?>