<?php
namespace Elatebrain\Core\Controller\Adminhtml\ExtensionInfo;

class Index extends \Elatebrain\Core\Controller\Adminhtml\Index {

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Elatebrain_Core::extensioninfo');
        $resultPage->getConfig()->getTitle()->prepend(__('Extension Info'));
        return $resultPage;
    }
}