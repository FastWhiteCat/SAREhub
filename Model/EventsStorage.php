<?php

namespace Fwc\SAREhub\Model;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Session\SessionManagerInterface as CoreSession;
use Fwc\SAREhub\Helper\Product;

/**
 * Class EventsStorage
 */
class EventsStorage
{
    /**
     * @var Product
     */
    protected $productHelper;

    /**
     * @var CoreSession
     */
    protected $coreSession;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var array
     */
    private $events = [];

    /**
     * EventsStorage constructor.
     *
     * @param CoreSession      $coreSession
     * @param RequestInterface $request
     * @param Product          $productHelper
     */
    public function __construct(
        CoreSession $coreSession,
        RequestInterface $request,
        Product $productHelper
    ) {
        $this->productHelper = $productHelper;
        $this->coreSession   = $coreSession;
        $this->request       = $request;
    }

    /**
     * @param $sku
     * @param $qtyChange
     *
     * @return $this
     */
    public function addEventToStorage($sku, $qtyChange)
    {
        if ($this->request->isAjax()) {
            return $this;
        }
        if ($qtyChange != 0) {
            $eventData                          = $this->processEvent($sku, $qtyChange);
            $this->events[$eventData['action']] = $eventData['productData'];
            $this->coreSession->setSarehubEvents($this->events);
        }
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param $sku
     * @param $qtyChange
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function processEvent($sku, $qtyChange)
    {
        $productData             = $this->productHelper->populateProductData($sku);
        $productData['quantity'] = abs($qtyChange);
        $eventData               = [
            'action'      => $qtyChange > 0 ? '_cartAdd' : '_cartDel',
            'qty'         => abs($qtyChange),
            'productData' => $productData
        ];

        return $eventData;
    }
}
