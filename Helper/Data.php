<?php
namespace MageMaclean\OfflinePaymentsControl\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

use Magento\OfflinePayments\Model\Banktransfer;
use Magento\OfflinePayments\Model\Cashondelivery;
use Magento\OfflinePayments\Model\Checkmo;
use Magento\OfflinePayments\Model\Purchaseorder;

class Data extends AbstractHelper
{
    protected $_banktransfer;
    protected $_cashondelivery;
    protected $_checkmo;
    protected $_purchaseorder;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        Banktransfer $banktransfer,
        Cashondelivery $cashondelivery,
        Checkmo $checkmo,
        Purchaseorder $purchaseorder
    ) {
        $this->_banktransfer = $banktransfer;
        $this->_cashondelivery = $cashondelivery;
        $this->_checkmo = $checkmo;
        $this->_purchaseorder = $purchaseorder;

        parent::__construct($context);
    }

    public function getCanUseMethod($area, $code, $storeId = null)
    {
        $value = $this->scopeConfig->getValue(
            'offlinepaymentscontrol/' . $area . '/methods_disabled',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );

        $values = explode(",", $value);
        return (in_array($code, $values)) ? false : true;
    }

    public function getInvoiceOption($field, $code, $storeId = null)
    {
        $value = $this->scopeConfig->getValue(
            'offlinepaymentscontrol/invoice/' . $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );

        $values = explode(",", $value);
        return (in_array($code, $values)) ? true : false;
    }

    public function getPaymentMethodOptions() {
        $arr = array(
            array(
                "label" => $this->_banktransfer->getTitle(),
                "value" => $this->_banktransfer->getCode()
            ),
            array(
                "label" => $this->_cashondelivery->getTitle(),
                "value" => $this->_cashondelivery->getCode()
            ),
            array(
                "label" => $this->_checkmo->getTitle(),
                "value" => $this->_checkmo->getCode()
            ),
            array(
                "label" => $this->_purchaseorder->getTitle(),
                "value" => $this->_purchaseorder->getCode()
            )
        );
        return $arr;
    }
}
