<?php

/** @var string $title */
/** @var string $value */
/** @var string $valueFormatted */

?>

<?= $this->layout("Components/Wrapper/Card") ?>

<div class="p-4">
    <h3 class="font-semibold text-gray-700 mb-1">
        <?= $this->escape($title) ?>
    </h3>

    <p
        title="<?= $this->escape($value) ?>"
        class="text-gray-900 font-bold">
        <?= $this->escape($valueFormatted) ?>
    </p>
</div>