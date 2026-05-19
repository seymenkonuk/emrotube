<?php
// ============================================================================
// File:    SubscriptionDTO.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\DTO;


use Seymen\PhpMvcTemplate\Enums\SubscribeType;


/**
 * @property SubscribeType  $type
 * @property ?string        $title
 */
class SubscriptionDTO
{
    public function __construct(
        private SubscribeType   $type,
        private ?string         $title,
    ) {}

    public function __get($name)
    {
        return $this->$name;
    }

    public static function create(int $subscriptionType, ?string $subscriptionTitle): self
    {
        return new self(
            SubscribeType::from($subscriptionType),
            $subscriptionTitle ?? null,
        );
    }
}
