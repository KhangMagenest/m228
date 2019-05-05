<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Director extends \Magento\Backend\App\Action
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
        $resultPage->setActiveMenu('Magenest_Move::directors');
        $resultPage->addBreadcrumb(__('Directors'), __('Directors'));
        $resultPage->addBreadcrumb(__('Manage Directors'), __('Manage Directors'));
        $resultPage->getConfig()->getTitle()->prepend(__('Directors'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_Movie::directors');
    }
}