<?php
namespace Magenes\Cybergame\Model\Room;
use Magenes\Cybergame\Model\ResourceModel\Room\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
class DataProvider extends AbstractDataProvider
{

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $roomCollectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $roomCollectionFactory->create();
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