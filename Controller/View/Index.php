<?php
namespace Magento\Survey\Controller\View;

use \Magento\Framework\App\Action\Action;

class Index extends Action
{
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultForwardFactory;

    protected $resultPageFactory;

    protected $_survey;

    protected $_coreRegistry;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magento\Framework\Registry $coreRegistry,
                                \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
                                \Magento\Framework\View\Result\PageFactory $resultPageFactory,
                                \Magento\Survey\Model\Survey $survey
    )
    {
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->_survey = $survey;
        $this->_coreRegistry = $coreRegistry;
        //$this->_surveyFactory=$surveyFactory;
        parent::__construct($context);
    }

    /**
     * Blog Index, shows a list of recent blog posts.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        //$post_id = $this->getRequest()->getParam('post_id', $this->getRequest()->getParam('id', false));
        $user_id = $this->getRequest()->getParam('user_id',false);
        $survey_id = $this->getRequest()->getParam('survey_id',false);

        $resultPage = $this->resultPageFactory->create();
        // We can add our own custom page handles for layout easily.
        //$resultPage->addHandle('surevey_view_index');
        if ($survey_id!==false) {
            $this->_survey->load($survey_id);
        } else {
           $this->_survey->load(1);
        }
        
        


        //$shippingInfoModel = $this->_shippingInfoFactory->create()->loadByHash($this->getRequest()->getParam('hash'));
        $this->_coreRegistry->register('current_survey', $this->_survey);
        $this->_coreRegistry->register('current_survey_user', $user_id);
        
        //echo $this->_survey->getName();
        // This will generate a layout handle like: blog_post_view_id_1
        // giving us a unique handle to target specific blog posts if we wish to.
        //$this->_survey->getId()
        $resultPage->addPageLayoutHandles(['id' => $survey_id]);

        // /** @var \Ashsmith\Blog\Helper\Post $post_helper */
        // //$post_helper = $this->_objectManager->get('Ashsmith\Blog\Helper\Post');
        $result_page = $resultPage;//$post_helper->prepareResultPost($this, $post_id);
        if (!$result_page) {
            $resultForward = $this->resultForwardFactory->create();
            return $resultForward->forward('noroute');
        }
        return $result_page;
    }
}
