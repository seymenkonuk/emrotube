<?php

/** @var string $action */
/** @var ?string $enctype */

?>

<?= $this->layout("Components/Wrapper/Card") ?>

<form
    method="POST"
    action="<?= $this->escape($action) ?>"
    <?php if (isset($enctype)): ?>
    enctype="<?= $this->escape($enctype) ?>"
    <?php endif ?>
    onsubmit="return addCsrfToken(this) && sanitizeForm(this)"
    class="space-y-4 p-8">

    <?= $this->section("content"); ?>
</form>