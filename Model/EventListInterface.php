<?php

namespace Fwc\SAREhub\Model;

/**
 * Interface EventListInterface
 */
interface EventListInterface
{
    /**
     * Sare events ids
     */
    const LOGIN_PAGE        = '_loginpage';
    const CATEGORY          = '_category';
    const PRODUCT           = '_product';
    const CART_ADD          = '_cartadd';
    const CART_DEL          = '_cartdel';
    const CART_REGISTRATION = '_cartregistration';
    const CART_PURCHASED    = '_cartpurchased';
    const CART_CONFIRM      = '_cartconfirm';
    const CART_QUANTITY     = '_cartquantity';
    const CART_INITIALIZED  = '_cartinitialized';
    const CART_DELIVERY     = '_cartdelivery';
    const CART_PAYMENT      = '_cartpayment';
    const CART_SUMMARY      = '_cartsummary';
}
