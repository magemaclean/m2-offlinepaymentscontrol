<?php
namespace MageMaclean\OfflinePaymentsControl\Plugin\Payment\Method;

use MageMaclean\OfflinePaymentsControl\Helper\Data as Helper;
use Magento\OfflinePayments\Model\Cashondelivery as PaymentModel;

class Cashondelivery {
    protected $_helper;

    public function __construct(
        Helper $helper
    ) {
        $this->_helper = $helper;
    }

    public function afterCanUseInternal(PaymentModel $subject, $result)
    {
        #return $this->_canUseInternal;
        $methodsDisabled = $this->_helper->getMethodsDisabled('adminhtml');
        if(in_array($subject->getCode(), $methodsDisabled)) {
            return false;
        }

        return true;
    }

    public function afterCanUseCheckout(PaymentModel $subject, $result)
    {
        #return $this->_canUseCheckout;
        $methodsDisabled = $this->_helper->getMethodsDisabled('checkout');
        if(in_array($subject->getCode(), $methodsDisabled)) {
            return false;
        }
        return true;
    }
}