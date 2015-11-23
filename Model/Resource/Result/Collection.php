<?php 
namespace Magento\Survey\Model\Resource\Result;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magento\Survey\Model\Result', 'Magento\Survey\Model\Resource\Result');
    }

}
