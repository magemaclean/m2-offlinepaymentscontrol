<?php
namespace MageMaclean\OfflinePaymentsControl\Plugin\Payment\Method;

use MageMaclean\OfflinePaymentsControl\Helper\Data as Helper;

class AbstractMethod {
    protected $_helper;

    public function __construct(
        Helper $helper
    ) {
        $this->_helper = $helper;
    }

    protected function getStoreId() {
        return null;
    }

    public function afterCanUseInternal($subject, $result)
    {
        return $this->_helper->getMethodsDisabled('adminhtml', $subject->getCode(), $this->getStoreId());
    }

    public function afterCanUseCheckout($subject, $result)
    {
        return $this->_helper->getMethodsDisabled('checkout', $subject->getCode(), $this->getStoreId());
    }

    public function afterCanAuthorize($subject, $result)
    {
        return $this->_helper->getInvoiceOption('can_authorize', $subject->getCode(), $this->getStoreId());
    }

    public function afterCanCapture($subject, $result)
    {
        return $this->_helper->getInvoiceOption('can_capture', $subject->getCode(), $this->getStoreId());
    }

    public function afterCanCapturePartial($subject, $result)
    {
        return $this->_helper->getInvoiceOption('can_capture_partial', $subject->getCode(), $this->getStoreId());
    }

    public function afterCanRefund($subject, $result)
    {
        return $this->_helper->getInvoiceOption('can_refund', $subject->getCode(), $this->getStoreId());
    }

    public function canRefundPartialPerInvoice($subject, $result)
    {
        return $this->_helper->getInvoiceOption('can_refund_partial', $subject->getCode(), $this->getStoreId());
    }

    public function afterCanVoid($subject, $result)
    {
        return $this->_helper->getInvoiceOption('can_void', $subject->getCode(), $this->getStoreId());
    }
}