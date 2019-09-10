<?php

namespace Fwc\SAREhub\Observer;

use Magento\Framework\Event\Observer;

/**
 * Class QuoteRemoveItem
 */
class QuoteRemoveItem extends AbstractObserver
{
    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer){
        $item = $observer->getEvent()->getData(self::KEY_QUOTE_ITEM);
        $this->eventsStorage->addEventToStorage($item->getSku(), -1 * $item->getQty());
    }
}
