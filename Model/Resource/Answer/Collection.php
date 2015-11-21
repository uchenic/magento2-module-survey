<?php 
namespace Magento\Survey\Model\Resource\Answer;
use \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magento\Survey\Model\Answer', 'Magento\Survey\Model\Resource\Answer');
    }

}
