<?php
namespace Magenest\Movie\Controller\Adminhtml\Movie;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class NewMovie extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magenest_Movie::newmovie');
        $resultPage->addBreadcrumb(__('New Movie'), __('New Movie'));
        $resultPage->addBreadcrumb(__('Movies'), __('Movies'));
        $resultPage->getConfig()->getTitle()->prepend(__('New Movie'));
return $resultPage;
}
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_Movie::movie');
}
}