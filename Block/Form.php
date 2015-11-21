<?php
namespace Magento\Survey\Block;

class Form extends \Magento\Framework\View\Element\Template 
{
    // protected $_post;
     protected $_coreRegistry;
     protected $_template = 'view.phtml';
    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Ashsmith\Blog\Model\Post $post
     * @param \Ashsmith\Blog\Model\PostFactory $postFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        //\Magento\Suvey\Model\Survey $post,
        //\Magento\Suvey\Model\SurveyFactory $postFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_coreRegistry = $registry;
        
    }

    /**
     * @return \Ashsmith\Blog\Model\Post
     */
    public function getSurvey()
    {
        // Check if posts has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'posts' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('survey')) {
            $this->setData('survey',$this->_coreRegistry->register('current_survey'));
        }
        
        
        return $this->getData('survey');
    }
    }

   

}
