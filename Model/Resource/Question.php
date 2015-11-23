<?php 
namespace Magento\Survey\Model\Resource;
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Question extends AbstractDb
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
        $this->_init('survey_question', 'id');
    }

    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        if (is_numeric($value) && is_null($field)) {
            $field = 'id';
        }

        return parent::load($object, $value, $field);
    }

    public function fetchQuestionAnswers($parentId)
    {
        $adapter = $this->_getReadAdapter();
        $select = $adapter->select()->from(
            ['tbl_selection' => $this->getMainTable()],
            ['product_id', 'parent_product_id', 'option_id']
        )->join(
            ['e' => $this->getTable('catalog_product_entity')],
            'e.entity_id = tbl_selection.product_id AND e.required_options=0',
            []
        )->join(
            ['tbl_option' => $this->getTable('catalog_product_bundle_option')],
            'tbl_option.option_id = tbl_selection.option_id',
            ['required']
        )->where(
            'tbl_selection.parent_product_id = :parent_id'
        );
        foreach ($adapter->fetchAll($select, ['parent_id' => $parentId]) as $row) {
            if ($row['required']) {
                $childrenIds[$row['option_id']][$row['product_id']] = $row['product_id'];
            } else {
                $notRequired[$row['option_id']][$row['product_id']] = $row['product_id'];
            }
        }
    }
}
