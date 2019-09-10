<?php

namespace Fwc\SAREhub\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Session\SessionManagerInterface as CoreSession;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * @var CoreSession
     */
    protected $coreSession;

    /**
     * Index constructor.
     *
     * @param Context     $context
     * @param PageFactory $pageFactory
     * @param CoreSession $coreSession
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CoreSession $coreSession
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->coreSession = $coreSession;
    }

    public function execute()
    {
        $events = $this->coreSession->getSarehubEvents();
        $this->coreSession->unsSarehubEvents();

        if ($events === null) {
            $events = [];
        }

        echo json_encode($events);
    }
}
