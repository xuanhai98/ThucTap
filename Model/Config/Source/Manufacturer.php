<?php


namespace Project1\Test1\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

class Manufacturer extends AbstractSource implements SourceInterface, OptionSourceInterface
{


    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
        $objectManager =\Magento\Framework\App\ObjectManager::getInstance();
        $manufacturerCollection = $objectManager->get('Project1\Test1\Model\Manufacturer')->getCollection();
        $manufacturerData = [];
        foreach ($manufacturerCollection as $manufacturer){
            $manufacturerData[$manufacturer->getId()] = $manufacturer->getName();
        }
        return $manufacturerData;
    }

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    /**
     * Retrieve option text by option value
     *
     * @param string $optionId
     * @return string
     */
    public function getOptionText($optionId)
    {
        $options = self::getOptionArray();

        return isset($options[$optionId]) ? $options[$optionId] : null;
    }


}
