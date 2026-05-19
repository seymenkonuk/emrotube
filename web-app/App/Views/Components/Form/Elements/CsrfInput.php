<?php

/** @var string $csrfToken */

?>

<?php if ($csrfToken !== ""): ?>
    <input name="csrf_token" type="hidden" value="<?= $this->escape($csrfToken) ?>" />
<?php endif ?>