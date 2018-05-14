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

use Magento\Framework\View\Element\Template;
use Trezo\GoogleTagParams\Model\GoogleTagParams;

class Base extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'googletagparams.phtml';

    /**
     * @var GoogleTagParams
     */
    protected $_params;

    public function __construct(
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    /**
     * @param GoogleTagParams $param
     */
    public function setParams(GoogleTagParams $param)
    {
        $this->_params = $param;
    }

    /**
     * Render JS param
     */
    public function renderJs()
    {
        echo 'var google_tag_params = ' . json_encode($this->_params);
    }
}