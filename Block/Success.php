<?php
/**
 * Trezo Soluções Web
 *
 * NOTICE OF LICENSE
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to https://www.trezo.com.br for more information.
 *
 * @category Trezo
 * @package GoogleTagParams
 *
 * @copyright Copyright (c) 2017 Trezo Soluções Web. (https://www.trezo.com.br)
 *
 * @author Trezo Core Team <labs@trezo.com.br>
 * @author Carlos Gartner <carlos@trezo.com.br>
 */

namespace Trezo\GoogleTagParams\Block;

use Magento\Checkout\Model\Session as CartSession;
use Magento\Framework\View\Element\Template;
use Trezo\GoogleTagParams\Model\GoogleTagParams;

class Success extends Base
{
    /**
     * @var CartSession
     */
    protected $_cart;
    /**
     * @var \Magento\Sales\Model\Order
     */
    protected $_order;

    public function __construct(
        Template\Context $context,
        CartSession $cart,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_cart = $cart;
        $this->_order = $cart->getLastRealOrder();
        $this->createParams();
    }

    /**
     * Get all SKUs
     * @return array
     */
    public function getProductSkus()
    {
        $skus = [];
        $products = $this->_order->getItems();

        /** @var \Magento\Quote\Model\Quote\Item $product */
        foreach ($products as $product) {
            array_push($skus, $product->getSku());
        }

        return $skus;
    }

    /**
     * Get cart grand total
     * @return float
     */
    public function getCartTotal()
    {
        return number_format($this->_order->getGrandTotal(), 2);
    }

    /**
     * Verify if cart is created
     * @return bool
     */
    public function hasQuote()
    {
        return $this->_cart->hasQuote();
    }

    /**
     * Create params
     */
    public function createParams()
    {
        $products = $this->getProductSkus();

        $params = new GoogleTagParams();
        $params->ecomm_pagetype = 'purchase';
        $params->ecomm_prodid = $products;
        $params->ecomm_totalvalue = $this->getCartTotal();

        $this->setParams($params);
    }
}
