<?php
namespace Hgati\CountDownTimer\Block;

use Magento\Catalog\Block\Product\View;
use Magento\Catalog\Helper\Data as CatalogHelper;
use Magento\Framework\View\Element\Template;

class Timer extends Template
{
    protected $_productView;
    protected $_catalogHelper;

    public function __construct(
        Template\Context $context,
        View $productView,
        CatalogHelper $catalogHelper,
        array $data = []
    ) {
        $this->_productView = $productView;
        $this->_catalogHelper = $catalogHelper;
        parent::__construct($context, $data);
    }

    public function getCurrentProduct()
    {
        return $this->_productView->getProduct();
    }

    public function getCountdownTime()
    {
        $product = $this->getCurrentProduct();
        $releaseDate = $product->getResource()->getAttribute('amasty_preorder_release_date')->getFrontend()->getValue($product);

        if ($releaseDate) {
            $releaseDateTime = new \DateTime($releaseDate);
            //$releaseDateTime->setTimezone(new \DateTimeZone('UTC'));
            $releaseDateTime->setTime(0, 0, 0); // 23:59:59로 설정
            return $releaseDateTime->format('Y-m-d H:i:s');
        } else {
            return null; // Release date not set
        }
    }
}
