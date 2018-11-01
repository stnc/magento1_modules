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
class Topefekt_Magesms_Model_Hooks extends Mage_Core_Model_Abstract
{
    public static $groups = array('order_status' => 0, 'order' => 1, 'account' => 2, 'product' => 3, 'contactform' => 4);

    protected function _construct()
    {
        $this->_init('magesms/hooks');
    }

    public function send($hede7, $hede3)
    {
        $hede1 = Mage::getSingleton('magesms/smsprofile');
        if ($hede1->user->user) {

			$res			= Mage::getSingleton('core/resource');
			$db				= $res->getConnection('core_write');

            $hede2 = Mage::app()->getStore()->getGroupId();
            if (!$hede2 && $hede3->hasStoreId()) {
                $hede2 = Mage::getModel('core/store')->load($hede3->getStoreId())->getGroupId();
            }
            if ($hede3->getStore()) $hede4 = $hede3->getStore()->getId(); elseif (Mage::app()->getStore()) $hede4 = Mage::app()->getStore()->getStoreId();
            else $hede4 = null;
            if (!Mage::helper('magesms')->isActive($hede4)) return $this;
            if (Mage::registry('magesms_store_id')) Mage::unregister('magesms_store_id');
            Mage::register('magesms_store_id', $hede4, true);
            $hede5 = Mage::getSingleton('magesms/hooks_admins')->getCollection();
            if ($hede2 || !Mage::getSingleton('admin/session')->isLoggedIn()) {
                $hede5->addFieldToFilter('store_group_id', $hede2);
            } else {
                $hede5->getSelect()->group('admin_id');
            }
            if ($hede7 == 'updateOrderStatus') {
                $hede6 = $hede3->getStatus();
                $hede6 = preg_replace('/[^a-zA-Z0-9_]/', '_', $hede6);
                $hede6 = preg_replace('/^([^a-zA-Z])/', 'x$1', $hede6);
                $hede5->addFieldToFilter('name', 'orderStatus' . uc_words($hede6, ''));
                $i7744e4decfaad72e8b713dad6e312bdd2770c4da = $hede7 . ' - orderStatus' . uc_words($hede6, '');
            } else {
                $hede5->addFieldToFilter('name', $hede7);
                $i7744e4decfaad72e8b713dad6e312bdd2770c4da = $hede7;
            }
            if ($hede5->count()) {
                $ie8d90f6313614fbb6564426c0b0cb59a0ca4cecd = Mage::getSingleton('magesms/hooks_unicode')->getCollection()->addFieldToFilter('type', 'admin')->getFirstItem();
                foreach ($hede5 as $hede5_item) {
                    $magesms_admin = Mage::getModel('magesms/admins')->load($hede5_item->getAdminId());
                    if (!$magesms_admin) continue;
                    $hede8 = Mage::getModel('magesms/sms');
                    
					$sms_text = $hede5_item->getSmstext();

					/*
					/* Hedo ekledi -- 23.10.2017 -- Cift SMS Fix */ 
					$sql = "SELECT COUNT(*) AS say FROM magesms_smshistory WHERE number='".$magesms_admin->getNumber()."' AND TEXT = '".$sms_text."' AND SUBJECT = '".$i7744e4decfaad72e8b713dad6e312bdd2770c4da."';";
					$say_data = $db->query($sql)->fetch();
					
					if ($say_data['say'] > 0) 
					{
						continue;
					} // if sonu
					
					/* EOF Hedo ekledi -- 23.10.2017 -- Cift SMS Fix */ 

					$hede8->addRecipient(
											$magesms_admin->getNumber(), 
											array(
												'recipient' => $magesms_admin->getName(), 
												'adminId' => $magesms_admin->getId())
											)
											->setMessage($this->prepareText($sms_text, $hede7, $hede3))
											->setSubject($i7744e4decfaad72e8b713dad6e312bdd2770c4da)
											->setType(Topefekt_Magesms_Model_Sms::TYPE_ADMIN)
											->setPriority(true)
											->setUnicode($ie8d90f6313614fbb6564426c0b0cb59a0ca4cecd->getUnicode())
											->setStoreId($hede4);


                    $hede8->setHookName($i7744e4decfaad72e8b713dad6e312bdd2770c4da);
                    $hede8->send();
                }
            }
            if ($hede3 instanceof Mage_Sales_Model_Order && Mage::getStoreConfig('magesms/magesms/customer_groups_enable', $hede4)) {
                $groups = Mage::getStoreConfig('magesms/magesms/customer_groups', $hede4);
                if (!in_array($hede3->getCustomerGroupId(), explode(',', $groups))) return $this;
            }
            $hooks_customers = Mage::getSingleton('magesms/hooks_customers')->getCollection()->addFieldToFilter('active', 1)->addFieldToFilter('mutation', Mage::getStoreConfig('general/locale/code', $hede4));
            if ($hede7 == 'updateOrderStatus') {
                $hede6 = $hede3->getStatus();
                $hede6 = preg_replace('/[^a-zA-Z0-9_]/', '_', $hede6);
                $hede6 = preg_replace('/^([^a-zA-Z])/', 'x$1', $hede6);
                $hooks_customers->addFieldToFilter('name', 'orderStatus' . uc_words($hede6, ''));
                $i7744e4decfaad72e8b713dad6e312bdd2770c4da = $hede7 . ' - orderStatus' . uc_words($hede6, '');
            } else {
                $hooks_customers->addFieldToFilter('name', $hede7);
                $i7744e4decfaad72e8b713dad6e312bdd2770c4da = $hede7;
            }
            
			
			if ($hooks_customers->count()) {
                if ($hede3 instanceof Mage_Sales_Model_Order) {
                    $ib8129b89cda7dae2cfe1b114353de8ba2385974e = Mage::getModel('magesms/optout_order')->getCollection()->addFieldToFilter('order_id', $hede3->getId())->addFieldToFilter('disabled', 1);
                    if ($ib8129b89cda7dae2cfe1b114353de8ba2385974e->count()) {
                        return $this;
                    }
                    if ($hede1->user->getPrefbilling()) {
                        if ($hede3->getShippingAddress()) {
                            $i1f1945594819c4321de45ac15ed6d4dc07f41e2f = $hede3->getShippingAddress()->getTelephone();
                            $idcde4f5fb5532c8e634fa3aa4c7ce182a046d76b = $hede3->getShippingAddress()->getCountryId();
                        }
                        if (empty($i1f1945594819c4321de45ac15ed6d4dc07f41e2f) || !empty($i1f1945594819c4321de45ac15ed6d4dc07f41e2f) && !preg_match('/^[0-9+()\/\.\s-]+$/', $i1f1945594819c4321de45ac15ed6d4dc07f41e2f)) {
                            $i1f1945594819c4321de45ac15ed6d4dc07f41e2f = $hede3->getBillingAddress()->getTelephone();
                            $idcde4f5fb5532c8e634fa3aa4c7ce182a046d76b = $hede3->getBillingAddress()->getCountryId();
                        }
                    } else {
                        $i1f1945594819c4321de45ac15ed6d4dc07f41e2f = $hede3->getBillingAddress()->getTelephone();
                        $idcde4f5fb5532c8e634fa3aa4c7ce182a046d76b = $hede3->getBillingAddress()->getCountryId();
                        if (!$i1f1945594819c4321de45ac15ed6d4dc07f41e2f || preg_match('/^[0-9+()\/\.\s-]+$/', $i1f1945594819c4321de45ac15ed6d4dc07f41e2f)) {
                            $i1f1945594819c4321de45ac15ed6d4dc07f41e2f = $hede3->getShippingAddress()->getTelephone();
                            $idcde4f5fb5532c8e634fa3aa4c7ce182a046d76b = $hede3->getShippingAddress()->getCountryId();
                        }
                    }
                    if (!preg_match('/^[0-9+()\/\.\s-]+$/', $i1f1945594819c4321de45ac15ed6d4dc07f41e2f)) $i1f1945594819c4321de45ac15ed6d4dc07f41e2f = '';
                    $ifb2b31a17a2f13d19aebc5823ae02f42988a78f2 = $hede3->getCustomerId();
                    if (!$ifb2b31a17a2f13d19aebc5823ae02f42988a78f2) $ifb2b31a17a2f13d19aebc5823ae02f42988a78f2 = 0;
                    $i489c048e0604d314330360b5ee23b42f486ebb98 = $hede3->getCustomerName();
                } else {
                    $i1f1945594819c4321de45ac15ed6d4dc07f41e2f = '';
                    $ifb2b31a17a2f13d19aebc5823ae02f42988a78f2 = $hede3->getId();
                }
                if (Mage::helper('core')->isModuleEnabled('Amasty_Orderattr')) {
                    if (($i3a8afabb89bac1f64ee08bc9eeece7680677058c = Mage::app()->getRequest()->getParam('amorderattr')) && !empty($i3a8afabb89bac1f64ee08bc9eeece7680677058c['contact_tel'])) {
                        $i1f1945594819c4321de45ac15ed6d4dc07f41e2f = $i3a8afabb89bac1f64ee08bc9eeece7680677058c['contact_tel'];
                    } else {
                        $i0bc4437a5c5941b7f3a262ba60f104077f308455 = Mage::getModel('amorderattr/attribute')->load($hede3->getId(), 'order_id');
                        if ($i0bc4437a5c5941b7f3a262ba60f104077f308455->getContactTel()) {
                            $i1f1945594819c4321de45ac15ed6d4dc07f41e2f = $i0bc4437a5c5941b7f3a262ba60f104077f308455->getContactTel();
                        }
                    }
                }
                if (!$i1f1945594819c4321de45ac15ed6d4dc07f41e2f) {
                    $ia8a35a47a8e61218e15d1a33dac64bdc2449c01a = Mage::app()->getRequest()->getParams();
                    foreach (array('mobilenumber', 'mobile_number', 'phone', 'phone_number', 'telephone', 'mobile') as $i670253c23c6fcba76bc4256a88fdd8fbc1041039) {
                        if (!empty($ia8a35a47a8e61218e15d1a33dac64bdc2449c01a[$i670253c23c6fcba76bc4256a88fdd8fbc1041039])) {
                            $i1f1945594819c4321de45ac15ed6d4dc07f41e2f = $ia8a35a47a8e61218e15d1a33dac64bdc2449c01a[$i670253c23c6fcba76bc4256a88fdd8fbc1041039];
                            $idcde4f5fb5532c8e634fa3aa4c7ce182a046d76b = Mage::getStoreConfig('general/country/default', $hede4);;
                            break;
                        }
                    }
                }
                if ($i1f1945594819c4321de45ac15ed6d4dc07f41e2f && is_numeric($ifb2b31a17a2f13d19aebc5823ae02f42988a78f2)) {
                    $ifede0aa7d9c3f77f8ca4eb9c1002d82f3a770ae7 = $hooks_customers->getFirstItem();
                    $i6d6da9eb4bc3bca1db3f4eb2b907f496d625d20f = $ifede0aa7d9c3f77f8ca4eb9c1002d82f3a770ae7->getSmstext();
                    if ($i6d6da9eb4bc3bca1db3f4eb2b907f496d625d20f) {
                        $hede8 = Mage::getModel('magesms/sms');
                        $hede8->addRecipient($i1f1945594819c4321de45ac15ed6d4dc07f41e2f, array('recipient' => $i489c048e0604d314330360b5ee23b42f486ebb98, 'customerId' => $ifb2b31a17a2f13d19aebc5823ae02f42988a78f2, 'country' => $idcde4f5fb5532c8e634fa3aa4c7ce182a046d76b))->setMessage($this->prepareText($i6d6da9eb4bc3bca1db3f4eb2b907f496d625d20f, $hede7, $hede3))->setSubject($i7744e4decfaad72e8b713dad6e312bdd2770c4da)->setType(Topefekt_Magesms_Model_Sms::TYPE_CUSTOMER)->setPriority(true)->setStoreId($hede4);
                        $if2014d170e15e7f6f64523fd3238720980ceb64a = Mage::getSingleton('magesms/hooks_unicode')->getCollection()->addFieldToFilter('type', 'customer')->addFieldToFilter('area', $ifede0aa7d9c3f77f8ca4eb9c1002d82f3a770ae7->getMutation());
                        if ($if2014d170e15e7f6f64523fd3238720980ceb64a->count()) {
                            $ie8d90f6313614fbb6564426c0b0cb59a0ca4cecd = $if2014d170e15e7f6f64523fd3238720980ceb64a->getFirstItem();
                            $hede8->setUnicode($ie8d90f6313614fbb6564426c0b0cb59a0ca4cecd->getUnicode());
                        }
                        $hede8->setHookName($i7744e4decfaad72e8b713dad6e312bdd2770c4da);
                        $hede8->send();
                    }
                }
            }
        }
        return $this;
    }

    public function prepareText($idfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa, $hede7, $hede3)
    {
        if (preg_match_all('/{(.*?)}/', $idfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa, $ia00c63b7b8f0d76f361b9bd281e5073cc0d0aa3e)) {
            $hede9 = array();
            foreach ($ia00c63b7b8f0d76f361b9bd281e5073cc0d0aa3e[1] as $iebd691e534c6cf2e84cf8a88790a5271154fca05) {
                $hede9[$iebd691e534c6cf2e84cf8a88790a5271154fca05] = '{' . $iebd691e534c6cf2e84cf8a88790a5271154fca05 . '}';
            }
            if ($hede3->getStore()) $hede4 = $hede3->getStore()->getId(); elseif (Mage::app()->getStore()) $hede4 = Mage::app()->getStore()->getStoreId();
            else $hede4 = null;
            if (isset($hede9['shop_domain'])) {
                $ic157485eecbe64d400493d7b9e7f434b83aca5d0 = parse_url(Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB));
                $hede9['shop_domain'] = $ic157485eecbe64d400493d7b9e7f434b83aca5d0['host'] . ($ic157485eecbe64d400493d7b9e7f434b83aca5d0['path'] != '/' ? $ic157485eecbe64d400493d7b9e7f434b83aca5d0['path'] : '');
            }
            if (isset($hede9['shop_name'])) {
                $hede9['shop_name'] = Mage::getStoreConfig('general/store_information/name', $hede4);
            }
            if (isset($hede9['shop_name2'])) {
                $hede9['shop_name2'] = Mage::app()->getStore()->getName();
            }
            if (isset($hede9['shop_email'])) {
                $hede9['shop_email'] = Mage::getStoreConfig('trans_email/ident_general/email', $hede4);
            }
            if (isset($hede9['shop_phone'])) {
                $hede9['shop_phone'] = Mage::getStoreConfig('general/store_information/phone', $hede4);
            }
            if ($hede7 == 'contactForm') {
                $hede10 = Mage::app()->getRequest();
                if (isset($hede9['customer_email'])) {
                    $hede9['customer_email'] = trim($hede10->getPost('email'));
                }
                if (isset($hede9['customer_name'])) {
                    $hede9['customer_name'] = trim($hede10->getPost('name'));
                }
                if (isset($hede9['customer_phone'])) {
                    $hede9['customer_phone'] = trim($hede10->getPost('telephone'));
                }
                if (isset($hede9['customer_message'])) {
                    $hede9['customer_message'] = trim($hede10->getPost('comment'));
                }
                if (isset($hede9['customer_message_short1'])) {
                    $hede9['customer_message_short1'] = Mage::helper('magesms')->substr(trim($hede10->getPost('comment')), 0, 120);
                }
                if (isset($hede9['customer_message_short2'])) {
                    $hede9['customer_message_short2'] = Mage::helper('magesms')->substr(trim($hede10->getPost('comment')), 0, 100);
                }
                if (isset($hede9['customer_message_short3'])) {
                    $hede9['customer_message_short3'] = Mage::helper('magesms')->substr(trim($hede10->getPost('comment')), 0, 80);
                }
            }
            if ($hede7 == 'customerRegisterSuccess') {
                if (isset($hede9['customer_id'])) {
                    $hede9['customer_id'] = $hede3->getId();
                }
                if (isset($hede9['customer_email'])) {
                    $hede9['customer_email'] = $hede3->getEmail();
                }
                if (isset($hede9['customer_password'])) {
                    $hede9['customer_password'] = Mage::app()->getRequest()->getParam('password');
                }
                if (isset($hede9['customer_firstname'])) {
                    $hede9['customer_firstname'] = $hede3->getFirstname();
                }
                if (isset($hede9['customer_lastname'])) {
                    $hede9['customer_lastname'] = $hede3->getLastname();
                }
            }
            if ($hede7 == 'newOrder' || $hede7 == 'updateOrderStatus' || $hede7 == 'updateOrderTrackingNumber') {
                if (isset($hede9['customer_id'])) {
                    $hede9['customer_id'] = $hede3->getCustomerId();
                }
                if (isset($hede9['customer_email'])) {
                    $hede9['customer_email'] = $hede3->getCustomerEmail();
                }
                if (isset($hede9['customer_firstname'])) {
                    $hede9['customer_firstname'] = $hede3->getCustomerFirstname();
                }
                if (isset($hede9['customer_lastname'])) {
                    $hede9['customer_lastname'] = $hede3->getCustomerLastname();
                }
                if (!isset($i22b151d2a920ca46892d343096abbccfad9f3678)) $i22b151d2a920ca46892d343096abbccfad9f3678 = $hede3->getShippingAddress();
                if (isset($hede9['customer_company'])) {
                    $hede9['customer_company'] = $i22b151d2a920ca46892d343096abbccfad9f3678->getCompany();
                }
                if (isset($hede9['customer_address'])) {
                    $hede9['customer_address'] = $i22b151d2a920ca46892d343096abbccfad9f3678->getStreet(1);
                }
                if (isset($hede9['customer_postcode'])) {
                    $hede9['customer_postcode'] = $i22b151d2a920ca46892d343096abbccfad9f3678->getPostcode();
                }
                if (isset($hede9['customer_city'])) {
                    $hede9['customer_city'] = $i22b151d2a920ca46892d343096abbccfad9f3678->getCity();
                }
                if (isset($hede9['customer_country'])) {
                    $hede9['customer_country'] = $i22b151d2a920ca46892d343096abbccfad9f3678->getCountry();
                }
                if (isset($hede9['customer_state'])) {
                    $hede9['customer_state'] = $i22b151d2a920ca46892d343096abbccfad9f3678->getRegion();
                }
                if (isset($hede9['customer_phone'])) {
                    $hede9['customer_phone'] = $i22b151d2a920ca46892d343096abbccfad9f3678->getTelephone();
                }
                if (isset($hede9['customer_vat_number'])) {
                    $hede9['customer_vat_number'] = $i22b151d2a920ca46892d343096abbccfad9f3678->getVatId();
                }
                if (!isset($i560c12365c45b205daa0512840c70486783226b1)) $i560c12365c45b205daa0512840c70486783226b1 = $hede3->getBillingAddress();
                if (isset($hede9['customer_invoice_company'])) {
                    $hede9['customer_invoice_company'] = $i560c12365c45b205daa0512840c70486783226b1->getCompany();
                }
                if (isset($hede9['customer_invoice_firstname'])) {
                    $hede9['customer_invoice_firstname'] = $i560c12365c45b205daa0512840c70486783226b1->getFirstname();
                }
                if (isset($hede9['customer_invoice_lastname'])) {
                    $hede9['customer_invoice_lastname'] = $i560c12365c45b205daa0512840c70486783226b1->getLastname();
                }
                if (isset($hede9['customer_invoice_address'])) {
                    $hede9['customer_invoice_address'] = $i560c12365c45b205daa0512840c70486783226b1->getStreet(1);
                }
                if (isset($hede9['customer_invoice_postcode'])) {
                    $hede9['customer_invoice_postcode'] = $i560c12365c45b205daa0512840c70486783226b1->getPostcode();
                }
                if (isset($hede9['customer_invoice_city'])) {
                    $hede9['customer_invoice_city'] = $i560c12365c45b205daa0512840c70486783226b1->getCity();
                }
                if (isset($hede9['customer_invoice_country'])) {
                    $hede9['customer_invoice_country'] = $i560c12365c45b205daa0512840c70486783226b1->getCountry();
                }
                if (isset($hede9['customer_invoice_state'])) {
                    $hede9['customer_invoice_state'] = $i560c12365c45b205daa0512840c70486783226b1->getRegion();
                }
                if (isset($hede9['customer_invoice_phone'])) {
                    $hede9['customer_invoice_phone'] = $i560c12365c45b205daa0512840c70486783226b1->getTelephone();
                }
                if (isset($hede9['customer_invoice_vat_number'])) {
                    $hede9['customer_invoice_vat_number'] = $i560c12365c45b205daa0512840c70486783226b1->getVatId();
                }
                if (isset($hede9['order_id'])) {
                    $hede9['order_id'] = $hede3->getIncrementId();
                }
                if (isset($hede9['order_payment'])) {
                    $hede9['order_payment'] = $hede3->getPayment()->getMethodInstance()->getTitle();
                }
                if (isset($hede9['order_payment_html'])) {
                    $ic078737049591e1e2db7c285f3e3b95cb867c6d0 = Mage::helper('payment')->getInfoBlock($hede3->getPayment())->setIsSecureMode(true);
                    $ic078737049591e1e2db7c285f3e3b95cb867c6d0->getMethod()->setStore($hede4);
                    $i42745015bca99637011d2ba8a559beb3a8b0961f = strip_tags($ic078737049591e1e2db7c285f3e3b95cb867c6d0->toHtml());
                    $i42745015bca99637011d2ba8a559beb3a8b0961f = preg_replace('/  +/', ' ', $i42745015bca99637011d2ba8a559beb3a8b0961f);
                    $i42745015bca99637011d2ba8a559beb3a8b0961f = preg_replace("/ \n/", "\n", $i42745015bca99637011d2ba8a559beb3a8b0961f);
                    $i42745015bca99637011d2ba8a559beb3a8b0961f = preg_replace("/\n /", "\n", $i42745015bca99637011d2ba8a559beb3a8b0961f);
                    $i42745015bca99637011d2ba8a559beb3a8b0961f = preg_replace("/\n\n+/", "\n", $i42745015bca99637011d2ba8a559beb3a8b0961f);
                    $hede9['order_payment_html'] = trim($i42745015bca99637011d2ba8a559beb3a8b0961f);
                }
                if (isset($hede9['order_total_paid'])) {
                    $hede9['order_total_paid'] = Mage::getModel('directory/currency')->format($hede3->getGrandTotal(), array('display' => Zend_Currency::NO_SYMBOL), false);
                }
                if (isset($hede9['order_currency'])) {
                    $hede9['order_currency'] = $hede3->getOrderCurrency()->getCurrencyCode();
                }
                $this->f2b4066ec99f97011a4a9f20dd18d97b5a49b8b51($hede9, $hede3->getCreatedAt());
                if (isset($hede9['delivery_date'])) {
                    $ifd002a4ef735f38a6030baa73fafafa1118ff492 = Mage::getModel('ecommerceteam_ddc/order');
                    if ($ifd002a4ef735f38a6030baa73fafafa1118ff492) {
                        $i82d8f80a6f30d2bff1b6b037fd170117a61f4e69 = $ifd002a4ef735f38a6030baa73fafafa1118ff492->load($hede3->getEntityId(), 'order_id')->getData();
                        if (isset($i82d8f80a6f30d2bff1b6b037fd170117a61f4e69['order_id'])) {
                            if (strtotime($i82d8f80a6f30d2bff1b6b037fd170117a61f4e69['delivery_date'])) {
                                $i5b8dea0c150539c8b78ffa4a4ee9b4ea0bf09414 = Mage::getSingleton('core/locale')->date($i82d8f80a6f30d2bff1b6b037fd170117a61f4e69['delivery_date'], Zend_Date::ISO_8601, null, false)->toString(Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_FULL));
                                $hede9['delivery_date'] = $i5b8dea0c150539c8b78ffa4a4ee9b4ea0bf09414;
                            }
                        } elseif ($i2d35534ee8eb5c1c7e742a61e000486ce24db667 = Mage::app()->getRequest()->getParam('delivery_date')) {
                            $hede9['delivery_date'] = $i2d35534ee8eb5c1c7e742a61e000486ce24db667;
                        }
                    }
                }
                if (isset($hede9['estimated_delivery_date'])) {
                    if (Mage::helper('core')->isModuleEnabled('Wyomind_Estimateddeliverydate')) {
                        $hede9['estimated_delivery_date'] = mb_strtoupper(trim(strip_tags(Mage::helper("estimateddeliverydate/data")->getCartMessage())), 'utf-8');
                    }
                }
                if ($hede7 == 'newOrder') {
                    if (isset($hede9['cart_id'])) {
                        $hede9['cart_id'] = Mage::getSingleton('checkout/session')->getQuoteId();
                    }
                    $i32ce098f2dde8081cf3c4de31f52b408a6ad48be = $hede3->getItemsCollection();
                    if (isset($hede9['newOrder1'])) {
                        $i813c950729f632ca03f8c203c0a769de5e8bdf29 = array();
                        foreach ($i32ce098f2dde8081cf3c4de31f52b408a6ad48be as $i69a1201e93806d55c970dfb18feec53d221ba37b) {
                            $i813c950729f632ca03f8c203c0a769de5e8bdf29[] = $i69a1201e93806d55c970dfb18feec53d221ba37b->getId() . '/' . $i69a1201e93806d55c970dfb18feec53d221ba37b->getName() . '/' . $i69a1201e93806d55c970dfb18feec53d221ba37b->getQtyOrdered();
                        }
                        $hede9['newOrder1'] = implode('; ', $i813c950729f632ca03f8c203c0a769de5e8bdf29);
                    }
                    if (isset($hede9['newOrder2'])) {
                        $i813c950729f632ca03f8c203c0a769de5e8bdf29 = array();
                        foreach ($i32ce098f2dde8081cf3c4de31f52b408a6ad48be as $i69a1201e93806d55c970dfb18feec53d221ba37b) {
                            $i813c950729f632ca03f8c203c0a769de5e8bdf29[] = 'id:' . $i69a1201e93806d55c970dfb18feec53d221ba37b->getId() . ', ' . Mage::helper('magesms')->__('name') . ':' . $i69a1201e93806d55c970dfb18feec53d221ba37b->getName() . ', ' . Mage::helper('magesms')->__('qty') . ':' . $i69a1201e93806d55c970dfb18feec53d221ba37b->getQtyOrdered();
                        }
                        $hede9['newOrder2'] = implode('; ', $i813c950729f632ca03f8c203c0a769de5e8bdf29);
                    }
                    if (isset($hede9['newOrder3'])) {
                        $i813c950729f632ca03f8c203c0a769de5e8bdf29 = array();
                        foreach ($i32ce098f2dde8081cf3c4de31f52b408a6ad48be as $i69a1201e93806d55c970dfb18feec53d221ba37b) {
                            $i813c950729f632ca03f8c203c0a769de5e8bdf29[] = $i69a1201e93806d55c970dfb18feec53d221ba37b->getId() . '/' . $i69a1201e93806d55c970dfb18feec53d221ba37b->getQtyOrdered();
                        }
                        $hede9['newOrder3'] = implode('; ', $i813c950729f632ca03f8c203c0a769de5e8bdf29);
                    }
                    if (isset($hede9['newOrder4'])) {
                        $i813c950729f632ca03f8c203c0a769de5e8bdf29 = array();
                        foreach ($i32ce098f2dde8081cf3c4de31f52b408a6ad48be as $i69a1201e93806d55c970dfb18feec53d221ba37b) {
                            $i813c950729f632ca03f8c203c0a769de5e8bdf29[] = 'id:' . $i69a1201e93806d55c970dfb18feec53d221ba37b->getId() . ', ' . Mage::helper('magesms')->__('qty') . ':' . $i69a1201e93806d55c970dfb18feec53d221ba37b->getQtyOrdered();
                        }
                        $hede9['newOrder4'] = implode('; ', $i813c950729f632ca03f8c203c0a769de5e8bdf29);
                    }
                    if (isset($hede9['newOrder5'])) {
                        $i813c950729f632ca03f8c203c0a769de5e8bdf29 = array();
                        foreach ($i32ce098f2dde8081cf3c4de31f52b408a6ad48be as $i69a1201e93806d55c970dfb18feec53d221ba37b) {
                            $i813c950729f632ca03f8c203c0a769de5e8bdf29[] = $i69a1201e93806d55c970dfb18feec53d221ba37b->getId() . '/' . $i69a1201e93806d55c970dfb18feec53d221ba37b->getSku() . '/' . $i69a1201e93806d55c970dfb18feec53d221ba37b->getQtyOrdered();
                        }
                        $hede9['newOrder5'] = implode('; ', $i813c950729f632ca03f8c203c0a769de5e8bdf29);
                    }
                }
                if ($hede7 == 'updateOrderStatus' || $hede7 == 'updateOrderTrackingNumber') {
                    if (!($i9805d668f75b6b461f88474f57c5f6aa86a87316 = Mage::registry('magesms_track_obj'))) $i9805d668f75b6b461f88474f57c5f6aa86a87316 = $hede3->getTracksCollection()->getLastItem();
                    if (!$i9805d668f75b6b461f88474f57c5f6aa86a87316->getId()) {
                        $ia8a35a47a8e61218e15d1a33dac64bdc2449c01a = Mage::app()->getRequest()->getParams();
                        if (isset($ia8a35a47a8e61218e15d1a33dac64bdc2449c01a['tracking']) && ($i71035ea6aa66350bb658a262013eb58377a0934e = $ia8a35a47a8e61218e15d1a33dac64bdc2449c01a['tracking'])) {
                            $i71035ea6aa66350bb658a262013eb58377a0934e = end($i71035ea6aa66350bb658a262013eb58377a0934e);
                            if (!empty($i71035ea6aa66350bb658a262013eb58377a0934e['title'])) $i9805d668f75b6b461f88474f57c5f6aa86a87316->setTitle($i71035ea6aa66350bb658a262013eb58377a0934e['title']);
                            if (!empty($i71035ea6aa66350bb658a262013eb58377a0934e['number'])) $i9805d668f75b6b461f88474f57c5f6aa86a87316->setTrackNumber($i71035ea6aa66350bb658a262013eb58377a0934e['number']);
                        }
                    }
                    if ($i9805d668f75b6b461f88474f57c5f6aa86a87316) {
                        if (isset($hede9['carrier_name'])) {
                            $hede9['carrier_name'] = $i9805d668f75b6b461f88474f57c5f6aa86a87316->getTitle();
                        }
                        if (isset($hede9['order_shipping_number'])) {
                            $hede9['order_shipping_number'] = $i9805d668f75b6b461f88474f57c5f6aa86a87316->getTrackNumber();
                        }
                    }
                    $magesms_admin = Mage::getSingleton('admin/session')->getUser();
                    if (isset($hede9['employee_id'])) {
                        $hede9['employee_id'] = $magesms_admin->getId();
                    }
                    if (isset($hede9['employee_email'])) {
                        $hede9['employee_email'] = $magesms_admin->getEmail();
                    }
                }
            }
            if ($hede7 == 'productOutOfStock' || $hede7 == 'productLowStock') {
                if (isset($hede9['product_id'])) {
                    $hede9['product_id'] = $hede3->getProductId();
                }
                if (isset($hede9['product_quantity'])) {
                    $hede9['product_quantity'] = $hede3->getQty();
                }
                if (isset($hede9['product_name']) || isset($hede9['product_ref'])) {
                    $i69a1201e93806d55c970dfb18feec53d221ba37b = Mage::getModel('catalog/product');
                    $i69a1201e93806d55c970dfb18feec53d221ba37b->load($hede3->getProductId());
                    if (isset($hede9['product_name'])) {
                        $hede9['product_name'] = $i69a1201e93806d55c970dfb18feec53d221ba37b->getName();
                    }
                    if (isset($hede9['product_ref'])) {
                        $hede9['product_ref'] = $i69a1201e93806d55c970dfb18feec53d221ba37b->getSku();
                    }
                }
                if (isset($hede9['customer_id']) || isset($hede9['customer_email']) || isset($hede9['customer_lastname']) || isset($hede9['customer_firstname'])) {
                    if ($i21e55df616c305955791876c1eb4da83448beba2 = Mage::getSingleton('customer/session')->getCustomer()) {
                        if (isset($hede9['customer_id'])) {
                            $hede9['customer_id'] = $i21e55df616c305955791876c1eb4da83448beba2->getId();
                        }
                        if (isset($hede9['customer_email'])) {
                            $hede9['customer_email'] = $i21e55df616c305955791876c1eb4da83448beba2->getEmail();
                        }
                        if (isset($hede9['customer_lastname'])) {
                            $hede9['customer_lastname'] = $i21e55df616c305955791876c1eb4da83448beba2->getLastname();
                        }
                        if (isset($hede9['customer_firstname'])) {
                            $hede9['customer_firstname'] = $i21e55df616c305955791876c1eb4da83448beba2->getFirstname();
                        }
                    }
                }
            }
            foreach ($hede9 as $i670253c23c6fcba76bc4256a88fdd8fbc1041039 => $if2eee0665f163a28f4adcfe84e3fc666bf1bcd89) {
                $idfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa = str_replace('{' . $i670253c23c6fcba76bc4256a88fdd8fbc1041039 . '}', $if2eee0665f163a28f4adcfe84e3fc666bf1bcd89, $idfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa);
            }
        }
        return $idfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa;
    }

    private function f2b4066ec99f97011a4a9f20dd18d97b5a49b8b51(&$hede9, $i53ddb2282ac3aca0d44abe35abcf69959ed66574)
    {
        if (isset($hede9['order_date'])) {
            $hede9['order_date'] = $i53ddb2282ac3aca0d44abe35abcf69959ed66574;
        }
        $i17c20960d197486b19dc890665362a4f2fd6f24a = date_parse($i53ddb2282ac3aca0d44abe35abcf69959ed66574);
        if (isset($hede9['order_date1'])) {
            $hede9['order_date1'] = $i17c20960d197486b19dc890665362a4f2fd6f24a['day'] . '.' . $i17c20960d197486b19dc890665362a4f2fd6f24a['month'] . '.' . $i17c20960d197486b19dc890665362a4f2fd6f24a['year'];
        }
        if (isset($hede9['order_date2'])) {
            $hede9['order_date2'] = $i17c20960d197486b19dc890665362a4f2fd6f24a['day'] . '/' . $i17c20960d197486b19dc890665362a4f2fd6f24a['month'] . '/' . $i17c20960d197486b19dc890665362a4f2fd6f24a['year'];
        }
        if (isset($hede9['order_date3'])) {
            $hede9['order_date3'] = $i17c20960d197486b19dc890665362a4f2fd6f24a['day'] . '-' . $i17c20960d197486b19dc890665362a4f2fd6f24a['month'] . '-' . $i17c20960d197486b19dc890665362a4f2fd6f24a['year'];
        }
        if (isset($hede9['order_date4'])) {
            $hede9['order_date4'] = $i17c20960d197486b19dc890665362a4f2fd6f24a['year'] . '-' . $i17c20960d197486b19dc890665362a4f2fd6f24a['month'] . '-' . $i17c20960d197486b19dc890665362a4f2fd6f24a['day'];
        }
        if (isset($hede9['order_date5'])) {
            $hede9['order_date5'] = $i17c20960d197486b19dc890665362a4f2fd6f24a['month'] . '.' . $i17c20960d197486b19dc890665362a4f2fd6f24a['day'] . '.' . $i17c20960d197486b19dc890665362a4f2fd6f24a['year'];
        }
        if (isset($hede9['order_date6'])) {
            $hede9['order_date6'] = $i17c20960d197486b19dc890665362a4f2fd6f24a['month'] . '/' . $i17c20960d197486b19dc890665362a4f2fd6f24a['day'] . '/' . $i17c20960d197486b19dc890665362a4f2fd6f24a['year'];
        }
        if (isset($hede9['order_date7'])) {
            $hede9['order_date7'] = $i17c20960d197486b19dc890665362a4f2fd6f24a['month'] . '-' . $i17c20960d197486b19dc890665362a4f2fd6f24a['day'] . '-' . $i17c20960d197486b19dc890665362a4f2fd6f24a['year'];
        }
        if (isset($hede9['order_time'])) {
            $hede9['order_time'] = $i17c20960d197486b19dc890665362a4f2fd6f24a['hour'] . ':' . sprintf('%02.0f', $i17c20960d197486b19dc890665362a4f2fd6f24a['minute']);
        }
        if (isset($hede9['order_time1'])) {
            $hede9['order_time1'] = $i17c20960d197486b19dc890665362a4f2fd6f24a['hour'] . ':' . sprintf('%02.0f', $i17c20960d197486b19dc890665362a4f2fd6f24a['minute']) . ':' . sprintf('%02.0f', $i17c20960d197486b19dc890665362a4f2fd6f24a['second']);
        }
    }
}