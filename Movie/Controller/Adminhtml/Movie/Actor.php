<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Actor extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magenest_Move::actors');
        $resultPage->addBreadcrumb(__('Actors'), __('Actors'));
        $resultPage->addBreadcrumb(__('Manage Actors'), __('Manage Actors'));
        $resultPage->getConfig()->getTitle()->prepend(__('Actors'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_Movie::actors');
    }
}