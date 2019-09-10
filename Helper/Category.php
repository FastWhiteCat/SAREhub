<?php

namespace Fwc\SAREhub\Helper;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Category
 */
class Category extends AbstractHelper
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Category constructor.
     *
     * @param Context           $context
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory
    )
    {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param array $ids
     *
     * @return array
     */
    public function resolveCategoryNames(array $ids){
        $categoryNames = [];
        try {
            $collection = $this->collectionFactory
                ->create()
                ->addAttributeToSelect('name')
                ->addAttributeToFilter('entity_id', ['in' => $ids]);

            foreach ($collection as $item) {
                $categoryNames[] = ['id' => $item->getData('name')];
            }
        } catch (LocalizedException $e){
            $categoryNames = [];
        }

        return $categoryNames;
    }
}
