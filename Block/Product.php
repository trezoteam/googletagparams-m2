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

class Product extends Base
{
    protected $_registry;

    public function __construct(
        Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_registry = $registry;
        $this->createParams();
    }

    protected function getProduct()
    {
        return $this->_registry->registry('current_product');
    }

    /**
     * Create param
     */
    public function createParams()
    {
        $product = $this->getProduct();

        if ($product) {
            $params = new GoogleTagParams();
            $params->ecomm_pagetype = 'product';
            $params->ecomm_prodid = $product->getSku();
            $params->ecomm_totalvalue = number_format($product->getFinalPrice(), 2);
            $this->setParams($params);
        }
    }
}
