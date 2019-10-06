<?php

namespace Project1\Test1\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;

use Magento\Framework\View\Element\Template;

class Manufacturer extends Template
{
    protected $productCollectionFactory;
    protected $coreRegistry = null;
    protected $productRepository;
    protected $manufacturerCollectionFactory;

    public function __construct(
        Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Project1\Test1\Model\ResourceModel\Manufacturer\CollectionFactory $manufacturerCollectionFactory,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->coreRegistry = $registry;
        $this->manufacturerCollectionFactory=$manufacturerCollectionFactory;
        $this->productRepository = $productRepository;
        parent::__construct($context);
    }


//    public function getProduct()
//    {
//        $objectManager =\Magento\Framework\App\ObjectManager::getInstance();
//        $productId = $this->coreRegistry->registry('product')->getId();
//        $product = $this->productRepository->getById($productId)->getData();
//        $manufacturerId = $product['manufacturer_id'];
//        $manufacturer = $objectManager->get('Project1\Test1\Model\Manufacturer')->load($manufacturerId)->getData();
//        return $manufacturer;
//    }

}