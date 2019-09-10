<?php

namespace Fwc\SAREhub\Helper;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Product
 */
class Product extends AbstractHelper
{
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var Category
     */
    protected $categoryHelper;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * Product constructor.
     *
     * @param Context                    $context
     * @param StoreManagerInterface      $storeManager
     * @param ProductRepositoryInterface $productRepository
     * @param Category                   $categoryHelper
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        ProductRepositoryInterface $productRepository,
        Category $categoryHelper
    ) {
        $this->storeManager      = $storeManager;
        $this->categoryHelper    = $categoryHelper;
        $this->productRepository = $productRepository;

        parent::__construct($context);
    }

    /**
     * @param $productSku
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function populateProductData($productSku){

        $product = $this->productRepository->get($productSku);

        $data = [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'price' => $product->getFinalPrice(),
            'currency' => $this->storeManager->getStore()->getCurrentCurrency()->getCode(),
            'url' => $this->storeManager->getStore()->getCurrentUrl(false),
            'category' => $this->categoryHelper->resolveCategoryNames($product->getCategoryIds())
        ];

        return $data;
    }
}
