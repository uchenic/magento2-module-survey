<?php 
namespace Magento\Survey\Model\Resource;
use \Magento\Framework\Model\Resource\Db\AbstractDb;

class Survey extends AbstractDb
{

	

    /**
     * Construct
     *
     * @param \Magento\Framework\Model\Resource\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param string|null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\Resource\Db\Context $context,
        
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('survey_entity', 'entity_id');
    }

    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        if (is_numeric($value) && is_null($field)) {
            $field = 'entity_id';
        }

        return parent::load($object, $value, $field);
    }

    
}
