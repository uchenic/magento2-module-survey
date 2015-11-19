<?php
namespace Magento\Survey\Block\Question;

//use Ashsmith\Blog\Api\Data\PostInterface;
//use Magento\Survey\Model\Resource\Question\Collection as QuestionCollection;

class Listing extends \Magento\Framework\View\Element\Template 
{
    protected $_template = 'list.phtml';
    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Ashsmith\Blog\Model\Resource\Post\CollectionFactory $postCollectionFactory,
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Survey\Model\Resource\Question\CollectionFactory $questionCollectionFactory,
        \Magento\Survey\Model\Resource\Answer\CollectionFactory $answerCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_questionCollectionFactory = $questionCollectionFactory;
        $this->_answerCollectionFactory = $answerCollectionFactory;
    }

    /**
     * @return \Ashsmith\Blog\Model\Resource\Post\Collection
     */
    public function getQuestions()
    {
        // Check if posts has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'posts' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('questions')) {
            $questions = $this->_questionCollectionFactory
                ->create()
                ->addFieldToFilter('survey_id', array('eq' => 1));
                
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

    

}
