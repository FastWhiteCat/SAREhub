<?php

namespace Fwc\SAREhub\Model;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Event
 * Used in creating options for Yes|No config value selection
 */
class Event implements ArrayInterface, EventListInterface
{
    /**
     * @var array
     */
    public static $events = [
        self::LOGIN_PAGE        => 'Login page visit',
        self::CATEGORY          => 'Category page visit',
        self::PRODUCT           => 'Product page visit',
        self::CART_ADD          => 'Adding product to cart',
        self::CART_DEL          => 'Removing product from cart',
        self::CART_REGISTRATION => 'Checkout page visit',
        self::CART_PURCHASED    => 'Order success page visit',
        self::CART_CONFIRM      => 'Page before order is placed',
        self::CART_QUANTITY     => 'Products quantity changed in cart',
        self::CART_INITIALIZED  => 'Start the ordering process',
        self::CART_DELIVERY     => 'Select shipping method',
        self::CART_PAYMENT      => 'Select payment method',
        self::CART_SUMMARY      => 'Cart summary'
    ];

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $optionArray = [];
        foreach (self::$events as $value => $label) {
            $optionArray[] = [
                'value' => $value,
                'label' => __($label)
            ];
        }

        return $optionArray;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $returnArray = [];
        foreach (self::$events as $value => $label) {
            $returnArray[$value] = __($label);
        }

        return $returnArray;
    }
}
