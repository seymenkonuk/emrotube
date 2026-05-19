<?php

use Seymen\PhpMvcTemplate\Models\UserAuth;

?>

<?php

/** @var ?UserAuth $auth */

?>

<div class="grid grid-col-1 gap-4 border-t p-4 xl:hidden">
    <?= $this->insert("Layouts/Partials/AuthInfo", ["auth" => $auth]); ?>
</div>