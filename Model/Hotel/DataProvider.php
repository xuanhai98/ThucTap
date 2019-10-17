<?php
namespace Magenest3\XuanHai\Model\Hotel;
use Magenest3\XuanHai\Model\ResourceModel\Hotel\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
class DataProvider extends AbstractDataProvider
{

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $hotelCollectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $hotelCollectionFactory->create();
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