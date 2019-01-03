<?php
/**
 * ExtensionInfo grid collection
 *
 */
namespace Elatebrain\Core\Model\ExtensionInfo\ResourceModel\Grid;


class Collection extends \Magento\Framework\Data\Collection
{
    /**
     * @var \Magento\Framework\Module\ModuleListInterface
     */
    protected $_fullModuleList;

    /**
     * @var \Magento\Framework\Module\ResourceInterface
     */
    protected $_resource;

    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $_moduleManager;

    /**
     * @var String
     */
    protected $_extensionProvider = "Elatebrain";

    /**
     * @var \Elatebrain\Core\Helper\ExtensionInfo
     */
    protected $_helperExtensionInfo;

    /**
     * @param \Magento\Framework\Data\Collection\EntityFactory $entityFactory
     * @param \Magento\Framework\Module\ModuleListInterface $fullModuleList
     * @param \Magento\Framework\Module\ResourceInterface $resource
     * @param \Magento\Framework\Module\Manager $resource
     */
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactory $entityFactory,
        \Magento\Framework\Module\ModuleListInterface $fullModuleList,
        \Magento\Framework\Module\Manager $moduleManager,
        \Magento\Framework\Module\ResourceInterface $resource,
        \Elatebrain\Core\Helper\ExtensionInfo $extensionInfo
    ) {
        $this->_resource = $resource;
        $this->_fullModuleList = $fullModuleList;
        $this->_moduleManager = $moduleManager;
        $this->_helperExtensionInfo = $extensionInfo;

        parent::__construct($entityFactory);
    }

    /**
     * Load data
     *
     * @param bool $printQuery
     * @param bool $logQuery
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function loadData($printQuery = false, $logQuery = false)
    {
        if (!$this->isLoaded()) {
            $latestExtensions = $this->_helperExtensionInfo->getExtensionArray();
            foreach ($this->_fullModuleList->getAll() as $type) {
                $varienObject = new \Magento\Framework\DataObject();
                $varienObject->setData($type);
                $varienObject->setData("installedversion",$this->_resource->getDbVersion($varienObject->getName()));

                if($this->_moduleManager->isEnabled($varienObject->getName())) {
                    $varienObject->setData("status", 1);
                }
                else {
                    $varienObject->setData("status", 0);
                }

                if(isset($latestExtensions[$varienObject->getName()]) && !empty($latestExtensions[$varienObject->getName()])){
                    $latestExtensionInfo = $latestExtensions[$varienObject->getName()];
                    if($latestExtensionInfo['version'] == $varienObject->getInstalledversion()) {
                        $varienObject->setData("version_status", 1);
                    }
                    else {
                        $varienObject->setData("version_status", 0);
                    }

                    $varienObject->setData("latestversion",$latestExtensionInfo['version']);
                }

                $extensionName = explode("_",$varienObject->getName());
                if(in_array($this->_extensionProvider, $extensionName)) {
                    $this->addItem($varienObject);
                }
            }
            $this->_setIsLoaded(true);
        }
        return $this;
    }
}