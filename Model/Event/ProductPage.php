<?php

namespace Fwc\SAREhub\Model\Event;

/**
 * Class ProductPage
 */
class ProductPage extends Event implements EventInterface
{
    /**
     * @var string
     */
    public $eventId = '_product';

    /**
     * @return string
     */
    public function getCode()
    {
        $this->setData($this->eventId, $this->populateProductPageData());

        return $this->getEventData();
    }

    /**
     * @return array
     */
    private function populateProductPageData()
    {
        $product = $this->registry->registry('current_product');

        $data = [
            'id'       => $product->getId(),
            'name'     => $product->getName(),
            'price'    => $product->getFinalPrice(),
            'currency' => $this->storeManager->getStore()->getCurrentCurrency()->getCode(),
            'url'      => $this->storeManager->getStore()->getCurrentUrl(false),
            'category' => $this->categoryHelper->resolveCategoryNames($product->getCategoryIds())
        ];

        $this->addRegionData($data);

        return $data;
    }
}
