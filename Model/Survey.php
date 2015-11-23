<?php 
namespace Magento\Survey\Model;



class Survey extends \Magento\Framework\Model\AbstractModel 
{
    

	 function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

        protected function _construct()
    {
        $this->_init('Magento\Survey\Model\Resource\Survey');
    }
}