<?php
namespace Hgati\CountDownTimer\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ProductFactory;

class Timer extends Template
{
    protected $productFactory;

    public function __construct(
        Template\Context $context,
        ProductFactory $productFactory,
        array $data = []
    ) {
        $this->productFactory = $productFactory;
        parent::__construct($context, $data);
    }

    public function getCountdownTime()
    {
        $product = $this->productFactory->create()->load($this->_request->getParam('id'));
        $releaseDate = $product->getData('amasty_preorder_release_date');
        if ($releaseDate) {
            $releaseDateTimestamp = strtotime($releaseDate);
            $releaseDateTimestamp = strtotime(date('Y-m-d 23:59:59', $releaseDateTimestamp));
            $releaseDate = date('Y-m-d H:i:s', $releaseDateTimestamp);
            return $releaseDate;
        } else {
            return null; // Release date not set
        }
    }
}
