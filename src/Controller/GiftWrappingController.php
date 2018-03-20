<?php

namespace Acme\SyliusExamplePlugin\Controller;

use Sylius\Component\Order\SyliusCartEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Response;

class GiftWrappingController extends Controller
{
    public function cancelAction(): Response
    {
        $cart = $this->get('sylius.context.cart')->getCart();
        $cart->setGiftWrapping(false);

        $this->get('event_dispatcher')->dispatch(SyliusCartEvents::CART_CHANGE, new GenericEvent($cart));

        $this->get('sylius.manager.order')->flush();

        $this->addFlash('success', 'Gift wrapping was canceled');

        return $this->redirectToRoute('sylius_shop_cart_summary');
    }
}
