<?php

/**
 * Mage SMS - SMS notification & SMS marketing
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the BSD 3-Clause License
 * It is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/BSD-3-Clause
 *
 * @category    TOPefekt
 * @package     TOPefekt_Magesms
 * @copyright   Copyright (c) 2012-2015 TOPefekt s.r.o. (http://www.mage-sms.com)
 * @license     http://opensource.org/licenses/BSD-3-Clause
 */
class Topefekt_Magesms_Model_Smsprofile extends Mage_Core_Model_Abstract
{
    public $user;
    public $admins;
    public $credit;
    public $lang;
    public $currency = 'EUR';
    public $_error;
/*Burası api yi doğrulama yapan yer ben bunu balance yani kalan kontur durumundan kontrol ediyorum */
    public function _construct()
    {
        parent::_construct();
        $this->user = $this->loadUser();

        $this->country = Mage::getModel('magesms/country')->getCollection();
        $this->lang = Mage::helper('magesms')->detectLang();
        if ($this->user->user) {
           // $server_post_info = Mage::getModel('magesms/api')->serverPost('action=info&username=' . urlencode($this->user->user) . '&password=' . urlencode($this->user->passwd));
            $user_info_arr=array('username'=>$this->user->user,'pass'=>$this->user->passwd);
            $server_post_info = Mage::getModel('magesms/api')->serverPost($user_info_arr);
            if (!$server_post_info->status || $server_post_info->payload->Status->Code != 200) {

                $this->user = Mage::getModel('magesms/smsuser');
                $this->_error =  $server_post_info->payload->Status->Code  . "-" . $server_post_info->payload->Status->Description;
            } else {
                $this->credit = $server_post_info->payload->Balance->Main;
                $this->admins = Mage::getModel('magesms/admins');
            }
            foreach ($this->country as $i037b855bc01175f2c77d5c3e19eda9a0003feff4) {
                if ($this->user->getCountry0() == $i037b855bc01175f2c77d5c3e19eda9a0003feff4->getName()) {
                    $this->currency = $i037b855bc01175f2c77d5c3e19eda9a0003feff4->getCurrency();
                    break;
                }
            }
        }
    }

    public function loadUser()
    {
        $i77d22463fc16d92f418e384077adc971e57f8cd8 = Mage::getModel('magesms/smsuser')->getCollection()->setOrder('ID', 'DESC');
        $i77d22463fc16d92f418e384077adc971e57f8cd8->getSelect()->limit(1);
        foreach ($i77d22463fc16d92f418e384077adc971e57f8cd8 as $if63180c174f143cf7a7c15db835b3c86c46375ad) {
            return $if63180c174f143cf7a7c15db835b3c86c46375ad;
        }
        return Mage::getModel('magesms/smsuser');
    }
}