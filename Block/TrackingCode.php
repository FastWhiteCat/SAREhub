<?php

namespace Fwc\SAREhub\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Fwc\SAREhub\Helper\Config;

/**
 * Class TrackingCode
 */
class TrackingCode extends Template
{
    /**
     * @var Config
     */
    private $config;

    /**
     * TrackingCode constructor.
     *
     * @param Context $context
     * @param Config  $config
     * @param array   $data
     */
    public function __construct(
        Context $context,
        Config $config,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getTrackingCode()
    {
        return $this->config->getTrackingCode();
    }
}
