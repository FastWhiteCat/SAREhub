<?php

namespace Fwc\SAREhub\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Class Info
 */
class Info extends Field
{
    /**
     * Template path
     *
     * @var string
     */
    protected $_template = 'system/config/info.phtml';

    /**
     * Render fieldset html
     *
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $columns = $this->getRequest()->getParam('website') || $this->getRequest()->getParam('store') ? 5 : 4;
        return $this->_decorateRowHtml($element, "<td colspan='{$columns}'>" . $this->toHtml() . '</td>');
    }
}
