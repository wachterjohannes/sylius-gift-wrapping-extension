<?php

declare(strict_types=1);

namespace Acme\SyliusExamplePlugin\Entity;

class Order extends \Sylius\Component\Core\Model\Order
{
    /**
     * @var bool
     */
    private $giftWrapping;

    public function isGiftWrapping(): ?bool
    {
        return $this->giftWrapping;
    }

    public function setGiftWrapping(bool $giftWrapping): void
    {
        $this->giftWrapping = $giftWrapping;
    }
}
