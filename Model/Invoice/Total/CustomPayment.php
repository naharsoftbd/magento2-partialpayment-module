<?php 

namespace Magento\AdditionalPayment\Model\Invoice\Total;

use Magento\Sales\Model\Order\Invoice;
use Magento\Sales\Model\Order\Invoice\Total\AbstractTotal;

/**
 * Class Fee
 * @package Prince\Extrafee\Model\Total
 */
class CustomPayment extends AbstractTotal
{
    /**
     * @param Invoice $invoice
     * @return $this
     */
    public function collect(Invoice $invoice)
    {
        $invoice->getCustomPayment(0);
        $amount = $invoice->getOrder()->getCustomPayment();
        $invoice->setCustomPayment($amount);
        $amount = $invoice->getOrder()->getCustomPayment();
        $invoice->setCustomPayment($amount);
        $invoice->setGrandTotal($invoice->getGrandTotal());
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal());

        return $this;
    }
}
?>