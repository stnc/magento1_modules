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
class Stnc_Notification_Model_Observer
{




    public function send_data(Varien_Event_Observer $observer)
    {
        $resource = Mage::getSingleton('core/resource');
        /**
         * Retrieve the read connection
         */
        $readConnection = $resource->getConnection('core_read');
        $sonuc = array();
//app\code\local\Webkul\Marketplace\Model\Observer.php
        $order_ids = $observer->getData('order_ids');
        foreach ($order_ids as $order_id) {
            //   Mage::log('sipariş  id' . $order_id, null, 'mageticaret_notification.log', true);
            $order = Mage::getModel('sales/order')->load($order_id);
            $items = $order->getAllVisibleItems();
            $paymentCode = '';
            if ($order->getPayment()) {
                $paymentCode = $order->getPayment()->getMethod();
            }
            foreach ($items as $item) {
//https://stackoverflow.com/questions/11849449/magento-how-to-display-customers-phone-number-on-customer-information-field
                $query = 'SELECT userid FROM marketplace_product WHERE mageproductid = ' . $item->getProductId() . ' LIMIT 1';
                /**
                 * Execute the query and store the result in $sku
                 */
                $customer_id = $readConnection->fetchOne($query);
                //  Mage::log('müşteri id' . $customer_id, null, 'mageticaret_notification.log', true);
                //  Mage::log('urun id' . $item->getProductId(), null, 'mageticaret_notification.log', true);
                //$customer = Mage::getModel('customer/customer')->load($order->getData('customer_id'));
                // //https://magento.stackexchange.com/questions/64277/get-customer-address


               // $product = Mage::getModel('catalog/product')->load($item->getProductId());
               // $urlPath = $product->getUrlPath();



                $customer = Mage::getModel('customer/customer')->load($customer_id);
                if ($customer->getId()) {
                    $numara = $customer->getData()['telefon'];
                    //  Mage::log('müşteri id' . $customer_id . ' numarası ' . $numara, null, 'mageticaret_notification.log', true);
                    $numara = $customer->getData()['telefon'];



                    if ($paymentCode == "banktransfer" or $paymentCode == "cashondelivery") {
                        //  $this->SMSGonder(905331558279, $customer_id,$order_id,$item->getUrl(),true);
                        $this->NotifYSend(46, $order_id, '',true);
                    } else {
                        $this->SMSGonder($numara, $customer_id, $order_id, '',false);
                        $this->NotifYSend($customer_id, $order_id, '',false);
                    }
                }
            }
        }
    }

    function NotifYSend($user_id, $orderID, $productUrl, $payment)
    {
        $helper = Mage::helper('stnc_notification');
        $message = $helper->NotifyMSG($orderID, $productUrl);
        $apiKey = $helper->getAPIKEY();
        $AppID = $helper->getAppID();

        if ($helper->NotifyEnable()) {
            if ($payment){
                $content = array(
                    "en" => $message . ' EFT/HAVALE/Kapıda ödeme',
                    "tr" => $message . ' EFT/HAVALE/Kapıda ödeme'
                );
            } else {
                $content = array(
                    "en" => $message ,
                    "tr" => $message
                );
            }



            $fields = array(
                'app_id' => $AppID,
                'filters' => array(array("field" => "tag", "key" => "WEbKUL_user_id", "relation" => "=", "value" => $user_id)),
                'contents' => $content
            );
            $fields = json_encode($fields);
            //   print("\nJSON sent:\n");
            //  print($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic ' . $apiKey . ''));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            $response = curl_exec($ch);
            curl_close($ch);
        }
    }


//https://magento.stackexchange.com/questions/115290/get-product-id-from-customer-order
    public function SMSGonder($numara, $customer_id, $orderID, $productUrl, $payment)
    {
        $mail_gondersin_mi = false;
        $numara_dogrula = false;

        $sms = Mage::getModel('stnc_notification/sendsms');
        $helper = Mage::helper('stnc_notification');
        //print_r($sms->datass);
        if ($helper->SmSenable()) {
            $numara_dogrula = false;

            if ($numara == "") {
                Mage::log('numara bulunamadı == müşteri id' . $customer_id, null, 'mageticaret_notification.log');
                $numara_dogrula = false;
            } else {
                $numaram = str_replace(" ", "", $numara);
                $numarakarakter = strlen($numaram);
                if ($numarakarakter == 10) {
                    //  $chr_control = substr($numaram, 0, 1);
                    //   if ($chr_control == '5')
                    $numaram = '90' . $numaram;
                    $numara_dogrula = true;
                    //burada else koyup log yapmak gerek
                } else if ($numarakarakter == 11) {
                    //burası ok sorun yok
                    $numaram = '9' . ($numaram);;
                    $numara_dogrula = true;
                } elseif ($numarakarakter == 12) {
                    $chr_control = substr($numaram, 0, 1);
                    if ($chr_control == '9') {
                        $numaram = $numaram;
                        $numara_dogrula = true;
                    } else {
                        $numara_dogrula = false;
                        Mage::log('numarada sorun var numarssı ' . $numaram . ' müşteri id ' . $customer_id, null, 'mageticaret_notification.log');
                    }
                }
            }
            /*
                            $tel = array($numaram);
                            $sonuc[0] = $this->avea_validator1($tel);
                            $sonuc[1] = $this->vodafone_validator($tel);
                            $sonuc[2] = $this->turkcell_validator($tel);
                            $sonuc[3] = $this->avea_validator2($tel);

                            if (in_array("var", $sonuc)) {
                                $numara_dogrula = true;
                            }
            */
            $tel = $numaram;

            try {
                if ($numara_dogrula) {


                    $user_info['username'] = $helper->SmsUserName();
                    $user_info['pass'] = $helper->SmsUserPass();

                    $sms->username = $user_info['username'];
                    $sms->password = $user_info['pass'];


                    $msg= $helper->SmsMSG($orderID, $productUrl) ;

                    /* Send SMS immediately, with default sender (from) and  24h validity period, with unicode support */
                    if ($payment){
                        $response = $sms->submit(array($tel),$msg. ' EFT/HAVALE/Kapıda ödeme', null, null, null, 'Default');//sel
                    } else {
                        $response = $sms->submit(array($tel), $msg , null, null, null, 'Default');//sel
                    }

                    if ($mail_gondersin_mi) {
                        //burası log amaçlıdır
                        $mail = new Zend_Mail();
                        $mail->setBodyText($tel + 'This is the text of the mail.' + $customer_id);
                        $mail->setFrom('rotrigo@$tel.com', $tel + 'Some Sender' + $customer_id);
                        $mail->addTo('selmantunc@gmail.com', 'Some Recipient');
                        $mail->setSubject($tel + ' komnussmacilarr  .' + $customer_id);
                        $mail->send();
                    }
                    /* Check submit response */
                    /* echo '<pre>';
                     print_r($response);*/

                    if ($response->status) {
                        if ($response->payload->Status->Code == 200) {
                            $log1 = array(
                                'code' => $response->payload->Status->Code,
                                'return' => true,
                                'return_id' => $response->payload->MessageId
                            );
                            $array = json_decode(json_encode($log1), true);//mecbur array e cevirilmeli

                            //usleep(3000000);
                            $sorgu_return = $this->sorgu($user_info, $array['return_id'][0]);
                            $sonuc = array(
                                'sorgu_return' => $sorgu_return,
                                'sonuc' => $array,
                            );
                            return $sonuc;
                        } else {
                            $log1 = array(
                                'code' => $response->payload->Status->Code,
                                'desc' => $response->payload->Status->Description,
                                'return' => false,
                                'return_id' => $response->payload->MessageId
                            );

                            $array = json_decode(json_encode($log1), true);
                            $sonuc = array(
                                'sorgu_return' => null,
                                'sonuc' => $array,
                            );
                            /* echo '<pre>';
                             print_r($sonuc);
                             return $sonuc;*/
                        }
                    } else {
                        return $response->error;
                    }
                }
            } catch (Exception $e) {
                Mage::logException($e);
            }
        }

    }

    private function sorgu($user_info, $message_id)
    {
        $sms = Mage::getModel('stnc_notification/sendsms');
        $helper = Mage::helper('stnc_notification');

        $user_info['username'] = $helper->SmsUserName();
        $user_info['pass'] = $helper->SmsUserPass();
        //$sms->($user_name, $pass);

        /* Query SMS messages status by message_id */
        $response = $sms->query($message_id, null);

        /* Query SMS message status by message_id and MSISDN (cell phone number) */
        //$response = $smsapi->query(48357370, '905300000001');

        /* Check query response */
        if ($response->status) {
            if ($response->payload->Status->Code == 200) {

                foreach ($response->payload->ReportDetail->List->ReportDetailItem as $item) {
                    $dizi[] = $item;

                    // return $item->Id . "\t|" . $item->MSISDN . "\t|" . $item->State . "\t|" . $item->ErrorCode . "\t|"  . $item->LastUpdated . "\t\r\n";
                }
                return json_decode(json_encode($dizi), true);
            } else {
                return "No client error but server responded with error: "
                    . $response->payload->Status->Code . "-" . $response->payload->Status->Description;
            }
        } else {
            return "Client error: $response->error";
        }
    }

    /*public function orderSuccess(Varien_Event_Observer $observer)
    {
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
    }*/


}
