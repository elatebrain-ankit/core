<?php
namespace Elatebrain\Core\Block\Adminhtml\ExtensionInfo\Grid\Column;

/**
 *
 */
class Statuses extends \Magento\Backend\Block\Widget\Grid\Column
{
    /**
     * @return array
     */
    public function getFrameCallback()
    {
        return [$this, 'decorateStatus'];
    }

    /**
     * @param $value
     * @param $row
     * @param $column
     * @param $isExport
     * @return string
     */
    public function decorateStatus($value, $row, $column, $isExport)
    {
        if($column->getIndex() == "version_status"){
            if ($row->getVersionStatus()) {
                $cell = '<span class="grid-severity-notice"><span>' . $value . '</span></span>';
            } else {
                $cell = '<span class="grid-severity-critical"><span>' . $value . '</span></span>';
            }
        }
        else{
            if ($row->getStatus()) {
                $cell = '<span class="grid-severity-notice"><span>' . $value . '</span></span>';
            } else {
                $cell = '<span class="grid-severity-critical"><span>' . $value . '</span></span>';
            }
        }
        return $cell;
    }
}