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
class Topefekt_Magesms_Controller_Template_Action extends Topefekt_Magesms_Controller_Action
{
    public function templateAction()
    {
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e = new Varien_Object();
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setError(false);
        if ($this->getRequest()->getParams()) {
            $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2 = $this->getRequest();
            if ($i1507c94b68f51b22087227858337782550edf618 = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('action')) {
                try {
                    switch ($i1507c94b68f51b22087227858337782550edf618) {
                        case 'saveTemplate':
                            $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setHtml($this->_saveTemplate());
                            break;
                        case 'loadTemplate':
                            $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setHtml($this->_saveTemplate(false));
                            break;
                        case 'save':
                            if ($this->getRequest()->isPost()) {
                                $iefc930e6dfdf3023610ed7d663c73d176a7544e0 = Mage::getModel('magesms/template');
                                $iefc930e6dfdf3023610ed7d663c73d176a7544e0->setData(array('name' => $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('saveName'), 'template' => $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('text'), 'unicode' => $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('unicode'), 'unique' => $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('unique'), 'date' => date('Y-m-d H:i:s'), 'type' => $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('type')));
                                $iefc930e6dfdf3023610ed7d663c73d176a7544e0->save();
                            }
                            break;
                        case 'remove':
                            if ($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538 = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('id')) {
                                $iefc930e6dfdf3023610ed7d663c73d176a7544e0 = Mage::getModel('magesms/template');
                                $iefc930e6dfdf3023610ed7d663c73d176a7544e0->load($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538);
                                $iefc930e6dfdf3023610ed7d663c73d176a7544e0->delete();
                                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setHtml($this->_saveTemplate(false));
                            }
                            break;
                        case 'restore':
                            if ($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538 = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('id')) {
                                $iefc930e6dfdf3023610ed7d663c73d176a7544e0 = Mage::getModel('magesms/template');
                                $iefc930e6dfdf3023610ed7d663c73d176a7544e0->load($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538);
                                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->addData(array('data' => $iefc930e6dfdf3023610ed7d663c73d176a7544e0->getData()));
                            }
                            break;
                    }
                } catch (Exception $i8c174347956f0a76258a09557543e84f88beb4a0) {
                    Mage::getSingleton('adminhtml/session')->addError($i8c174347956f0a76258a09557543e84f88beb4a0->getMessage());
                    $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setError(true);
                    $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setMessage($this->getLayout()->getMessagesBlock()->getGroupedHtml());
                }
            }
        }
        $this->getResponse()->setBody($ia1a238c1f12f3901520c7ca55efa646e471f7f6e->toJson());
    }

    protected function _prepareText($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538fc9fbe8edf868c14fc4a3f15c7f40aabfa080aa, $i3bf172bc34c83f4a18624b192bc0bd7c4d647a66 = null, $i7a5ea366969a291381fafa1448c9a2fafd34ad5e = null, $i9ec689e1c80cd31f364efa77b20f79dcf2612cf0 = null)
    {
        if (Mage::registry('magesms_store_id')) Mage::unregister('magesms_store_id');
        Mage::register('magesms_store_id', $i3bf172bc34c83f4a18624b192bc0bd7c4d647a66, true);
        if (preg_match_all('/{(.*?)}/', $i7d411c0cc32cdb65ec82b9e8d79aa996946f5538fc9fbe8edf868c14fc4a3f15c7f40aabfa080aa, $ia00c63b7b8f0d76f361b9bd281e5073cc0d0aa3e)) {
            $i0933475b5bd80561a9f50282fd9eb0b8345cec4b = array();
            foreach ($ia00c63b7b8f0d76f361b9bd281e5073cc0d0aa3e[1] as $iebd691e534c6cf2e84cf8a88790a5271154fca05) {
                $i0933475b5bd80561a9f50282fd9eb0b8345cec4b[$iebd691e534c6cf2e84cf8a88790a5271154fca05] = '{' . $iebd691e534c6cf2e84cf8a88790a5271154fca05 . '}';
            }
            if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['shop_domain'])) {
                $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['shop_domain'] = Mage::getStoreConfig('web/unsecure/base_url', $i3bf172bc34c83f4a18624b192bc0bd7c4d647a66);
            }
            if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['shop_name'])) {
                $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['shop_name'] = Mage::getStoreConfig('general/store_information/name', $i3bf172bc34c83f4a18624b192bc0bd7c4d647a66);
                if (empty($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['shop_name'])) {
                    if (!empty($i3bf172bc34c83f4a18624b192bc0bd7c4d647a66)) {
                        $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['shop_name'] = Mage::getModel('core/store')->load($i3bf172bc34c83f4a18624b192bc0bd7c4d647a66)->getName();
                    } else {
                        $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['shop_name'] = Mage::app()->getStore()->getName();
                    }
                }
            }
            if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['shop_email'])) {
                $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['shop_email'] = Mage::getStoreConfig('trans_email/ident_general/email', $i3bf172bc34c83f4a18624b192bc0bd7c4d647a66);
            }
            if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['shop_phone'])) {
                $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['shop_phone'] = Mage::getStoreConfig('general/store_information/phone', $i3bf172bc34c83f4a18624b192bc0bd7c4d647a66);
            }
            if (is_object($i7a5ea366969a291381fafa1448c9a2fafd34ad5e) && $i7a5ea366969a291381fafa1448c9a2fafd34ad5e instanceof Varien_Object) {
                if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['customer_firstname'])) {
                    $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['customer_firstname'] = $i7a5ea366969a291381fafa1448c9a2fafd34ad5e->getFirstname();
                }
                if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['customer_lastname'])) {
                    $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['customer_lastname'] = $i7a5ea366969a291381fafa1448c9a2fafd34ad5e->getLastname();
                }
                if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['customer_email'])) {
                    $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['customer_email'] = $i7a5ea366969a291381fafa1448c9a2fafd34ad5e->getEmail();
                }
                if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['customer_phone'])) {
                    $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['customer_phone'] = $i7a5ea366969a291381fafa1448c9a2fafd34ad5e->getTelephone();
                }
            }
            if (!empty($i9ec689e1c80cd31f364efa77b20f79dcf2612cf0) && is_object($i9ec689e1c80cd31f364efa77b20f79dcf2612cf0)) {
                if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_name'])) {
                    $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_name'] = $i9ec689e1c80cd31f364efa77b20f79dcf2612cf0->getName();
                }
                if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_code'])) {
                    $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_code'] = $i9ec689e1c80cd31f364efa77b20f79dcf2612cf0->getCoupon()->getCode();
                }
                if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_description'])) {
                    $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_description'] = $i9ec689e1c80cd31f364efa77b20f79dcf2612cf0->getDescription();
                }
                if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_reduction_percent'])) {
                    $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_reduction_percent'] = Mage::helper('core')->currency($i9ec689e1c80cd31f364efa77b20f79dcf2612cf0->getDiscountAmount(), false, false);
                }
                if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_reduction_amount'])) {
                    $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_reduction_amount'] = Mage::helper('core')->currency($i9ec689e1c80cd31f364efa77b20f79dcf2612cf0->getDiscountAmount(), false, false);
                }
                if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_reduction_currency'])) {
                    $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_reduction_currency'] = Mage::app()->getStore($i3bf172bc34c83f4a18624b192bc0bd7c4d647a66)->getCurrentCurrencyCode();
                }
                if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_date_start'])) {
                    $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_date_start'] = $i9ec689e1c80cd31f364efa77b20f79dcf2612cf0->getFromDate();
                }
                if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_date_end'])) {
                    $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_date_end'] = $i9ec689e1c80cd31f364efa77b20f79dcf2612cf0->getToDate();
                }
                if (isset($i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_quantity'])) {
                    $i0933475b5bd80561a9f50282fd9eb0b8345cec4b['coupon_quantity'] = (int)$i9ec689e1c80cd31f364efa77b20f79dcf2612cf0->getDiscountQty();
                }
            }
            foreach ($i0933475b5bd80561a9f50282fd9eb0b8345cec4b as $i670253c23c6fcba76bc4256a88fdd8fbc1041039 => $if2eee0665f163a28f4adcfe84e3fc666bf1bcd89) {
                $i7d411c0cc32cdb65ec82b9e8d79aa996946f5538fc9fbe8edf868c14fc4a3f15c7f40aabfa080aa = str_replace('{' . $i670253c23c6fcba76bc4256a88fdd8fbc1041039 . '}', $if2eee0665f163a28f4adcfe84e3fc666bf1bcd89, $i7d411c0cc32cdb65ec82b9e8d79aa996946f5538fc9fbe8edf868c14fc4a3f15c7f40aabfa080aa);
            }
        }
        return $i7d411c0cc32cdb65ec82b9e8d79aa996946f5538fc9fbe8edf868c14fc4a3f15c7f40aabfa080aa;
    }

    protected function _saveTemplate($iacea0d13bc5e2676192c06d68cb091dc0ce26320 = true)
    {
        $id82aaf2f437652c4b6efbd55703199f614e8e516 = '';
        if ($iacea0d13bc5e2676192c06d68cb091dc0ce26320) {
            $i1791b2d1f89bb2bd83b34046f59125af207713db = $this->getLayout()->createBlock('Topefekt_Magesms_Block_Template', 'magesms_marketing_templateform', array('template' => 'topefekt/magesms/template/form.phtml'));
            $id82aaf2f437652c4b6efbd55703199f614e8e516 = $i1791b2d1f89bb2bd83b34046f59125af207713db->toHtml();
        }
        $i42cf41da37138d64d37b0778e6561aab5e1239d6 = $this->getLayout()->createBlock('magesms/template_template');
        return $id82aaf2f437652c4b6efbd55703199f614e8e516 . $i42cf41da37138d64d37b0778e6561aab5e1239d6->toHtml();
    }

    protected function _initAction()
    {
        parent::_initAction();
        $this->getLayout()->getBlock('head')->addJs('topefekt/template.js');
        $i3358fd35282548f1f8ccafbf23d60a4ade466fd3 = '
			Translator.add("Template has been loaded.", "' . $this->__('Template has been loaded.') . '");
			Translator.add("Template has been saved.", "' . $this->__('Template has been saved.') . '");
			Translator.add("Are you sure you want to remove the template?", "' . $this->__('Are you sure you want to remove the template?') . '");
		';
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2 = $this->getLayout()->createBlock('core/text', 'template')->setText(Mage::helper('adminhtml/media_js')->getScript($i3358fd35282548f1f8ccafbf23d60a4ade466fd3));
        $this->_addContent($i8ee45e0018a32fb1a855b82624506e35789cc4d2);
        return $this;
    }
}