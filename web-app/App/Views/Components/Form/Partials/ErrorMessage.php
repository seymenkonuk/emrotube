<?php

/** @var string $id */
/** @var string $text */

?>

<p
    id="<?= $this->escape($id) ?>-error"
    class="mt-1 text-sm text-red-600">
    <?= $this->escape($text) ?>
</p>