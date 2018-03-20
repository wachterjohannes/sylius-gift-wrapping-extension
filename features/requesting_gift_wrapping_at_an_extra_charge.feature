@gift_wrapping
Feature: Requesting gift wrapping at an extra charge
    In order to quickly send amazing gifts to the ones they love
    As a customer
    I want to request gift wrapping for my order at an extra charge

    Background:
        Given the store operates on a single channel in "United States"
        And the store has a product "PHP T-Shirt" priced at "$100.00"
        When I add this product to the cart

    Scenario: Extra charge is added to an order for gift wrapping
        And I request my order to be gift wrapped
        Then my cart total should be "$110.00"

    Scenario: No extra charge is added without the gift wrapping
        Then my cart total should be "$100.00"
