<?php

use Seymen\PhpMvcTemplate\DTO\OptionDTO;

?>

<?php

/** @var array<OptionDTO>   $countries */
/** @var array              $errorMessages */
/** @var array              $defaultValues */
/** @var ?string            $redirectUri */

?>

<!-- Layout -->
<?= $this->layout("Layouts/AuthLayout", ["title" => "Kayıt Ol"]) ?>

<!-- START CONTENT SECTION -->
<?= $this->insert("Components/Form/Register", [
    "countries" => $countries,
    "errorMessages" => $errorMessages,
    "defaultValues" => $defaultValues,
    "redirectUri" => $redirectUri ?? null,
]) ?>
<!-- END CONTENT SECTION -->

<!-- START SCRIPTS SECTION -->
<?= $this->start("scripts"); ?>
<?= $this->stop(); ?>
<!-- END SCRIPTS SECTION -->

<!-- START STYLES SECTION -->
<?= $this->start("styles"); ?>
<?= $this->stop(); ?>
<!-- END STYLES SECTION -->