<?php

/** @var string $icon */

?>

<?php if ($icon !== ""): ?>
    <i class="bi <?= $this->escape($icon) ?> mr-3 text-lg text-gray-600"></i>
<?php endif ?>