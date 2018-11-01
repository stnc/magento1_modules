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
class Topefekt_Magesms_Model_Sms extends Varien_Object
{
    const SENT = 1;
    const ERROR = 2;
    const DELIVERED = 3;
    const UNAVAILABLE = 4;
    const SIMULATION = 5;
    const SCHEDULED = 6;
    const DELETED = 7;
    const DND = 8;
    const DUPLICATE = 9;
    const TYPE_ADMIN = 1;
    const TYPE_CUSTOMER = 2;
    const TYPE_MARKETING = 3;
    const TYPE_SIMPLE = 4;
    protected $_routes_type = array(self::TYPE_ADMIN => 'admin', self::TYPE_CUSTOMER => 'customer', self::TYPE_MARKETING => 'customer', self::TYPE_SIMPLE => 'customer');
    private $v3a95f9a85ae3fecc89b69aa9ea2d057ac2807b0b = true;

    public function _construct()
    {
        $this->setData(array('recipient' => new Varien_Data_Collection(), 'message' => '', 'subject' => '', 'unicode' => false, 'sendlater' => false, 'type' => self::TYPE_SIMPLE, 'priority' => true, 'unique' => false, 'admin_id' => 0, 'customer_id' => 0, 'recipient_name' => '', 'store_id' => null));
        parent::_construct();
    }

    public function send()
    {
        ini_set('max_execution_time', 1200);
        $smsProfile = Mage::getSingleton('magesms/smsprofile');

        try {
            $sendDUmpData = array();
            if (!strlen($this->getMessage())) {
                $sendDUmpData[] = Mage::helper('magesms')->__('Fill in SMS text.');
            }
            if (is_array($sendDUmpData) && sizeof($sendDUmpData)) Mage::throwException($sendDUmpData[0]);
            if ($this->getSendlater()) {
                $TimeStamp = Mage::getModel('core/date')->gmtTimestamp();
                if ($TimeStamp >= $this->getSendlater()) $sendDUmpData[] = Mage::helper('magesms')->__('Wrong time of SMS sending.');
            }
            if (is_array($sendDUmpData) && sizeof($sendDUmpData)) Mage::throwException($sendDUmpData[0]);
            if (!count($this->getRecipient())) $sendDUmpData[] = Mage::helper('magesms')->__('Recipients found: 0');
            if (is_array($sendDUmpData) && sizeof($sendDUmpData)) Mage::throwException($sendDUmpData[0]);
            $MEssage = html_entity_decode($this->getMessage(), ENT_QUOTES, 'UTF-8');
            $Unicode = Mage::helper('magesms')->countSms($MEssage, $this->getUnicode());
            if (!$smsProfile->user->simulatesms && count($this->getRecipient()) * $Unicode * 0.05 > $smsProfile->credit)
                $sendDUmpData[] = Mage::helper('magesms')->__('You do not have enough credit to send SMS to all ') . count($this->getRecipient()) . Mage::helper('magesms')->__(' recipients.');
            if (is_array($sendDUmpData) && sizeof($sendDUmpData)) Mage::throwException($sendDUmpData[0]);
            $ZlocalData = new Zend_Locale_Data();
            $phTer = $ZlocalData->getList('en-EN', 'phonetoterritory');
            $DMobile = array('number' => array(), 'isms' => array(), 'sendertype' => array(), 'senderID' => array(), 'dnd' => array(), 'admin_id' => array(), 'customer_id' => array(), 'recipient' => array(), 'data' => array());
            $a_plus_plus = 0;
            foreach ($this->getRecipient() as $recepti_row) {
                $Number = $recepti_row->getNumber();
                $Country = $recepti_row->getCountry() ? $recepti_row->getCountry() : '';
                $SendDumpData = '';
                if ($Country && $phTer[$Country] && !(strpos($Number, '+') === 0 || strpos($Number, '00') === 0)) {
                    if (strpos($Number, '0') === 0) $Number = substr($Number, 1);
                    $SendDumpData = $phTer[$Country];
                }
                $Number_send = Mage::helper('magesms')->prepareNumber($Number, $this->_routes_type[$this->getType()], $SendDumpData, $this->getStoreId());

                if (is_array($Number_send)) {
                    if ($this->getUnique()) {
                        if (in_array($Number_send['mobile'], $DMobile['number'])) continue;
                    }
                    $DMobile['number'][] = $Number_send['mobile'];
                    $DMobile['dnd'][] = $recepti_row->getDnd();
                    $DMobile['isms'][] = $Number_send['isms'];
                    $DMobile['sendertype'][] = 1; //$Number_send['sendertype']; ///bu kısımlar elle verildi
                    $DMobile['senderID'][] = 1;//$Number_send['senderID'];
                    $DMobile['admin_id'][] = 1;//$recepti_row->getAdminId();
                    $DMobile['customer_id'][] = $recepti_row->getCustomerId();
                    $DMobile['recipient'][] = $recepti_row->getRecipient();
                    if ($recepti_row->hasText()) {
                        $HasTExt = html_entity_decode($recepti_row->getText(), ENT_QUOTES, 'UTF-8');
                        $HasTExt = addslashes($HasTExt);
                        $HasTExt = str_replace("&amp;", "%26", $HasTExt);
                        $HasTExt = str_replace("&", "%26", $HasTExt);
                        $DMobile['data'][$a_plus_plus] = $HasTExt;
                    }
                }
                $a_plus_plus++;
            }
            // print_r($DMobile);
            // die;
            if ($smsProfile->user->simulatesms) {
                $a_plus_plus = 0;
                $a_resource_transaction = Mage::getModel('core/resource_transaction');
                foreach ($DMobile['number'] as $DMobile_number_KEY => $DMobile_number_ROW) {
                    $smshistorySave = Mage::getModel('magesms/smshistory');

                    $smshistorySave->setNumber('+' . $DMobile_number_ROW);
                    $smshistorySave->setDate(date('Y-m-d H:i:s'));
                    if (isset($DMobile['data'][$DMobile_number_KEY])) {
                        $smshistorySave->setText($DMobile['data'][$DMobile_number_KEY]);
                        $smshistorySave->setTotal(Mage::helper('magesms')->countSms($DMobile['data'][$DMobile_number_KEY], $this->getUnicode()));
                    } else {
                        $smshistorySave->setText($MEssage);
                        $smshistorySave->setTotal($Unicode);
                    }
                    $smshistorySave->setStatus(self::SIMULATION);
                    if (isset($DMobile['senderID'][$DMobile_number_KEY]))
                        $smshistorySave->setSender($DMobile['senderID'][$DMobile_number_KEY]);
                    $smshistorySave->setUnicode($this->getUnicode());
                    $smshistorySave->setType($this->getType());
                    $smshistorySave->setNote(Mage::helper('magesms')->__('SMS SIMULATION (Sending of SMS was simulated. Recipient will not receive SMS)'));
                    $smshistorySave->setSmsid('simulate' . md5(microtime()));
                    $smshistorySave->setSubject($this->getSubject());
                    $smshistorySave->setAdminId($DMobile['admin_id'][$DMobile_number_KEY]);
                    $smshistorySave->setCustomerId($DMobile['customer_id'][$DMobile_number_KEY]);
                    $smshistorySave->setRecipient($DMobile['recipient'][$DMobile_number_KEY]);
                    if ($a_plus_plus && !($a_plus_plus % 10)) {
                        $a_resource_transaction->save();
                        $a_resource_transaction = Mage::getModel('core/resource_transaction');
                    }
                    $a_resource_transaction->addObject($smshistorySave);
                    $a_plus_plus++;
                }
                $a_resource_transaction->save();
                if (count($DMobile['number']))
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('magesms')->__('SMS was sent (simulation).'));
                $this->v3a95f9a85ae3fecc89b69aa9ea2d057ac2807b0b = false;
            } else {
                /*  $user_send_info = 'username=' . urlencode($smsProfile->user->user) . '&password=' . urlencode($smsProfile->user->passwd) . '&unicode=' . ($this->getUnicode() ? 1 : 0);*/

                $user_send_info = array('username' => $smsProfile->user->user, 'pass' => $smsProfile->user->passwd);

                if ($this->getSendlater()) {
                    // $user_send_info .= '&datelater=' . urlencode($this->getSendlater());//eklenecek
                } /*  if ($this->getHookName()) {
                        // $user_send_info .= '&HN=' . $this->getHookName();//eklenecek
                    }
                if ($this->getPriority())
                    //$user_send_info .= '&action=sendsms&number=' . urlencode($DMobile['number'][0]) . '&isms=' . urlencode($DMobile['isms'][0]) . '&sender=' . urlencode($DMobile['senderID'][0]);
                    $number = urlencode($DMobile['number'][0]);
                    */
                else {
                    $DMobile_dnd_DUMD_data = array('number' => array(), 'isms' => array(), 'sendertype' => array(), 'senderID' => array(), 'dnd' => array(), 'admin_id' => array(), 'customer_id' => array(), 'recipient' => array(), 'data' => array());
                    foreach ($DMobile['number'] as $a_plus_plus => $DMobile_dnd_ROW) {
                        if ($DMobile_dnd_ROW) {
                            $DMobile_dnd_DUMD_data['number'][] = $DMobile['number'][$a_plus_plus];
                            unset($DMobile['number'][$a_plus_plus]);
                            $DMobile_dnd_DUMD_data['isms'][] = $DMobile['isms'][$a_plus_plus];
                            unset($DMobile['isms'][$a_plus_plus]);
                            $DMobile_dnd_DUMD_data['sendertype'][] = $DMobile['sendertype'][$a_plus_plus];
                            unset($DMobile['sendertype'][$a_plus_plus]);
                            $DMobile_dnd_DUMD_data['senderID'][] = $DMobile['senderID'][$a_plus_plus];
                            unset($DMobile['senderID'][$a_plus_plus]);
                            $DMobile_dnd_DUMD_data['dnd'][] = $DMobile['dnd'][$a_plus_plus];
                            unset($DMobile['dnd'][$a_plus_plus]);
                            $DMobile_dnd_DUMD_data['admin_id'][] = $DMobile['admin_id'][$a_plus_plus];
                            unset($DMobile['admin_id'][$a_plus_plus]);
                            $DMobile_dnd_DUMD_data['customer_id'][] = $DMobile['customer_id'][$a_plus_plus];
                            unset($DMobile['customer_id'][$a_plus_plus]);
                            $DMobile_dnd_DUMD_data['recipient'][] = $DMobile['recipient'][$a_plus_plus];
                            unset($DMobile['recipient'][$a_plus_plus]);
                            $DMobile_dnd_DUMD_data['data'][] = $DMobile['data'][$a_plus_plus];
                            unset($DMobile['data'][$a_plus_plus]);
                        }
                    }
                    //print_r($DMobile_dnd_DUMD_data);

                    $DMobile = array_map('array_values', $DMobile);
                    $a_plus_plusd6b9938d7ea332907fac9b3d13e5e137a990f938 = true;
                    $a_plus_plusd142d81574a8d8630ffd99db7dade811d2585120 = '';
                    foreach ($DMobile['data'] as $DMobile_data_ROW) {

                        if (!$a_plus_plusd142d81574a8d8630ffd99db7dade811d2585120) {
                            $a_plus_plusd142d81574a8d8630ffd99db7dade811d2585120 = $DMobile_data_ROW;
                            continue;
                        }
                        if ($a_plus_plusd142d81574a8d8630ffd99db7dade811d2585120 != $DMobile_data_ROW) {
                            $a_plus_plusd6b9938d7ea332907fac9b3d13e5e137a990f938 = false;
                            break;
                        }
                    }
                    /* $user_send_info .= '&action=sendsmsall' . (!$a_plus_plusd6b9938d7ea332907fac9b3d13e5e137a990f938 && $this->getType() == self::TYPE_MARKETING ? '2' : '') . '&number=' . implode(';', $DMobile['number']) . '&isms=' . implode(';', $DMobile['isms']) . '&sender=' . implode(';', $DMobile['senderID']);*///eklenecek
                }
                $number = implode(';', $DMobile_dnd_DUMD_data['number']);
                $message = '';
                if ($this->getType() == self::TYPE_MARKETING && !empty($DMobile['data']) && !$a_plus_plusd6b9938d7ea332907fac9b3d13e5e137a990f938) {
                    $a_plus_plus = 0;
                    foreach ($DMobile['data'] as $DMobile_number_ROW) {
                        // $user_send_info .= '&data' . $a_plus_plus . '=' . $DMobile_number_ROW;
                        // $message .= '&data' . $a_plus_plus . '=' . $DMobile_number_ROW;
                        $message .= $a_plus_plus;
                        $a_plus_plus++;
                    }
                } else {
                    $HasTExt = html_entity_decode($MEssage, ENT_QUOTES, 'UTF-8');
                    $HasTExt = addslashes($HasTExt);
                    $HasTExt = str_replace("&amp;", "%26", $HasTExt);
                    $HasTExt = str_replace("&", "%26", $HasTExt);
                    //  $user_send_info .= '&data=' . $HasTExt;//eklenebilir
                    $message .= $HasTExt;
                }

                //$Server_info = Mage::getModel('magesms/api')->serverPost($user_send_info, false);//sms gonderiyor eskisinde ama paramtreye gore
                $Server_info = Mage::getModel('magesms/api')->SmsSend($user_send_info, $number, $message);

              //  print_r($DMobile_dnd_DUMD_data);

                if (!empty($Server_info)) {

                    if ($Server_info['sonuc']['code'][0] == 200)
                        $apidenGelenDeger = $Server_info;

                    if (!empty($DMobile_dnd_DUMD_data['number'])) {
                        // print_r($DMobile_dnd_DUMD_data['data']);
                        //   die ("gire");
                        foreach ($DMobile_dnd_DUMD_data['number'] as $DMobile_number_KEY => $DMobile_number_ROW) {
                            $smshistorySave = Mage::getModel('magesms/smshistory');

                            $smshistorySave->setNumber('+' . $DMobile_dnd_DUMD_data['number'][$DMobile_number_KEY]);

                            $smshistorySave->setDate(date('Y-m-d H:i:s'));

                            if (isset($DMobile_dnd_DUMD_data['data'][$DMobile_number_KEY])) {
                                $smshistorySave->setText($DMobile_dnd_DUMD_data['data'][$DMobile_number_KEY]);
                                $smshistorySave->setTotal(Mage::helper('magesms')->countSms($DMobile_dnd_DUMD_data['data'][$DMobile_number_KEY], $this->getUnicode()));
                            }
                            $smshistorySave->setStatus(self::DND);

                            if (isset($DMobile_dnd_DUMD_data['senderID'][$DMobile_number_KEY]))
                                $smshistorySave->setSender($DMobile_dnd_DUMD_data['senderID'][$DMobile_number_KEY]);

                            if (isset($DMobile_dnd_DUMD_data['admin_id'][$DMobile_number_KEY]))
                                $smshistorySave->setAdminId($DMobile_dnd_DUMD_data['admin_id'][$DMobile_number_KEY]);
                            $smshistorySave->setUnicode($this->getUnicode());

                            if (isset($DMobile_dnd_DUMD_data['customer_id'][$DMobile_number_KEY]))
                                $smshistorySave->setCustomerId($DMobile_dnd_DUMD_data['customer_id'][$DMobile_number_KEY]);

                            if (isset($DMobile_dnd_DUMD_data['recipient'][$DMobile_number_KEY]))
                                $smshistorySave->setRecipient($DMobile_dnd_DUMD_data['recipient'][$DMobile_number_KEY]);


                            /*ekledim*/
                            $smshistorySave->setNumber('+' . $apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['MSISDN']);
                            $smshistorySave->setDate(date('Y-m-d H:i:s'));

                            if (isset($DMobile_dnd_DUMD_data['data'][$DMobile_number_KEY])) {
                                $smshistorySave->setText($DMobile_dnd_DUMD_data['data'][$DMobile_number_KEY]);
                                $smshistorySave->setTotal(Mage::helper('magesms')->countSms($DMobile_dnd_DUMD_data['data'][$DMobile_number_KEY], $this->getUnicode()));
                            } else {
                                $smshistorySave->setText($MEssage);
                                $smshistorySave->setTotal($Unicode);
                            }

                            $smshistorySave->setStatus(self::ERROR);

                            if (isset($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['Cost']))
                                $smshistorySave->setPrice($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['Cost']);

                            // if (isset($mageSMS_API['data'][2]))
                            // $smshistorySave->setCredit($mageSMS_API['data'][2]);//kredi için sorgulama yaz

                            if (isset($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['Id']))
                                $smshistorySave->setSmsid($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['Id']);

                            if (isset($DMobile['senderID'][$DMobile_number_KEY]))
                                $smshistorySave->setSender($DMobile_dnd_DUMD_data['senderID'][$DMobile_number_KEY]);

                            if (isset($DMobile['admin_id'][$DMobile_number_KEY]))
                                $smshistorySave->setAdminId($DMobile_dnd_DUMD_data['admin_id'][$DMobile_number_KEY]);
                            $smshistorySave->setUnicode($this->getUnicode());

                            if (isset($DMobile['customer_id'][$DMobile_number_KEY]))
                                $smshistorySave->setCustomerId($DMobile['customer_id'][$DMobile_number_KEY]);

                            if (isset($DMobile['recipient'][$DMobile_number_KEY]))
                                $smshistorySave->setRecipient($DMobile['recipient'][$DMobile_number_KEY]);


                            if ($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['Network'] == '1085') {
                                $smshistorySave->setNetwork('Avea');
                            } else if ($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['Network'] == '1086') {
                                $smshistorySave->setNetwork('Turkcell');
                            } else if ($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['Network'] == '1087') {
                                $smshistorySave->setNetwork('Vodafone');
                            }

                            $smshistorySave->setUnicode($this->getUnicode());
                            $smshistorySave->setType($this->getType());
                            $smshistorySave->setSubject($this->getSubject());
                            if ($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['State'] == 'Delivered') {
                                $smshistorySave->setStatus(self::SENT);
                            } elseif ($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['State'] == 'Scheduled') {
                                $smshistorySave->setStatus(self::SCHEDULED);
                                $smshistorySave->setNote(Mage::helper('magesms')->__('Zamanlanmış (gönderimi bekliyor)') . Mage::helper('core')->formatDate(date('Y-m-d H:i:s', $this->getSendlater()), 'medium', true));
                            } elseif ($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['State'] == 'Enroute') {
                                $smshistorySave->setNote(Mage::helper('magesms')->__('Gönderilmiş (SMSC den rapor daha alınamadı)'));
                            } elseif ($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['State'] == 'Expired') {
                                $smshistorySave->setNote(Mage::helper('magesms')->__('Zaman aşımına uğradı'));
                            } elseif ($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['State'] == 'Deleted') {
                                $smshistorySave->setNote(Mage::helper('magesms')->__('Silinmiş'));
                            } elseif ($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['State'] == 'Undeliverable') {
                                $smshistorySave->setNote(Mage::helper('magesms')->__('İletilmedi'));
                                $smshistorySave->setStatus(self::DND);
                            } elseif ($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['State'] == 'Accepted') {
                                $smshistorySave->setNote(Mage::helper('magesms')->__('SMSC tarafından alındı'));
                            } elseif ($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['State'] == 'Rejected') {
                                $smshistorySave->setNote(Mage::helper('magesms')->__('SMSC tarafından alındı'));
                            } elseif ($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['State'] == 'Skipped') {
                                $smshistorySave->setNote(Mage::helper('magesms')->__('Hatadan dolayı gönderilmeyecek'));
                            } elseif ($apidenGelenDeger['sorgu_return'][$DMobile_number_KEY]['State'] == 'Unknown') {
                                $smshistorySave->setNote(Mage::helper('magesms')->__('Bilinmeyen'));
                                // $smshistorySave->setStatus(self::DUPLICATE);
                            } elseif ($apidenGelenDeger['sonuc']['code'][$DMobile_number_KEY] != 200) {
                                $smshistorySave->setNote(Mage::helper('magesms')->__($apidenGelenDeger['sonuc']['desc'][0]));

                                if (isset($DMobile['customerID'][$DMobile_number_KEY])) $smshistorySave->setCustomerId($DMobile['customerID'][$DMobile_number_KEY]);
                                if (isset($DMobile['recipient'][$DMobile_number_KEY])) $smshistorySave->setRecipient($DMobile['recipient'][$DMobile_number_KEY]);
                            } else {
                                continue;
                            }
                            //  if ($a_plus_plus && !($a_plus_plus % 10)) {
                            // $a_resource_transaction->save();
                            //  $a_resource_transaction = Mage::getModel('core/resource_transaction');
                            //  }
                            // $a_resource_transaction->addObject($smshistorySave);
                            //   $a_plus_plus++;


                            $smshistorySave->setUnicode($this->getUnicode());
                            $smshistorySave->setType($this->getType());
                            $smshistorySave->setSubject($this->getSubject());
                            $smshistorySave->save();
                        }
                    }
                    $a_plus_plus = 0;
                    // $a_resource_transaction = Mage::getModel('core/resource_transaction');
                    //  $smshistorySave = Mage::getModel('magesms/smshistory');

                    /* foreach ($apidenGelenDeger['sorgu_return'] as $DMobile_number_KEY => $DMobile_number_ROW) {

                         $smshistorySave = Mage::getModel('magesms/smshistory');

                     }*/


                    //$a_resource_transaction->save();
                    $this->v3a95f9a85ae3fecc89b69aa9ea2d057ac2807b0b = false;
                    if ($smshistorySave->getStatus() == self::SENT)
                        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('magesms')->__('SMS was sent.'));
                    elseif ($smshistorySave->getStatus() == self::SCHEDULED)
                        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('magesms')->__('SMS was saved.'));
                    else {
                        Mage::getSingleton('adminhtml/session')->addError($smshistorySave->getNote());
                        $this->v3a95f9a85ae3fecc89b69aa9ea2d057ac2807b0b = true;
                    }
                }
            }
        } catch (Exception $i8c174347956f0a76258a09557543e84f88beb4a0) {
            Mage::getSingleton('adminhtml/session')->addError($i8c174347956f0a76258a09557543e84f88beb4a0->getMessage());
        }
    }

    public function setRecipient($user_send_info)
    {
        if (is_string($user_send_info)) {
            $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6 = new Varien_Object();
            $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setNumber($user_send_info);
            $this->getRecipient()->addItem($a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6);
        } elseif (is_array($user_send_info)) {
            foreach ($user_send_info as $a_plus_plusebe3a16a01f87f9a4ebbb9731163db3e3e64cc3d) {
                if (!trim($a_plus_plusebe3a16a01f87f9a4ebbb9731163db3e3e64cc3d)) continue;
                $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6 = new Varien_Object();
                $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setNumber(trim($a_plus_plusebe3a16a01f87f9a4ebbb9731163db3e3e64cc3d));
                $this->getRecipient()->addItem($a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6);
            }
        }
        return $this;
    }

    public function addRecipient($Number, $user_send_info = array())
    {
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6 = new Varien_Object();
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setNumber($Number);
        if (isset($user_send_info['country'])) $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setCountry($user_send_info['country']);
        if (isset($user_send_info['customerId'])) $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setCustomerId($user_send_info['customerId']);
        if (isset($user_send_info['adminId'])) $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setAdminId($user_send_info['adminId']);
        if (isset($user_send_info['recipient'])) $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setRecipient($user_send_info['recipient']);
        if (isset($user_send_info['text'])) $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setText($user_send_info['text']);
        if (isset($user_send_info['dnd'])) $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setDnd($user_send_info['dnd']);
        $this->getRecipient()->addItem($a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6);
        return $this;
    }

    public function isError()
    {
        return $this->v3a95f9a85ae3fecc89b69aa9ea2d057ac2807b0b ? true : false;
    }

    public function status($a_plus_plus7e9551ab4470830f87be4f9ff5edc75013bc9257 = false)
    {
        $i2e68560d8e15e3c18bb400939778a6bf1ae47190 = array();
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6 = new Varien_Object();
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setStatus(self::SENT);
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setIcon('i_sent.png');
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setName(Mage::helper('magesms')->__('SENT to recipient'));
        $i2e68560d8e15e3c18bb400939778a6bf1ae47190[$a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->status] = $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6;
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6 = new Varien_Object();
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setStatus(self::ERROR);
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setIcon('i_canceled.gif');
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setName(Mage::helper('magesms')->__('ERROR'));
        $i2e68560d8e15e3c18bb400939778a6bf1ae47190[$a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->status] = $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6;
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6 = new Varien_Object();
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setStatus(self::DELIVERED);
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setIcon('i_accepted.gif');
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setName(Mage::helper('magesms')->__('DELIVERED to recipient'));
        $i2e68560d8e15e3c18bb400939778a6bf1ae47190[$a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->status] = $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6;
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6 = new Varien_Object();
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setStatus(self::UNAVAILABLE);
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setIcon('i_buffered.png');
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setName(Mage::helper('magesms')->__('RECIPIENT UNAVAILABLE'));
        $i2e68560d8e15e3c18bb400939778a6bf1ae47190[$a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->status] = $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6;
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6 = new Varien_Object();
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setStatus(self::SIMULATION);
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setIcon('i_simulation.png');
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setName(Mage::helper('magesms')->__('SIMULATION'));
        $i2e68560d8e15e3c18bb400939778a6bf1ae47190[$a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->status] = $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6;
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6 = new Varien_Object();
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setStatus(self::SCHEDULED);
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setIcon('i_scheduled.png');
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setName(Mage::helper('magesms')->__('SCHEDULED'));
        $i2e68560d8e15e3c18bb400939778a6bf1ae47190[$a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->status] = $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6;
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6 = new Varien_Object();
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setStatus(self::DELETED);
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setIcon('i_deleted.png');
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setName(Mage::helper('magesms')->__('DELETED'));
        $i2e68560d8e15e3c18bb400939778a6bf1ae47190[$a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->status] = $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6;
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6 = new Varien_Object();
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setStatus(self::DND);
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setIcon('i_donotdisturb.png');
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setName(Mage::helper('magesms')->__('DO NOT DISTURB registry (DND)'));
        $i2e68560d8e15e3c18bb400939778a6bf1ae47190[$a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->status] = $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6;
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6 = new Varien_Object();
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setStatus(self::DUPLICATE);
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setIcon('i_duplicate.png');
        $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->setName(Mage::helper('magesms')->__('DUPLICATE'));
        $i2e68560d8e15e3c18bb400939778a6bf1ae47190[$a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6->status] = $a_plus_plusf66cdb02406b60b7d525f1fed0b5904ce5586ee6;
        if ($a_plus_plus7e9551ab4470830f87be4f9ff5edc75013bc9257 === false) return $i2e68560d8e15e3c18bb400939778a6bf1ae47190; elseif (isset($i2e68560d8e15e3c18bb400939778a6bf1ae47190[$a_plus_plus7e9551ab4470830f87be4f9ff5edc75013bc9257])) return $i2e68560d8e15e3c18bb400939778a6bf1ae47190[$a_plus_plus7e9551ab4470830f87be4f9ff5edc75013bc9257];
        return false;
    }
}