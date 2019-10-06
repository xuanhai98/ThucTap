<?php
namespace Project1\Test1\Model\Manufacturer;
use Project1\Test1\Model\ResourceModel\Manufacturer\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
class DataProvider extends AbstractDataProvider
{

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $manufacturerCollectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $manufacturerCollectionFactory->create();
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