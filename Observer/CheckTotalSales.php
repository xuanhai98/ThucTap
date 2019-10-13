<?php
namespace Magenests\XuanHai\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class CheckTotalSales implements ObserverInterface
{
    protected $_orderCollectionFactory;

    protected $_vendorCollectionFactory;

    public function __construct(
        \Magenests\XuanHai\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
    ){
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_vendorCollectionFactory = $vendorCollectionFactory;
    }

    public function execute(EventObserver $observer)
    {
        $listOrderStatus = $this->_orderCollectionFactory->create();
        $vendors = $this->_vendorCollectionFactory->create();
        foreach ($listOrderStatus as $status){
            if ($status->getStatus() == 'pending'){
                foreach ($vendors as $vendor) {
                    if ($vendor->getCustomerId() == $status->getCustomerId()) {
                        $vendorTotalSales = $vendor->getTotalSales() + $status->getTotalQtyOrdered();
                        $vendor->setTotalSales($vendorTotalSales);
                        $vendor->save();
                        $vendor->getTotalSales();
                    }
                }
            }
        }
    }
}
