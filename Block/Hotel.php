<?php
namespace Magenest3\XuanHai\Block;

class Hotel extends \Magento\Catalog\Block\Product\View\Description {
    protected $__hotelCollection;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magenest3\XuanHai\Model\ResourceModel\Hotel\CollectionFactory $hotelCollection,
        array $data = [])
    {
        $this->_hotelCollection=$hotelCollection;
        parent::__construct($context, $registry, $data);
    }
    public function getHotel(){
        $hotels=$this->_hotelCollection->create();
        $data=[];
        foreach ($hotels as $hotel){
            $data[]=$hotel->getHotelName()
                ."-".$hotel->getLocationStreet()
                ."-".$hotel->getLocationCity()
                ."-".$hotel->getLocationCountry()
                ."-".$hotel->getContactPhone()
                ."-".$hotel->getAvailableSingle()
                ."-".$hotel->getAvailableDouble()
                ."-".$hotel->getAvailableTriple();
        }
        return $data;
    }
}
