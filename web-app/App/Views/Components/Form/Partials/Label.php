<?php

/** @var string $id */
/** @var string $text */

?>

<?php if ($text !== ""): ?>
    <label
        for="<?= $this->escape($id) ?>"
        class="block font-semibold text-gray-700 mb-1">
        <?= $this->escape($text) ?>
    </label>
<?php endif ?>