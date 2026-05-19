<?php

/** @var string $id */
/** @var string $icon */
/** @var string $label */
/** @var string $description */
/** @var string|array $errorMessage */
/** @var bool   $isRequire */
/** @var bool   $disabled */

?>

<div>
    <?= $this->insert("Components/Form/Partials/Label", [
        "id" => $id,
        "text" => $label . (($isRequire) ?  " *" : ""),
    ]) ?>

    <div
        class="flex items-center border rounded-lg px-4 py-2 transition
            <?= $disabled
                ? 'bg-gray-100 border-gray-200 text-gray-400 cursor-not-allowed opacity-60'
                : 'bg-white border-gray-300 focus-within:ring-2 focus-within:ring-blue-400'
            ?>
        ">
        <?= $this->insert("Components/Form/Partials/Icon", ["icon" => $icon]) ?>

        <?= $this->section("content") ?>
    </div>

    <?= $this->insert("Components/Form/Partials/Description", ["id" => $id, "text" => $description]) ?>
    <?php foreach ((array)$errorMessage as $message): ?>
        <?= $this->insert("Components/Form/Partials/ErrorMessage", ["id" => $id, "text" => $message]) ?>
    <?php endforeach ?>
</div>