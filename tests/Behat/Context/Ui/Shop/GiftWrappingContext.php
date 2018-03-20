<?php

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Behat\Context\Ui\Shop;

use Behat\Behat\Context\Context;
use Tests\Acme\SyliusExamplePlugin\Behat\Page\Shop\SummaryPage;

class GiftWrappingContext implements Context
{
    /**
     * @var SummaryPage
     */
    private $summaryPage;

    public function __construct(SummaryPage $summaryPage)
    {
        $this->summaryPage = $summaryPage;
    }

    /**
     * @Given I request my order to be gift wrapped
     */
    public function iRequestMyOrderToBeGiftWrapped()
    {
        $this->summaryPage->requestGiftWrapping();
        $this->summaryPage->updateCart();
    }

    /**
     * @When then I change my mind and cancel it
     */
    public function thenIChangeMyMindAndCancelIt()
    {
        $this->summaryPage->cancelGiftWrapping();
    }
}
