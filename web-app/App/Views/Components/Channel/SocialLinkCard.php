<?php

use Seymen\PhpMvcTemplate\DTO\SocialLinkDTO;

?>

<?php

/** @var SocialLinkDTO $link */

?>

<?= $this->layout("Components/Wrapper/Card") ?>

<a
    href="<?= $this->escape($link->url) ?>"
    class="p-4 flex items-center">
    <i class="bi <?= $this->escape($link->icon) ?> text-2xl text-black-400 mr-3"></i>
    <span class="font-semibold text-gray-800">
        <?= $this->escape($link->name) ?>
    </span>
</a>