<?php
namespace Hgati\CountDownTimer\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\Product;

class Timer extends Template
{
    protected $_product;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        array $data = []
    ) {
        $this->_product = $context->getProduct();
        parent::__construct($context, $data);
    }

    public function getCountdownTime()
    {
        $product = $this->_product;
        $releaseDate = $product->getData('amasty_preorder_release_date');
        
        if ($releaseDate) {
            return $releaseDate;
        } else {
            return null; // Release date not set
        }
    }
}
