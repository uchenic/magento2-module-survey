<?php 
namespace Magento\Survey\Model\Resource\Question;
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
        $this->_init('Magento\Survey\Model\Question', 'Magento\Survey\Model\Resource\Question');
    }

}
