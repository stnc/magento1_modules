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
class ConversionBug_Sms_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_CONVERSIONBUG_SMS_ENABLE = 'conversionbug/general/enable';
    const XML_PATH_CONVERSIONBUG_SMS_API = 'conversionbug/general/api';
    const XML_PATH_CONVERSIONBUG_SMS_SENDER = 'conversionbug/general/sender';
    
    public function enable() {
        if(Mage::getStoreConfig(self::XML_PATH_CONVERSIONBUG_SMS_ENABLE, Mage::app()->getStore())==1)
        {
            return true;
        }
        return false;
    }
    
    public function getAPIKEY() {
        return Mage::getStoreConfig(self::XML_PATH_CONVERSIONBUG_SMS_API, Mage::app()->getStore());
    }
    
    public function getSender() {
        return Mage::getStoreConfig(self::XML_PATH_CONVERSIONBUG_SMS_SENDER, Mage::app()->getStore());
    }
}