<?php
namespace Elatebrain\Core\Block\Adminhtml\System\Config;
/**
 *
 */
class Documentation extends \Magento\Config\Block\System\Config\Form\Fieldset
{
    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return '<iframe id="elatebrain_store" width="100%" src="http://www.elatebrain.com/store.html?id=' . uniqid() .'" ></iframe>';
    }
}