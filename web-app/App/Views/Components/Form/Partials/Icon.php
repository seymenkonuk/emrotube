<?php

/** @var string $icon */

?>

<?php if ($icon !== ""): ?>
    <i class="bi <?= $this->escape($icon) ?> text-gray-400 mr-3 text-lg"></i>
<?php endif ?>