<?php

namespace Fwc\SAREhub\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Config
 */
class Config extends AbstractHelper
{
    const SAREHUB_GENERAL_ENABLED         = 'sarehub/general/enabled';
    const SAREHUB_GENERAL_TRACKING_CODE   = 'sarehub/general/tracking_code';
    const SAREHUB_TRACKING_EVENTS         = 'sarehub/tracking/events';
    const SAREHUB_WEB_PUSH_ENABLED        = 'sarehub/web_push/enabled';
    const SAREHUB_WEB_PUSH_TYPE           = 'sarehub/web_push/type';
    const SAREHUB_WEB_PUSH_SEND_HTTPS     = 'sarehub/web_push/send_https';
    const SAREHUB_WEB_PUSH_SEND_HTTP_MODE = 'sarehub/web_push/send_http_mode';
    const GENERAL_COUNTRY_DEFAULT         = 'general/country/default';
    const GENERAL_LOCALE_CODE             = 'general/locale/code';

    /**
     * @return mixed
     */
    public function getTrackingEvents()
    {
        return $this->scopeConfig->getValue(self::SAREHUB_TRACKING_EVENTS);
    }

    /**
     * @return bool
     */
    public function isGeneralEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::SAREHUB_GENERAL_ENABLED);
    }

    /**
     * @return string
     */
    public function getTrackingCode()
    {
        return (string) $this->scopeConfig->getValue(self::SAREHUB_GENERAL_TRACKING_CODE);
    }

    /**
     * @return string
     */
    public function getGeneralCountryDefault()
    {
        return (string) $this->scopeConfig->getValue(self::GENERAL_COUNTRY_DEFAULT);
    }
    public function isWebPushEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::SAREHUB_WEB_PUSH_ENABLED);
    }
    /**
     * @return string
     */
    public function getWebPushType()
    {
        return (string) $this->scopeConfig->getValue(self::SAREHUB_WEB_PUSH_TYPE);
    }

    /**
     * @return bool
     */
    public function isWebPushSendHttps()
    {
        return $this->scopeConfig->isSetFlag(self::SAREHUB_WEB_PUSH_SEND_HTTPS);
    }

    /**
     * @return string
     */
    public function getWebPushSendHttpMode()
    {
        return (string) $this->scopeConfig->getValue(self::SAREHUB_WEB_PUSH_SEND_HTTP_MODE);
    }

    /**
     * @return string
     */
    public function getGeneralLocaleCode()
    {
        return (string) $this->scopeConfig->getValue(self::GENERAL_LOCALE_CODE);
    }

    /**
     * @return string
     */
    public function getGeneralLocaleLanguageCode()
    {
        return explode('_', $this->getGeneralLocaleCode())[0];
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function isTrackingAllowed($key)
    {
        $allowedEvents = explode(",", $this->getTrackingEvents());

        return in_array($key, $allowedEvents);
    }
}
