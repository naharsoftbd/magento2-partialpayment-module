<?php

/**
 * Jafar
 * Copyright (C) 2018 Mageprince
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html
 *
 * @category AdditionalPayment
 * @package Prince_Extrafee
 * @copyright Copyright (c) 2018 AdditionalPayment
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author AdditionalPayment
 */

namespace Magento\AdditionalPayment\Observer\Sales\Order;

use Magento\Framework\Event\ObserverInterface;

/**
 * Class AfterOrder
 * @package Prince\Extrafee\Observer
 */
class AfterOrder implements ObserverInterface
{

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectmanager
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectmanager)
    {
        $this->_objectManager = $objectmanager;
    }
    /**
     * Set payment fee to order
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getOrder();
        //$quote = $observer->getQuote();
        $quoteRepository = $this->_objectManager->create('Magento\Quote\Model\QuoteRepository');
        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $quoteRepository->get(intval($order->getQuoteId()));
        $customPayment = $quote->getCustomPayment();  

        /*$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('sales_order'); //gives table name with prefix
        $sql1 = "select * FROM quote WHERE entity_id=".$order->getQuoteId();
        $result1 = $connection->fetchAll($sql1);
        foreach ($result1 as $key => $value) {
           $sql = "update sales_order set delivery_comment = ".$value['custom_payment']." where quote_id =".$order->getQuoteId(); 
        }
        
        $connection->query($sql);
        $order->setData('custom_payment', $customPayment);*/
        $order->save();
        return $this;
    }
}
