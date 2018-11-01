<?php

/**
 * Mageticaret Notification
 * @category    SMS / Notification
 * @package     Stnc_Notification
 * @copyright   Copyright (c) 2018 Mageticaret (http://www.mageticaret.com/)
 * @author      selmantunc.com
 * @email       selmantunc@gmail.com
 * @version     Release: 1.0.0.0
 */
class Stnc_Notification_Helper_Data extends Mage_Core_Helper_Abstract
{
    const Mageticaret_Notification_SMS_ENABLE = 'stnc/stnc_MarketGroup/stnc_SmsAktif';
    const Mageticaret_Notification_SMS_USER = 'stnc/stnc_MarketGroup/stnc_AtakSmsUser';
    const Mageticaret_Notification_SMS_PASS = 'stnc/stnc_MarketGroup/stnc_AtakSmsPass';
    /* **  ONESİGNAL INFRMATİON***/
    const Mageticaret_Notification_ENABLE = 'stnc/stnc_MarketGroup2/stnc_NotifyAktif';
    const Mageticaret_Notification_AppID = 'stnc/stnc_MarketGroup2/stnc_NotifyAppID';
    const Mageticaret_Notification_APIKEY = 'stnc/stnc_MarketGroup2/stnc_NotifyRESTAPIKEY';

    public function SmSenable()
    {
        if (Mage::getStoreConfig(self::Mageticaret_Notification_SMS_ENABLE, Mage::app()->getStore()) == 1) {
            return true;
        }
        return false;
    }


    public function SmsUserName()
    {
        return Mage::getStoreConfig(self::Mageticaret_Notification_SMS_USER, Mage::app()->getStore());
    }

    public function SmsUserPass()
    {
        return Mage::getStoreConfig(self::Mageticaret_Notification_SMS_PASS, Mage::app()->getStore());
    }

    public function SmsMSG($orderID, $productUrl)
    {
        $mesa = Mage::getStoreConfig('stnc/stnc_MarketGroup/stnc_AtakSmsMsg', Mage::app()->getStore());;
        $mesa = str_replace("{{siparisNo}}", $orderID, $mesa);
        $mesa = str_replace("{{urunLinki}}", $productUrl, $mesa);
        return $mesa;
    }

    /* **  ONESİGNAL INFRMATİON***/

    public function NotifyEnable()
    {
        if (Mage::getStoreConfig(self::Mageticaret_Notification_ENABLE, Mage::app()->getStore()) == 1) {
            return true;
        }
        return false;
    }


    public function NotifyMSG($orderID, $productUrl)
    {
        $mesa = Mage::getStoreConfig('stnc/stnc_MarketGroup2/stnc_NotifyMsg', Mage::app()->getStore());;
        $mesa = str_replace("{{siparisNo}}", $orderID, $mesa);
        $mesa = str_replace("{{urunLinki}}", $productUrl, $mesa);
        return $mesa;
    }

    public function getAPIKEY()
    {
        return Mage::getStoreConfig(self::Mageticaret_Notification_APIKEY, Mage::app()->getStore());
    }

    public function getAppID()
    {
        return Mage::getStoreConfig(self::Mageticaret_Notification_AppID, Mage::app()->getStore());
    }



    public function turkcell_validator($str)
    {
        $regex = '/^(\+?12)?(9053\d{1}|7[1-9]\d{1})\d{7}$/';

        preg_match_all($regex, $str, $matches, PREG_SET_ORDER, 0);

        if (is_array($matches) && count($matches) > 0) {
            return "var";
        } else {
            return "yok";
        }
    }


    public function vodafone_validator($str)
    {
        $regex = '/^(\+?12)?(9054\d{1}|7[1-9]\d{1})\d{7}$/';

        preg_match_all($regex, $str, $matches, PREG_SET_ORDER, 0);

        if (is_array($matches) && count($matches) > 0) {
            return "var";
        } else {
            return "yok";
        }
    }

    public function avea_validator1($str)
    {
        $regex = '/^(\+?12)?(9050\d{1}|7[1-9]\d{1})\d{7}$/';
        preg_match_all($regex, $str, $matches, PREG_SET_ORDER, 0);
        if (is_array($matches) && count($matches) > 0) {
            return "var";
        } else {
            return "yok";
        }
    }

    public function avea_validator2($str)
    {
        //$regex = '/^(\+?12)?(09055\d{1}|7[1-9]\d{1})\d{7}$/m'; //multiline
        $regex = '/^(\+?12)?(9055\d{1}|7[1-9]\d{1})\d{7}$/';
        preg_match_all($regex, $str, $matches, PREG_SET_ORDER, 0);
        if (is_array($matches) && count($matches) > 0) {
            return "var";
        } else {
            return "yok";
        }
    }

    public function all_mobile_sms_validator($str)
    {

        $sonuc = array();
        $result = false;
        /*$sonuc[0]=avea_validator1("0905016159679");
        $sonuc[1]=vodafone_validator("0905486159679");
        $sonuc[2]=turkcell_validator("0905386159679");*/

        $sonuc[0] = $this->avea_validator1($str);
        $sonuc[1] = $this->vodafone_validator($str);
        $sonuc[2] = $this->turkcell_validator($str);
        $sonuc[3] = $this->avea_validator2($str);
        $sonuc[4] = ($str);

        if (in_array("var", $sonuc)) {
            $result = true;
        }

        return $result;
    }

}
