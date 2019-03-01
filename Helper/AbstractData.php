<?php


namespace Elatebrain\Core\Helper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

/**
 *
 */
class AbstractData extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @param $path
     * @param null $scopeValue
     * @param string $scopeType
     * @return mixed
     */
    public function getConfig($path, $scopeValue = null, $scopeType = ScopeInterface::SCOPE_STORE)
    {
        return $this->scopeConfig->getValue($path, $scopeType, $scopeValue);
    }
}