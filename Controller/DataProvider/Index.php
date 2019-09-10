<?php

namespace Fwc\SAREhub\Controller\DataProvider;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Fwc\SAREhub\Model\SareConfigProvider;

/**
 * Class Index
 */
class Index extends Action
{
    /**
     * @var SareConfigProvider
     */
    private $sareConfigProvider;

    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;

    /**
     * Index constructor.
     *
     * @param Context            $context
     * @param JsonFactory        $resultJsonFactory
     * @param SareConfigProvider $sareConfigProvider
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        SareConfigProvider $sareConfigProvider
    ) {
        parent::__construct($context);
        $this->sareConfigProvider = $sareConfigProvider;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        if ($this->getRequest()->isAjax()) {
            return $result->setData($this->sareConfigProvider->getConfig());
        }

        return $result->setData(['error' => 'wrong request']);
    }
}
