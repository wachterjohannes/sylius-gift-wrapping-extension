<?php

namespace Acme\SyliusExamplePlugin\OrderProcessing;

use Acme\SyliusExamplePlugin\Entity\Order;
use Sylius\Component\Order\Model\OrderInterface;
use Sylius\Component\Order\Processor\OrderProcessorInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

class GiftWrappingProcessor implements OrderProcessorInterface
{
    /**
     * @var FactoryInterface
     */
    private $adjustmentFactory;

    public function __construct(FactoryInterface $adjustmentFactory)
    {
        $this->adjustmentFactory = $adjustmentFactory;
    }

    /**
     * @param Order $order
     */
    public function process(OrderInterface $order): void
    {
        Assert::isInstanceOf($order, Order::class);

        $order->removeAdjustments('gift_wrapping');
        if (!$order->isGiftWrapping()) {
            return;
        }


        $adjustment = $this->adjustmentFactory->createNew();
        $adjustment->setAmount(1000);
        $adjustment->setNeutral(false);
        $adjustment->setType('gift_wrapping');

        $order->addAdjustment($adjustment);
    }
}
