<?php
namespace Elatebrain\Core\Controller\Adminhtml\ExtensionInfo;

/**
 *
 */
class Index extends \Elatebrain\Core\Controller\Adminhtml\Index {

    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Elatebrain_Core::extensioninfo');
        $resultPage->getConfig()->getTitle()->prepend(__('Extension Info'));
        return $resultPage;
    }
}