<?php
namespace MageMaclean\OfflinePaymentsControl\Plugin\Payment;

use MageMaclean\OfflinePaymentsControl\Helper\Data as Helper;

class Method {
    protected $_helper;

    public function __construct(
        Helper $helper
    ) {
        $this->_helper = $helper;
    }

    public function afterCanUseInternal($subject, $result)
    {
        return $this->_helper->getCanUseMethod('adminhtml', $subject->getCode(), $subject->getStore());
    }

    public function afterCanUseCheckout($subject, $result)
    {
        return $this->_helper->getCanUseMethod('checkout', $subject->getCode(), $subject->getStore());
    }

    public function afterCanAuthorize($subject, $result)
    {
        return $this->_helper->getInvoiceOption('can_authorize', $subject->getCode(), $subject->getStore());
    }

    public function afterCanCapture($subject, $result)
    {
        return $this->_helper->getInvoiceOption('can_capture', $subject->getCode(), $subject->getStore());
    }

    public function afterCanCapturePartial($subject, $result)
    {
        return $this->_helper->getInvoiceOption('can_capture_partial', $subject->getCode(), $subject->getStore());
    }

    public function afterCanRefund($subject, $result)
    {
        return $this->_helper->getInvoiceOption('can_refund', $subject->getCode(), $subject->getStore());
    }

    public function canRefundPartialPerInvoice($subject, $result)
    {
        return $this->_helper->getInvoiceOption('can_refund_partial', $subject->getCode(), $subject->getStore());
    }

    public function afterCanVoid($subject, $result)
    {
        return $this->_helper->getInvoiceOption('can_void', $subject->getCode(), $subject->getStore());
    }
}