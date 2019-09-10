<?php

namespace Fwc\SAREhub\Model;

use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Store\Model\StoreManagerInterface;
use Fwc\SAREhub\Helper\Config;

/**
 * Class SareConfigProvider
 */
class SareConfigProvider
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var CurrentCustomer
     */
    private $currentCustomer;

    /**
     * @var CheckoutSession
     */
    private $checkoutSession;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * SareConfigProvider constructor.
     *
     * @param Config                $config
     * @param CurrentCustomer       $currentCustomer
     * @param CheckoutSession       $checkoutSession
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Config $config,
        CurrentCustomer $currentCustomer,
        CheckoutSession $checkoutSession,
        StoreManagerInterface $storeManager
    ) {
        $this->config          = $config;
        $this->currentCustomer = $currentCustomer;
        $this->checkoutSession = $checkoutSession;
        $this->storeManager    = $storeManager;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return [
            'events'         => $this->getEventsStatus(),
            'additionalData' => $this->getAdditionalData(),
            'webPush'        => $this->getWebPush()
        ];
    }

    /**
     * @return string|null
     */
    private function getCustomerEmail()
    {
        return $this->currentCustomer->getCustomerId() ? $this->currentCustomer->getCustomer()->getEmail() : null;
    }

    /**
     * @return string|null
     */
    private function getCustomerId()
    {
        return $this->currentCustomer->getCustomerId();
    }

    /**
     * @return string|null
     */
    private function getQuoteId()
    {
        return $this->checkoutSession->getQuoteId();
    }

    /**
     * @return array
     */
    private function getAdditionalData()
    {
        return [
            'userId'   => $this->getCustomerId(),
            'email'    => $this->getCustomerEmail(),
            'country'  => $this->config->getGeneralCountryDefault(),
            'language' => $this->config->getGeneralLocaleLanguageCode(),
            'cart_id'  => $this->getQuoteId()
        ];
    }

    /**
     * @return array
     */
    private function getWebPush()
    {
        return [
            'enabled' => $this->config->isWebPushEnabled(),
            'type' => $this->config->getWebPushType(),
            'httpMode' => $this->config->getWebPushSendHttpMode(),
            'domain' => rtrim(
                ltrim(ltrim($this->storeManager->getStore()->getBaseUrl(), 'http://'), 'https://'), '/'
            )
        ];
    }

    /**
     * @return array
     */
    private function getEventsStatus()
    {
        $eventIds = array_keys(Event::$events);
        $eventsData = [];
        foreach ($eventIds as $eventId) {
            $eventsData[$eventId] = $this->config->isTrackingAllowed($eventId);
        }

        return $eventsData;
    }
}
