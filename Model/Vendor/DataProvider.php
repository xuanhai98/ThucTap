<?php
namespace Magenests\XuanHai\Model\Vendor;
use Magenests\XuanHai\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
class DataProvider extends AbstractDataProvider
{

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $vendorCollectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $vendorCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        $this->loadedData = array();
        foreach ($items as $template) {
            $this->loadedData[$template->getId()] = $template->getData();
        }
        return $this->loadedData;
    }
}