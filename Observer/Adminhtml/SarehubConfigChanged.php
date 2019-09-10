<?php

namespace Fwc\SAREhub\Observer\Adminhtml;

use Exception;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Fwc\SAREhub\Helper\Config;
use Fwc\SAREhub\Model\WebPushNotificationsFileService;
use Fwc\SAREhub\Logger\Logger;

/**
 * Class SarehubConfigChanged
 */
class SarehubConfigChanged implements ObserverInterface
{
    const GROUPS_PARAM_NAME = 'groups';
    const FIELDS_PARAM_NAME = 'fields';
    const VALUE_PARAM_NAME  = 'value';

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var WebPushNotificationsFileService
     */
    private $webPushNotificationsFileService;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * SarehubConfigChanged constructor.
     *
     * @param RequestInterface                $request
     * @param Logger                          $logger
     * @param WebPushNotificationsFileService $webPushNotificationsFileService
     */
    public function __construct(
        RequestInterface $request,
        Logger $logger,
        WebPushNotificationsFileService $webPushNotificationsFileService
    ) {
        $this->request = $request;
        $this->logger  = $logger;
        $this->webPushNotificationsFileService = $webPushNotificationsFileService;
    }

    /**
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        try {
            $filesExistsInPub = $this->webPushNotificationsFileService->webPushFilesExistsInPub();
            if ($this->getTrackingCodeState()) {
                if ($filesExistsInPub) {
                    return;
                }
                $this->webPushNotificationsFileService->addWebPushFiles();
                return;
            }
            if ($filesExistsInPub && $this->webPushNotificationsFileService->compareWebPushFiles()) {
                $this->webPushNotificationsFileService->removeWebPushFiles();
            }
        } catch (Exception $e) {
            $this->logger->error(__METHOD__ . ': ' . $e->getMessage());
        }
    }

    /**
     * @return bool
     */
    private function getTrackingCodeState()
    {
        $configArr = explode('/', Config::SAREHUB_WEB_PUSH_SEND_HTTPS);
        $groupName = $configArr[1];
        $fieldName = $configArr[2];
        $groups    = $this->request->getParam(self::GROUPS_PARAM_NAME);

        return (bool) (key_exists($fieldName,$groups[$groupName][self::FIELDS_PARAM_NAME]))
            ? $groups[$groupName][self::FIELDS_PARAM_NAME][$fieldName][self::VALUE_PARAM_NAME]: false ;
    }
}
