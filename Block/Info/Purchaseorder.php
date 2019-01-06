<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\AdditionalPayment\Block\Info;

class Purchaseorder extends \Magento\Framework\View\Element\Template
{
    /**
     * @var string
     */
    protected $_template = 'Magento_AdditionalPayment::info/purchaseorder.phtml';

    /**
     * @return string
     */
    public function toPdf()
    {
        $this->setTemplate('Magento_AdditionalPayment::info/pdf/purchaseorder.phtml');
        return $this->toHtml();
    }
}
