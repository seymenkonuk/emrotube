<?php

/** @var string $brandName */

?>

<?php if ($brandName !== ''): ?>
    <a href="/" class="text-2xl font-bold"><?= $this->escape($brandName) ?></a>
<?php endif ?>