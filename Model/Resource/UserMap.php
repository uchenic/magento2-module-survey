<?php 
namespace Magento\Survey\Model\Resource;
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class UserMap extends AbstractDb
{

	
    /**
     * Construct
     *
     * @param \Magento\Framework\Model\Resource\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param string|null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
       
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
        $this->_init('survey_user_map', 'customer_id');
    }

    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        if (is_numeric($value) && is_null($field)) {
            $field = 'customer_id';
        }

        return parent::load($object, $value, $field);
    }
}
