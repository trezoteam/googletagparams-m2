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

class Category extends Base
{
    protected $_registry;

    public function __construct(
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->createParams();
    }

    /**
     * Create param
     */
    public function createParams()
    {
        $params = new GoogleTagParams();
        $params->ecomm_pagetype = 'category';
        $this->setParams($params);
    }
}
