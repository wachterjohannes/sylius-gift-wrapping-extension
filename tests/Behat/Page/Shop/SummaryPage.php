<?php

namespace Tests\Acme\SyliusExamplePlugin\Behat\Page\Shop;

class SummaryPage extends \Sylius\Behat\Page\Shop\Cart\SummaryPage
{
    public function requestGiftWrapping()
    {
        $this->getElement('gift_wrapping')->check();
    }

    protected function getDefinedElements()
    {
        return array_merge(
            parent::getDefinedElements(),
            [
                'gift_wrapping' => '.gift-wrapping-checkbox',
            ]
        );
    }
}
