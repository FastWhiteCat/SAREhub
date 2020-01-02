<?php

namespace Fwc\SAREhub\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
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
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * Index constructor.
     *
     * @param Context     $context
     * @param PageFactory $pageFactory
     * @param CoreSession $coreSession
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CoreSession $coreSession,
        JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->pageFactory       = $pageFactory;
        $this->coreSession       = $coreSession;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute()
    {
        $events = $this->coreSession->getSarehubEvents();
        $this->coreSession->unsSarehubEvents();

        if ($events === null) {
            $events = [];
        }

        $result = $this->resultJsonFactory->create();

        return $result->setData(json_encode($events));
    }
}
