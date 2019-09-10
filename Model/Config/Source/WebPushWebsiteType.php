<?php

namespace Fwc\SAREhub\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class WebPushWebsiteType
 */
class WebPushWebsiteType implements ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 'http',
                'label' => __('HTTP')
            ],
            [
                'value' => 'https',
                'label' => __('HTTPS')
            ]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'http'  => __('HTTP'),
            'https' => __('HTTPS')
        ];
    }
}
