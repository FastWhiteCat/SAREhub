<?php

namespace Fwc\SAREhub\Observer;

use Magento\Framework\Event\Observer;

/**
 * Class CartUpdateItemsAfter
 */
class CartUpdateItemsAfter extends AbstractObserver
{
    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $items = $observer->getCart()->getQuote()->getItems();
        $info  = $observer->getInfo()->getData();

        foreach ($items as $item) {
            if (isset($info[$item->getId()])) {
                $qtyChange = $info[$item->getId()]['qty'] - $item->getQty();
                $this->eventsStorage->addEventToStorage($item->getSku(), $qtyChange);
            }
        }
    }
}
