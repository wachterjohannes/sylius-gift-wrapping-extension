<?php

namespace spec\Acme\SyliusExamplePlugin\OrderProcessing;

use Acme\SyliusExamplePlugin\Entity\Order;
use Acme\SyliusExamplePlugin\OrderProcessing\GiftWrappingProcessor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Component\Core\Model\AdjustmentInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Order\Processor\OrderProcessorInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class GiftWrappingProcessorSpec extends ObjectBehavior
{
    function let(FactoryInterface $adjustmentFactory)
    {
        $this->beConstructedWith($adjustmentFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GiftWrappingProcessor::class);
    }

    function it_is_an_order_processor_from_Sylius()
    {
        $this->shouldImplement(OrderProcessorInterface::class);
    }

    function it_adds_10_usd_adjustment_when_order_is_supposed_to_be_gift_wrapping(
        Order $order,
        FactoryInterface $adjustmentFactory,
        AdjustmentInterface $adjustment
    ) {
        $order->isGiftWrapping()->willReturn(true);
        $adjustmentFactory->createNew()->willReturn($adjustment);

        $order->removeAdjustments('gift_wrapping')->shouldBeCalled();
        $adjustment->setAmount(1000)->shouldBeCalled();
        $adjustment->setNeutral(false)->shouldBeCalled();
        $adjustment->setType('gift_wrapping')->shouldBeCalled();

        $order->addAdjustment($adjustment)->shouldBeCalled();

        $this->process($order);
    }

    function it_dont_adds_10_usd_adjustment_when_order_not_supposed_to_be_gift_wrapping(
        Order $order
    ) {
        $order->isGiftWrapping()->willReturn(false);

        $order->addAdjustment(Argument::any())->shouldNotBeCalled();

        $this->process($order);
    }

    function it_throws_an_exception_when_order_unaware_of_gift_wrapping_is_processed(
        OrderInterface $coreOrder
    ) {
        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->during('process', [$coreOrder]);
    }

    function it_dont_adds_10_usd_adjustment_when_order_already_has_this_adjustment(
        Order $order,
        FactoryInterface $adjustmentFactory,
        AdjustmentInterface $adjustment
    ) {
        $order->isGiftWrapping()->willReturn(true);
        $adjustmentFactory->createNew()->willReturn($adjustment);

        $order->removeAdjustments('gift_wrapping')->shouldBeCalled();
        $adjustment->setAmount(1000)->shouldBeCalled();
        $adjustment->setNeutral(false)->shouldBeCalled();
        $adjustment->setType('gift_wrapping')->shouldBeCalled();
        $order->addAdjustment($adjustment)->shouldBeCalled();

        $this->process($order);
    }
}
