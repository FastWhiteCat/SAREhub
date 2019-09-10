<?php

namespace Fwc\SAREhub\Observer;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Session\SessionManagerInterface;
use Fwc\SAREhub\Model\EventsStorage;

/**
 * Class AbstractObserver
 */
abstract class AbstractObserver implements ObserverInterface
{
    const KEY_QUOTE_ITEM = 'quote_item';

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var SessionManagerInterface
     */
    protected $coreSession;

    /**
     * @var EventsStorage
     */
    protected $eventsStorage;

    public function __construct(
        RequestInterface $request,
        SessionManagerInterface $coreSession,
        EventsStorage $eventsStorage
    ) {
        $this->request       = $request;
        $this->coreSession   = $coreSession;
        $this->eventsStorage = $eventsStorage;
    }
}
