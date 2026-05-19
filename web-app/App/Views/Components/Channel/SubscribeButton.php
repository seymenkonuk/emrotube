<?php

use Seymen\PhpMvcTemplate\DTO\SubscriptionDTO;
use Seymen\PhpMvcTemplate\Enums\SubscribeType;

?>

<?php

/** @var SubscriptionDTO $subscriptionInfo */

?>

<?php if ($subscriptionInfo->type->value === SubscribeType::NORMAL->value): ?>    
    <?= $this->insert("Components/Form/Elements/Button", [
        "icon" => "bi-bell-slash",
        "text" => "Abonelikten Çık",
        "color" => "bg-red-500",
        "hoverColor" => "bg-red-600",
        "textColor" => "text-white",
    ]) ?>
<?php elseif ($subscriptionInfo->type->value === SubscribeType::NOT_SUBSCRIBED->value):  ?>
    <?= $this->insert("Components/Form/Elements/Button", [
        "icon" => "bi-bell",
        "text" => "Abone Ol",
        "color" => "bg-blue-500",
        "hoverColor" => "bg-blue-600",
        "textColor" => "text-white",
    ]) ?>
<?php endif ?>
