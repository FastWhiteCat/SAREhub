<?php

namespace Fwc\SAREhub\Model\Event;

use Magento\Customer\Model\Session;
use Magento\Framework\Registry;
use Magento\Store\Model\StoreManagerInterface;
use Fwc\SAREhub\Helper\Category;
use Fwc\SAREhub\Helper\Config;
use Fwc\SAREhub\Setup\AttributeCodeInterface;

/**
 * Class Event
 */
class Event
{
    const PARAMS_KEY   = 'sareX_params.';
    const KEY_COUNTRY  = 'country';
    const KEY_LANGUAGE = 'language';

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var Category
     */
    protected $categoryHelper;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var mixed
     */
    protected $param = '';

    /**
     * @var string
     */
    protected $eventId = '';

    /**
     * @var Config
     */
    protected $config;

    /**
     * Event constructor.
     *
     * @param Registry              $registry
     * @param StoreManagerInterface $storeManager
     * @param Session               $customerSession
     * @param Category              $categoryHelper
     * @param Config                $config
     */
    public function __construct(
        Registry $registry,
        StoreManagerInterface $storeManager,
        Session $customerSession,
        Category $categoryHelper,
        Config $config
    ) {
        $this->registry        = $registry;
        $this->storeManager    = $storeManager;
        $this->customerSession = $customerSession;
        $this->categoryHelper  = $categoryHelper;
        $this->config          = $config;
    }

    /**
     * @return mixed
     */
    public function getParam()
    {
        return $this->param;
    }

    /**
     * @return string
     */
    public function getCodePrefix()
    {
        return self::PARAMS_KEY . $this->getParam();
    }

    /**
     * @param $key
     */
    public function setParamsKey($key)
    {
        $this->param = $key;
    }

    /**
     * @return bool
     */
    public function isAllowed()
    {
        return $this->config->isTrackingAllowed($this->eventId);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function setData($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function addRegionData(&$data)
    {
        $data[self::KEY_COUNTRY]  = $this->config->getGeneralCountryDefault();
        $data[self::KEY_LANGUAGE] = $this->config->getGeneralLocaleLanguageCode();

        return $data;
    }

    /**
     * @return string
     */
    public function getEventData()
    {
        $jsCode = $this->getCodePrefix() . ' = ' . json_encode($this->getData()) . ';';

        if ($this->eventId == '_product') {
            $jsCode .= $this->getContainedData('_cartadd', 'productDataAdd', '_product') . ';';
            $jsCode .= $this->getContainedData('_cartdel', 'productDataRemove', '_product') . ';';
        }

        return $jsCode;
    }

    /**
     * @param $eventId
     * @param $variableName
     * @param $replacedKey
     *
     * @return string
     */
    public function getContainedData($eventId, $variableName, $replacedKey)
    {
        $jsCode            = 'var ' . $variableName . ' = ';
        $newData           = $this->getData();
        $newData[$eventId] = $newData[$replacedKey];
        unset($newData[$replacedKey]);

        $jsCode .= json_encode($newData);

        return $jsCode;
    }
}
