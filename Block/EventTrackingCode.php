<?php

namespace Fwc\SAREhub\Block;

use Magento\Customer\Model\Session;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use ReflectionClass;
use ReflectionException;
use Fwc\SAREhub\Helper\Category;
use Fwc\SAREhub\Helper\Config;
use Fwc\SAREhub\Model\Event\EventInterface;

/**
 * Class EventTrackingCode
 */
class EventTrackingCode extends Template
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var Category
     */
    protected $categoryHelper;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var array
     */
    protected $classMapping = [
        '_category'         => 'CategoryPage',
        '_product'          => 'ProductPage',
        '_loginpage'        => 'LoginPage',
        '_cartregistration' => 'CheckoutPage',
        '_cartpurchased'    => 'SuccessPage',
        '_cartpayment'      => 'DeliverySelection',
        '_cartconfirm'      => 'CartConfirm'
    ];

    /**
     * EventTrackingCode constructor.
     *
     * @param Context               $context
     * @param Registry              $registry
     * @param Session               $customerSession
     * @param Category              $categoryHelper
     * @param Config                $config
     * @param array                 $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        Session $customerSession,
        Category $categoryHelper,
        Config $config,
        array $data = []
    ){
        parent::__construct($context, $data);

        $this->registry        = $registry;
        $this->customerSession = $customerSession;
        $this->categoryHelper  = $categoryHelper;

        $this->config = $config;
    }

    /**
     * @inheritdoc
     */
    protected function _toHtml()
    {
        $codeProvider = $this->getCodeProvider();
        if(!$codeProvider->isAllowed()){
            return false;
        }
        $codeProvider->setParamsKey($this->getParam());
        return sprintf(
            '<script type="text/javascript">%s</script>',
            $codeProvider->getCode()
        );
    }

    /**
     * @return EventInterface
     * @throws ReflectionException
     */
    private function getCodeProvider(){
        $className = '\Fwc\SAREhub\Model\Event\\';
        $className .= isset($this->classMapping[$this->getEvent()]) ? $this->classMapping[$this->getEvent()] : 'Empty';

        $objectReflection = new ReflectionClass($className);
        /** @var EventInterface $instance */
        $instance = $objectReflection->newInstanceArgs(
            [
                $this->registry,
                $this->_storeManager,
                $this->customerSession,
                $this->categoryHelper,
                $this->config
            ]
        );

        return $instance;
    }
}
