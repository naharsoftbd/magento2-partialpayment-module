<?php

/**
 * MagePrince
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
 * @category MagePrince
 * @package Prince_Extrafee
 * @copyright Copyright (c) 2018 MagePrince
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince
 */

namespace Magento\AdditionalPayment\Model\Creditmemo\Total;

use Magento\Sales\Model\Order\Creditmemo;
use Magento\Sales\Model\Order\Creditmemo\Total\AbstractTotal;
use Magento\AdditionalPayment\Helper\Data as FeeHelper;

/**
 * Class Fee
 * @package Prince\Extrafee\Model\Creditmemo\Total
 */
class CustomPayment extends AbstractTotal
{
    /**
     * @var FeeHelper
     */
    protected $helper;

    /**
     * Fee constructor.
     *
     * @param FeeHelper $helper
     * @param array $data
     */
    public function __construct(FeeHelper $helper, array $data = [])
    {
        parent::__construct($data);
        $this->helper = $helper;
    }

    /**
     * @param Creditmemo $creditmemo
     * @return $this
     */
    public function collect(Creditmemo $creditmemo)
    {
        $creditmemo->setCustomPayment(0);
       
        if (!$this->helper->isRefund()) {
            return $this;
        }

        $amount = $creditmemo->getOrder()->getCustomPayment();
        $creditmemo->setCustomPayment($amount);
        $creditmemo->setGrandTotal($creditmemo->getGrandTotal());

        $baseAmount = $creditmemo->getOrder()->getCustomPayment();
        $creditmemo->setCustomPayment($baseAmount);
        $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal());

        return $this;
    }
}
