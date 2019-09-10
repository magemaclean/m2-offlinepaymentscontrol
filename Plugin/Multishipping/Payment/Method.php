<?php
namespace MageMaclean\OfflinePaymentsControl\Plugin\Multishipping\Payment;

use MageMaclean\OfflinePaymentsControl\Helper\Data as Helper;

class Method {
    protected $_helper;

    public function __construct(
        Helper $helper
    ) {
        $this->_helper = $helper;
    }

    public function aroundIsSatisfiedBy($subject, callable $proceed, ...$args)
    {
        if(!$this->_helper->getCanUseMethod('checkout', $args[0])) {
            return false;
        }

        return $proceed(...$args);
    }
}