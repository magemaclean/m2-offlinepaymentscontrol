<?php
namespace MageMaclean\OfflinePaymentsControl\Model\Config\Source\Payment;

use MageMaclean\OfflinePaymentsControl\Helper\Data as Helper;

class Methods implements \Magento\Framework\Option\ArrayInterface
{
    protected $_helper;

    public function __construct(
        Helper $helper
    ) {
        $this->_helper = $helper;
    }

    public function toOptionArray()
    {
        return $this->_helper->getPaymentMethodOptions();
    }
}