<?php
namespace Magento\AdditionalPayment\Observer;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class SaveOrderObserver implements ObserverInterface {
    protected $_inputParamsResolver;
    protected $_quoteRepository;
    protected $logger;
    protected $_state;
    public function __construct(\Magento\Webapi\Controller\Rest\InputParamsResolver $inputParamsResolver, \Magento\Quote\Model\QuoteRepository $quoteRepository, \Psr\Log\LoggerInterface $logger,\Magento\Framework\App\State $state) {
        $this->_inputParamsResolver = $inputParamsResolver;
        $this->_quoteRepository = $quoteRepository;
        $this->logger = $logger;
        $this->_state = $state;
    }
    public function execute(EventObserver $observer) {

        
        if($this->_state->getAreaCode() != \Magento\Framework\App\Area::AREA_ADMINHTML){
            
            $inputParams = $this->_inputParamsResolver->resolve();
            foreach ($inputParams as $inputParam) {
            if ($inputParam instanceof \Magento\Quote\Model\Quote\Payment) {
                $paymentData = $inputParam->getData('additional_data');
                $paymentOrder = $observer->getEvent()->getPayment();
                $order = $paymentOrder->getOrder();
                $quote = $this->_quoteRepository->get($order->getQuoteId());
                $paymentQuote = $quote->getPayment();
                $method = $paymentQuote->getMethodInstance()->getCode();
                //if ($method == Banktransfer::PAYMENT_METHOD_BANKTRANSFER_CODE) {
                    if(isset($paymentData['custom_payment'])){
                    $paymentQuote->setData('custom_payment', $paymentData['custom_payment']);
                    $paymentOrder->setData('custom_payment', $paymentData['custom_payment']);
                    $quote->setData('custom_payment', $paymentData['custom_payment']);
                    $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
                    $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
                    $connection = $resource->getConnection();
                     $tableName = $resource->getTableName('sales_order'); //gives table name with prefix
                     $sql = "update ".$tableName." set custom_payment = ".$paymentData['custom_payment'].", total_paid = ".$paymentData['custom_payment'].", base_total_paid = ".$paymentData['custom_payment']." where quote_id =".$order->getQuoteId(); 
        
                        $connection->query($sql);
                    //}
                }
            }
        }
       }

       return $this;
    }
}