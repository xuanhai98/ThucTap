<?php
namespace Magenest3\XuanHai\Observer;

use Magento\Catalog\Model\Product;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Serialize\Serializer\Json;

class Addtocart implements ObserverInterface
{

    protected $serializer;
    protected $_request;

    public function __construct(RequestInterface $request, Json $serializer)
    {
        $this->_request = $request;
        $this->serializer = $serializer;
    }

    public function execute(Observer $observer)
    {

        $request = $this->_request->getParams();
        $product = $observer->getProduct();
        $additionalOptions = array();

        if (isset($request['hotel_name']) && $request['hotel_name'] != 0) {
            $additionalOptions[] = array(
                'label' => "Hotel: ",
                'value' => $request['hotel_name']
            );
        }
        $product->addCustomOption('additional_options', $this->serializer->serialize($additionalOptions));

    }

}
