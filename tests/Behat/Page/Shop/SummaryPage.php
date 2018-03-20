<?php

namespace Tests\Acme\SyliusExamplePlugin\Behat\Page\Shop;

class SummaryPage extends \Sylius\Behat\Page\Shop\Cart\SummaryPage
{
    public function requestGiftWrapping()
    {
        $this->getElement('request_gift_wrapping')->check();
    }

    public function cancelGiftWrapping()
    {
        $this->getElement('cancel_gift_wrapping')->click();
    }

    protected function getDefinedElements()
    {
        return array_merge(
            parent::getDefinedElements(),
            [
                'request_gift_wrapping' => '.gift-wrapping-checkbox',
                'cancel_gift_wrapping' => '.gift-wrapping-checkbox',
            ]
        );
    }
}
