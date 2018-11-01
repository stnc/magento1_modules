<?php
/**
 * ConversionBug
 * @category    SMS
 * @package     Conversionbug_SMS
 * @copyright   Copyright (c) 2017 Conversionbug (http://www.conversionbug.com/)
 * @author      shivam
 * @email       shivam.kumar@conversionbug.com
 * @version     Release: 1.0.0.0
 */
class ConversionBug_Sms_Model_Observer {

    const XML_DELHIVERY_TITLE = 'carriers/conversionbug_delhivery/title';
    const XML_DTDC_TITLE = 'carriers/conversionbug_dtdc/title';
    const XML_ECOMEXPRESS_TITLE = 'carriers/conversionbug_ecomexpress/title';
    const XML_FIRSTFLIGHT_TITLE = 'carriers/conversionbug_firstflight/title';
    const XML_PROFESSIONAL_TITLE = 'carriers/conversionbug_professional/title';
    const XML_HANDDELIVERED_TITLE = 'carriers/conversionbug_handdelivered/title';
    const XML_ARAMEX_TITLE = 'carriers/conversionbug_aramex/title';
    const XML_SPEEDPOST_TITLE = 'carriers/conversionbug_speedpost/title';
    const XML_DELHIVERY_URL = 'carriers/conversionbug_delhivery/url';
    const XML_DTDC_URL = 'carriers/conversionbug_dtdc/url';
    const XML_ECOMEXPRESS_URL = 'carriers/conversionbug_ecomexpress/url';
    const XML_FIRSTFLIGHT_URL = 'carriers/conversionbug_firstflight/url';
    const XML_PROFESSIONAL_URL = 'carriers/conversionbug_professional/url';
    const XML_HANDDELIVERED_URL = 'carriers/conversionbug_handdelivered/url';
    const XML_ARAMEX_URL = 'carriers/conversionbug_aramex/url';
    const XML_SPEEDPOST_URL = 'carriers/conversionbug_speedpost/url';

    public function orderSuccess(Varien_Event_Observer $observer) {
        $helper = Mage::helper('conversionbug');
        $smsEnable = $helper->enable();
        if ($smsEnable) {
            try {
                $sms = Mage::getModel('conversionbug/sendsms');
                $incrementId = $observer->getOrder()->getIncrementId();
                $phone = $observer->getOrder()->getShippingAddress()->getTelephone();
                $customerName = $observer->getOrder()->getCustomerName();
                $grandTotal = $observer->getOrder()->getGrandTotal();
                $message = "Dear $customerName. Your order reference no is $incrementId for Rs. $grandTotal. Your order will be shipped in 2 - 4 working days. Thank You";
               
                if (strlen($phone) >= 10)
                    $sms->send_sms($phone, $message, '', 'xml');
            } catch (Exception $e) {
                
            }
        }
    }

    public function getTrackingUrl($trackingTitle) {
        switch ($trackingTitle) {
            case Mage::getStoreConfig(self::XML_DELHIVERY_TITLE):
                $url = Mage::getStoreConfig(self::XML_DELHIVERY_URL);
                break;
            case Mage::getStoreConfig(self::XML_DTDC_TITLE):
                $url = Mage::getStoreConfig(self::XML_DTDC_URL);
                break;
            case Mage::getStoreConfig(self::XML_ECOMEXPRESS_TITLE):
                $url = Mage::getStoreConfig(self::XML_ECOMEXPRESS_URL);
                break;
            case Mage::getStoreConfig(self::XML_FIRSTFLIGHT_TITLE):
                $url = Mage::getStoreConfig(self::XML_FIRSTFLIGHT_URL);
                break;
            case Mage::getStoreConfig(self::XML_PROFESSIONAL_TITLE):
                $url = Mage::getStoreConfig(self::XML_PROFESSIONAL_URL);
                break;
            case Mage::getStoreConfig(self::XML_HANDDELIVERED_TITLE):
                $url = Mage::getStoreConfig(self::XML_HANDDELIVERED_URL);
                break;
            case Mage::getStoreConfig(self::XML_ARAMEX_TITLE):
                $url = Mage::getStoreConfig(self::XML_ARAMEX_URL);
                break;
            case Mage::getStoreConfig(self::XML_SPEEDPOST_TITLE):
                $url = Mage::getStoreConfig(self::XML_SPEEDPOST_URL);
                break;
        }
        return $url;
    }

    public function shippedSuccess($observer) {
        if ($observer->getEvent()->getControllerAction()->getFullActionName() == 'adminhtml_sales_order_shipment_save') {
            $helper = Mage::helper('conversionbug');
            $smsEnable = $helper->enable();
            if ($smsEnable) {
                try {
                    $sms = Mage::getModel('conversionbug/sendsms');
                    $orderId = Mage::app()->getRequest()->getParam('order_id');
                    $order = Mage::getModel('sales/order')->load($orderId);
                    $incrementId = $order->getIncrementId();
                    $shipmentCollection = Mage::getResourceModel('sales/order_shipment_collection')
                            ->setOrderFilter($order)
                            ->load();

                    foreach ($shipmentCollection as $shipment) {
                        foreach ($shipment->getAllTracks() as $tracknum) {
                            $trackingNo = $tracknum->getNumber();
                            $trackingTitle = $tracknum->getTitle();
                            //$trackingUrl = $this->getTrackingUrl($trackingTitle);
                        }
                    }

                    $phone = $order->getShippingAddress()->getTelephone();
                    $message = "Dear Customer, Your order no. $incrementId has been shipped";

                    if ($trackingTitle)
                        $message.= " through $trackingTitle Couriers";

                    if ($trackingNo)
                        $message.=" with tracking No $trackingNo.";

                    /* if($trackingUrl)
                      $message.="Track at - $trackingUrl"; */


                    if (strlen($phone) >= 10)
                        $sms->send_sms($phone, $message, '', 'xml');
                } catch (Exception $e) {
                    
                }
            }
        }
    }

}
