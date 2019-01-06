<?php 
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\AdditionalPayment\Block\Adminhtml\Sales\Order\Invoice;

use Magento\OfflinePayments\Model\Purchaseorder;
use Magento\Customer\Model\Context;
use Magento\Sales\Model\Order\Address;
use Magento\Framework\View\Element\Template\Context as TemplateContext;
use Magento\Framework\Registry;
use Magento\Payment\Helper\Data as PaymentHelper;
use Magento\Sales\Model\Order\Address\Renderer as AddressRenderer;

Class PurchaseorderInfo extends \Magento\Framework\View\Element\Template
{
	/** @var \Magento\Sales\Model\ResourceModel\Order\Payment\Collection    */
protected $_paymentCollectionFactory;
 /** @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory */
protected $_orderCollectionFactory;
/** @var \Magento\Sales\Model\ResourceModel\Order\Collection */
protected $orders;

 protected $coreRegistry = null;

public function __construct(
        TemplateContext $context,
        Registry $registry,
        PaymentHelper $paymentHelper,
        AddressRenderer $addressRenderer,
        array $data = []
    ) {
        $this->addressRenderer = $addressRenderer;
        $this->paymentHelper = $paymentHelper;
        $this->coreRegistry = $registry;
        $this->_isScopePrivate = true;
        parent::__construct($context, $data);
    }

/**
     * Retrieve current order model instance
     *
     * @return \Magento\Sales\Model\Order
     */
    /**
     * Retrieve current order model instance
     *
     * @return \Magento\Sales\Model\Order
     */
    public function getOrder()
    {
        return $this->coreRegistry->registry('current_order');
    }

}
?>