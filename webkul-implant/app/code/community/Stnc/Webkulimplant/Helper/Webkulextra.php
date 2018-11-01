<?php

/**
 * Mageticaret Notification
 * @category    SMS / Notification
 * @package     stnc_webkulimplant
 * @copyright   Copyright (c) 2018 Mageticaret (http://www.mageticaret.com/)
 * @author      selmantunc.com
 * @email       selmantunc@gmail.com
 * @version     Release: 1.0.0.0
 */
class Stnc_Webkulimplant_Helper_Webkulextra extends Mage_Core_Helper_Abstract
{


    /* kullanım
    /*
     *        // $helper_webkul_implant =Mage::helper('stnc_webkulimplant/data');
        $helper_webkul_implant =Mage::helper('stnc_webkulimplant/Webkulextra');
        $onEk= $helper_webkul_implant->SaticiAdiNedir();
        $onEk=$helper_webkul_implant->EklenecekOnek($onEk)."-";
     *
     */
    /**/

    const Stnc_webkulProcudtListMagazaInfo = 'stnc_webkulimplant/stnc_webkulAlan1/stnc_webkulProcudtListMagazaInfo';
    const Stnc_webkulProcudtListMagazaInfoAnasayfa = 'stnc_webkulimplant/stnc_webkulAlan1/Stnc_webkulProcudtListMagazaInfoAnasayfa';

    /**
     * @uses app\code\local\Webkul\Marketplace\controllers\OrderController.php
     *
     */
    public function SaticiAdiNedir()
    {
        $partnerId = Mage::getSingleton('customer/session')->getCustomerId();
        //	die (print_r($partnerId));
        $storeId = Mage::app()->getStore()->getId();
        if ($partnerId == '')
            $partnerId = Mage::registry('current_customer')->getId();
        if ($partnerId != '') {
            $data = 0;
            $collection = Mage::getModel('marketplace/userprofile')->getCollection();
            $collection->addFieldToFilter('mageuserid', array('eq' => $partnerId));
            $collection->addFieldToFilter('store_id', array('eq' => $storeId));
            if (!count($collection)) {
                $collection = Mage::getModel('marketplace/userprofile')->getCollection();
                $collection->addFieldToFilter('mageuserid', array('eq' => $partnerId));
                $collection->addFieldToFilter('store_id', 0);
            }
            foreach ($collection as $record) {
                $data = $record->getShoptitle();
            }
            return $data;
        }
    }

    /**
     * @uses  frontend\sm_market\default\template\sm\shopby\catalog\product\list.phtml
     * */
    public function GetSaticiAdiNedir($getProductId)
    {
        // $orderid = Mage::app()->getRequest()->getParam('order_id');
        $users = Mage::getModel('marketplace/product')->getCollection()->addFieldToFilter('mageproductid', array('eq' => $getProductId));
        $sellerid = 0;
        foreach ($users as $value) {
            $sellerid = $value->getUserid();
            $sellername = Mage::getModel('customer/customer')->load($sellerid)->getName();
        }
        $shoptitle = '';
        $profileurl = '';
        $storeId = Mage::app()->getStore()->getId();
        $users = Mage::getModel('marketplace/userprofile')->getCollection()
            ->addFieldToFilter('mageuserid', array('eq' => $sellerid))
            ->addFieldToFilter('store_id', array('eq' => $storeId));
// if(!count($collection)){
//     $collection = Mage::getModel('marketplace/userprofile')->getCollection()
//     ->addFieldToFilter('mageuserid', $sellerid)
//     ->addFieldToFilter('store_id', 0);
// }
        foreach ($users as $value) {
            $shoptitle = $value->getShoptitle();
            $profileurl = $value->getProfileurl();
        }
        if ($shoptitle) {
            $sellername = $shoptitle;
        }

        return array(
            'SellerID' => $sellerid,
            'profile_url' => $profileurl,
            'sellername' => $sellername
        );
    }

    /**
     * @uses  design\frontend\base\default\template\marketplace\checkout\cart\item\default.phtml
     * @uses  design\frontend\sm_market\default\template\catalog\product\view.phtml
     * */
    public function GetSaticiKargoBedeli($getProductId)
    {
        // $orderid = Mage::app()->getRequest()->getParam('order_id');
        $users = Mage::getModel('marketplace/product')->getCollection()->addFieldToFilter('mageproductid', array('eq' => $getProductId));
        $sellerid = 0;
        foreach ($users as $value) {
            $sellerid = $value->getUserid();
            //   $sellername = Mage::getModel('customer/customer')->load($sellerid)->getName();
        }


        $CargoFiyatlar = Mage::getModel('mpshipping/mpshipping')->getCollection()
            ->addFieldToFilter('partner_id', array('eq' => $sellerid));

        foreach ($CargoFiyatlar as $col) {
            $CargoMethodName = '';
            if ($col->getShippingMethodId()) {
                $CargoMethodName = Mage::getModel('mpshipping/mpshippingmethod')->load($col->getShippingMethodId())->getMethodName();
            }
        }


        foreach ($CargoFiyatlar as $value) {
            $CargoFiyati = Mage::helper('core')->currency($value->getPrice(), true, false);
        }

        return array(
            'KargoAdi' => $CargoMethodName,
            'KargoFiyati' => $CargoFiyati
        );
    }

    /**
     * uses SaticiAdiNedir
     * @uses app\code\local\Webkul\Marketplace\controllers\OrderController.php
     * SaticiAdiNedir fonksiyonu ek olarak bunu çağırır
     * */

    public function EklenecekOnek($value)
    {
        $value = ucwords($value);
        $value = str_replace(" ", "", $value);
        return $value;
    }


    public function Stnc_webkulProcudtListMagazaInfo_AdminControl()
    {
        if (Mage::getStoreConfig(self::Stnc_webkulProcudtListMagazaInfo, Mage::app()->getStore()) == 1) {
            return true;
        }
        return false;
    }

    public function Stnc_webkulProcudtListMagazaInfoAnasayfa_AdminControl()
    {
        if (Mage::getStoreConfig(self::Stnc_webkulProcudtListMagazaInfoAnasayfa, Mage::app()->getStore()) == 1) {
            return true;
        }
        return false;
    }

    /**
     * @uses  frontend\sm_market\default\template\sm\shopby\catalog\product\list.phtml
     * @uses  frontend\base\default\template\sales\order\items\renderer\default.phtml
     *
     * */
    public function GetSaticiIDNedir($getProductId)
    {
        // $orderid = Mage::app()->getRequest()->getParam('order_id');
        $users = Mage::getModel('marketplace/product')->getCollection()->addFieldToFilter('mageproductid', array('eq' => $getProductId));
        $sellerid = 0;
        foreach ($users as $value) {
            $sellerid = $value->getUserid();
            $sellername = Mage::getModel('customer/customer')->load($sellerid)->getName();
        }
        return array(
            'SellerID' => $sellerid,
            'SellerName' => $sellername
        );
    }

    /**
     * @uses  frontend\sm_market\default\template\sm\shopby\catalog\product\list.phtml
     * @uses  frontend\base\default\template\sales\order\items\renderer\default.phtml
     *
     * */
    public function GetOrderInformationForMusteri($orderId, $sellerID)
    {
        $collection = Mage::getModel('marketplace/order')->getCollection();
        $collection->addFieldToFilter('order_id', array('eq' => $orderId));
        $collection->addFieldToFilter('seller_id', array('eq' => $sellerID));
        $CargoAdi = "";
        $trackingName = "";
        $CancelStatus = "";
        foreach ($collection as $value) {
            $CargoAdi = $value->getCarrierName();
            $trackingName = $value->getTrackingNumber();
            $CancelStatus = $value->getIsCanceled();
        }
        return array(
            'CargoAdi' => $CargoAdi,
            'trackingName' => $trackingName,
            'iptalDurumu' => $CancelStatus
        );
    }

    /**
     * @uses  frontend\sm_market\default\template\sm\shopby\catalog\product\list.phtml
     * @uses  frontend\base\default\template\sales\order\items\renderer\default.phtml
     *
     * */
    public function GetOrderInformationData($getProductId)
    {
        /// $products = Mage::getModel("marketplace/order")->getOrderinfo($orderId); //webkula bağlanır ama bize yaramaz
        $orderId = Mage::app()->getRequest()->getParam('order_id');
        $SaticiInfo = $this->GetSaticiAdiNedir($getProductId);

        $sellerID = $SaticiInfo ['SellerID'];
        $sellername = $SaticiInfo ['sellername'];
        $profile_url = $SaticiInfo ['profile_url'];

        $OrderInformation = $this->GetOrderInformationForMusteri($orderId, $sellerID);
        $CargoAdi = $OrderInformation['CargoAdi'];
        $CargoAdiAdet = strlen($this->EklenecekOnek($sellername));
        $CargoAdi = substr($CargoAdi, $CargoAdiAdet + 1, -1);
        $trackingName = $OrderInformation['trackingName'];

        return array(
            'SellerID' => $sellerID,
            'sellername' => $sellername,
            'profile_url' => $profile_url,
            'trackingName' => $trackingName,
            'CargoAdiKisa' => $CargoAdi,
            'CargoAdiUzun' => $OrderInformation['CargoAdi'],
            'iptalDurumu' => $OrderInformation['iptalDurumu']
        );
    }


}
