<?php 
namespace Magento\Survey\Model;



class Question extends \Magento\Framework\Model\AbstractModel 
{
    protected $_answerCollection;

	function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\Resource\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
      
        array $data = [])
    {
       
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $this->_init('Magento\Survey\Model\Resource\Question');
    }

   
}