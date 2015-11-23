<?php 
namespace Magento\Survey\Model\Resource;
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Answer extends AbstractDb
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
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\Stdlib\DateTime $dateTime,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('survey_question_answer', 'id');
    }

    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        if (is_numeric($value) && is_null($field)) {
            $field = 'id';
        }

        return parent::load($object, $value, $field);
    }
}
