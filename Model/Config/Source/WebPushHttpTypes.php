<?php

namespace Fwc\SAREhub\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class WebPushHttpTypes
 */
class WebPushHttpTypes implements ArrayInterface
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
                'value' => 'popup',
                'label' => __('Popup')
            ],
            [
                'value' => 'popover',
                'label' => __('Popover')
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
            'popup'  => __('Popup'),
            'popover' => __('Popover')
        ];
    }
}
