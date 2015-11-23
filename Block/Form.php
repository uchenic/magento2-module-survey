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
        \Magento\Survey\Model\Resource\Question\CollectionFactory $questionCollectionFactory,
        \Magento\Survey\Model\Resource\Answer\CollectionFactory $answerCollectionFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_coreRegistry = $registry;
        $this->_questionCollectionFactory = $questionCollectionFactory;
        $this->_answerCollectionFactory = $answerCollectionFactory;
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
            $this->setData('survey',$this->_coreRegistry->registry('current_survey'));
        }
        
        
        return $this->getData('survey');
    }
    
    public function getQuestions($survey_id)
    {
        // Check if posts has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'posts' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('questions')) {
            $questions = $this->_questionCollectionFactory
                ->create()
                ->addFieldToFilter('survey_id', array('eq' => $survey_id));
                
            $this->setData('questions', $questions);
        }
        return $this->getData('questions');
    }

    public function getQuestionAnswers($question_id)
    {
         if (!$this->hasData('answers'.$question_id)) {
            $answers = $this->_answerCollectionFactory
                ->create()
                ->addFieldToFilter('question_id', array('eq' => $question_id));
                
            $this->setData('answers'.$question_id, $answers);
        }
        return $this->getData('answers'.$question_id);
    }

    public function getUser()
    {
        // Check if posts has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'posts' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('user_hash')) {
            $this->setData('user_hash',$this->_coreRegistry->registry('current_survey_user'));
        }
        
        
        return $this->getData('user_hash');
    }
   

}
