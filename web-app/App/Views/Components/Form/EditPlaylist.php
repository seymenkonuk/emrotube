<?php

use Seymen\PhpMvcTemplate\DTO\OptionDTO;

?>

<?php

/** @var array<OptionDTO> $viewTypes */
/** @var array $errorMessages */
/** @var array $defaultValues */

?>

<?= $this->layout("Components/Wrapper/PostForm", [
    "action" => "",
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/Elements/Title", ["text" => "Oynatma Listesini Düzenle"]) ?>

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

<!-- Değişiklikleri Kaydet -->
<?= $this->insert("Components/Form/Elements/Submit", [
    "text" => "Değişiklikleri Kaydet",
    "icon" => "bi-pencil-square",
    "color" => "bg-blue-500",
    "hoverColor" => "bg-blue-600",
    "textColor" => "text-white",
]) ?>