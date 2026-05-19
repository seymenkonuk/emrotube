<?php

/** @var string $id */
/** @var string $text */

?>

<p
    id="<?= $this->escape($id) ?>-description"
    class="mt-1 text-sm text-gray-500">
    <?= $this->escape($text) ?>
</p>