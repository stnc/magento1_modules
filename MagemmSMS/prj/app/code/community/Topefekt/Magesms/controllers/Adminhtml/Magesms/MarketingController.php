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
class Topefekt_Magesms_Adminhtml_Magesms_MarketingController extends Topefekt_Magesms_Controller_Template_Action
{
    private $vdc6442a8b0624835ef0da7b7fcc0ac1da4d6d2da = array('type', 'country', 'group', 'gender', 'newsletter', 'website', 'firstname', 'lastname', 'city', 'register', 'birthday', 'birthdayall', 'orderssum', 'product');
    protected $_filters;
    protected $_collection;
    private $v148194b5b9cc653ce2e35e9709e441dc6fd4123a = array();

    public function preDispatch()
    {
        parent::preDispatch();
        $ia309f32db02d9de4490b0dcce975d0ccbce2c215 = Mage::helper('adminhtml')->prepareFilterString($this->getRequest()->getParam('sms'));
        $ia309f32db02d9de4490b0dcce975d0ccbce2c215 = $this->_filterDates($ia309f32db02d9de4490b0dcce975d0ccbce2c215, array('datumodesl'));
        $ia8a35a47a8e61218e15d1a33dac64bdc2449c01a = new Varien_Object();
        foreach ($ia309f32db02d9de4490b0dcce975d0ccbce2c215 as $i670253c23c6fcba76bc4256a88fdd8fbc1041039 => $if2eee0665f163a28f4adcfe84e3fc666bf1bcd89) {
            if (!empty($if2eee0665f163a28f4adcfe84e3fc666bf1bcd89) || is_numeric($if2eee0665f163a28f4adcfe84e3fc666bf1bcd89)) {
                $ia8a35a47a8e61218e15d1a33dac64bdc2449c01a->setData($i670253c23c6fcba76bc4256a88fdd8fbc1041039, $if2eee0665f163a28f4adcfe84e3fc666bf1bcd89);
            }
        }
        $this->_smsData = $ia8a35a47a8e61218e15d1a33dac64bdc2449c01a;
        return $this;

    }

    private function marketing_filter_collection()
    {
        $this->_filters = Mage::getModel('magesms/marketing_filter_collection');
        $this->_filters->addFilters($this->vdc6442a8b0624835ef0da7b7fcc0ac1da4d6d2da);
        Mage::register('magesms_marketing_filters', $this->_filters, true);
        $this->_collection = $this->_getCollection();
        $this->_filters->setCollection($this->_collection);
        $this->_filters->setFilters($this->_collection);
        Mage::register('magesms_marketing_collection', $this->_collection, true);
    }

    public function indexAction()
    {
        $this->_initAction();
        $this->marketing_filter_collection();
        $i5509ac707290a86add15ab0ce4da982d395f4c4f = $this->getLayout()->createBlock('Topefekt_Magesms_Block_Template', 'my_block_name_here', array('template' => 'topefekt/magesms/marketing.phtml'));
        $i5509ac707290a86add15ab0ce4da982d395f4c4f->setSmsData($this->_smsData ? $this->_smsData : $this->getRequest()->getParams());
        $i5509ac707290a86add15ab0ce4da982d395f4c4f->setFilterData($this->_filterData);
        $i7d411c0cc32cdb65ec82b9e8d79aa996946f553842c5963b49dec2d3a886ec5045e3b8e035c239f = '{customer_firstname}, {customer_lastname}, {customer_email}, {customer_phone}, {shop_name}, {shop_domain}, {shop_email}, {shop_phone}';
        $i1ec93d6cdf7202ea32d00997e9d5b5a68e2df3bc = '{coupon_name}, {coupon_code}, {coupon_description}, {coupon_reduction_percent}, {coupon_reduction_amount}, {coupon_reduction_currency}, {coupon_date_start}, {coupon_date_end}, {coupon_quantity}';
        $i5509ac707290a86add15ab0ce4da982d395f4c4f->setNotice($i7d411c0cc32cdb65ec82b9e8d79aa996946f553842c5963b49dec2d3a886ec5045e3b8e035c239f);
        $i5509ac707290a86add15ab0ce4da982d395f4c4f->setCouponsNotice($i1ec93d6cdf7202ea32d00997e9d5b5a68e2df3bc);
        $i5509ac707290a86add15ab0ce4da982d395f4c4f->setTranslate(Mage::helper('magesms')->hookVariablesJS($i7d411c0cc32cdb65ec82b9e8d79aa996946f553842c5963b49dec2d3a886ec5045e3b8e035c239f . ', ' . $i1ec93d6cdf7202ea32d00997e9d5b5a68e2df3bc));
        $i5509ac707290a86add15ab0ce4da982d395f4c4f->setCollection($this->_collection);
        $i3e3a0f2ae6a0c8837eef43b5d93ce2acef452442 = Mage::getModel('salesrule/rule')->getCollection()->addFieldToFilter('is_active', 1)->addFieldToFilter('coupon_type', Mage_SalesRule_Model_Rule::COUPON_TYPE_SPECIFIC);
        $ic6e86aba1bc36abbc0265f7e37437aa716c170c0 = array(array('rule_id' => '', 'name' => '- ' . Mage::helper('magesms')->__('Please Select') . ' -'));
        $ic6e86aba1bc36abbc0265f7e37437aa716c170c0 = array_merge($ic6e86aba1bc36abbc0265f7e37437aa716c170c0, $i3e3a0f2ae6a0c8837eef43b5d93ce2acef452442->getData());
        $i5509ac707290a86add15ab0ce4da982d395f4c4f->setCoupons($ic6e86aba1bc36abbc0265f7e37437aa716c170c0);
        $this->getLayout()->getBlock('content')->append($i5509ac707290a86add15ab0ce4da982d395f4c4f);
        $iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a = $this->getLayout()->createBlock('magesms/marketing_form');
        $this->getLayout()->getBlock('content')->append($iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a);
        $i21e55df616c305955791876c1eb4da83448beba2 = $this->_getBlockCustomer();
        $this->getLayout()->getBlock('content')->append($i21e55df616c305955791876c1eb4da83448beba2);
        $i2ca8461421e371a2dc8ff5b5c9a248f5fb0a6dbc = $this->_getBlockDeleted();
        $this->getLayout()->getBlock('content')->append($i2ca8461421e371a2dc8ff5b5c9a248f5fb0a6dbc);
        $this->renderLayout();
        return $this;
    }

    public function filterAction()
    {
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e = new Varien_Object();
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setError(false);
        if ($this->getRequest()->getParams()) {
            $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setType('marketing');
            $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2 = $this->getRequest();
            if ($i1507c94b68f51b22087227858337782550edf618 = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('action')) {
                try {
                    switch ($i1507c94b68f51b22087227858337782550edf618) {
                        case 'save':
                            $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setHtml($this->_popup());
                            break;
                        case 'load':
                            $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setHtml($this->_popup(false));
                            break;
                        case 'saveFilter':
                            if ($this->getRequest()->isPost()) {
                                $this->marketing_filter_collection();
                                $iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a = Mage::getModel('magesms/marketing_filter');
                                $iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a->setData(array('name' => $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('saveName'), 'filter' => $this->_filters->toSerialize(), 'date' => date('Y-m-d H:i:s'),));
                                $iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a->save();
                            }
                            break;
                        case 'remove':
                            if ($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538 = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('id')) {
                                $iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a = Mage::getModel('magesms/marketing_filter');
                                $iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a->load($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538);
                                $iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a->delete();
                                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setHtml($this->_popup(false));
                            }
                            break;
                        case 'restore':
                            if ($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538 = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('id')) {
                                $iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a = Mage::getModel('magesms/marketing_filter');
                                if ($iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a->load($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538)) {
                                    $i2d8fb6b6f17ec9aa17899ea311cc26bc493cd9a2 = Mage::getModel('magesms/marketing_filter_collection');
                                    $i2d8fb6b6f17ec9aa17899ea311cc26bc493cd9a2->fromSerialize($iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a->getFilter());
                                    $this->marketing_filter_collection();
                                    $i21e55df616c305955791876c1eb4da83448beba2 = $this->_getBlockCustomer();
                                    $i9e86252a333eb6c832bb895a8d1690c48b2ed3fd = $this->_getBlockDeleted();
                                    $i1791b2d1f89bb2bd83b34046f59125af207713db = $this->getLayout()->createBlock('magesms/marketing_form');
                                    $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setHtml(array('appliedFilters' => $i1791b2d1f89bb2bd83b34046f59125af207713db->getHtmlFilters(), 'customers' => $i21e55df616c305955791876c1eb4da83448beba2->toHtml(), 'deleted' => $i9e86252a333eb6c832bb895a8d1690c48b2ed3fd->toHtml(), 'count' => $this->_collection->count()));
                                }
                            }
                            break;
                        case 'loadFilter':
                            if ($i2bd9743336318d0e14be0600c9129730279505dd = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('name')) {
                                if ($iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a = Mage::getModel('magesms/marketing_filter_' . $i2bd9743336318d0e14be0600c9129730279505dd)) {
                                    $i1791b2d1f89bb2bd83b34046f59125af207713db = new Varien_Data_Form();
                                    switch ($iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a->filter['type']) {
                                        case 'select':
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('filter', 'select', array('name' => 'filter', 'values' => $iba20acc78644ac0e9cd48ea35d8ad03b058f6b5a->getValues(),));
                                            break;
                                        case 'input':
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('filter', 'text', array('name' => 'filter',));
                                            break;
                                        case 'datetime':
                                            $i8114d84b871449f246242a4433e364f848daff0c = array();
                                            $i03474abc9cad4f5c29a2f0bca70a29051a128bc9 = 'Calendar.setup({
												inputField: "%s",
												ifFormat: "%s",
												showsTime: true,
												button: "%s_trig",
												align: "Bl",
												singleClick : true
											});';
                                            $i5e2f8ae4963934ca8fbc2fff6103b6356dd52c78 = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
                                            $i376a6873d4104d44a8d8f0acacfc41b40105e11f = Varien_Date::convertZendToStrFtime($i5e2f8ae4963934ca8fbc2fff6103b6356dd52c78, true, true);
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('filter1', 'date', array('name' => 'filter[]', 'format' => $i5e2f8ae4963934ca8fbc2fff6103b6356dd52c78, 'value' => Mage::app()->getLocale()->date()->toString(), 'image' => Mage::getDesign()->getSkinUrl('images/grid-cal.gif'),));
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('note', 'note', array('text' => Mage::helper('magesms')->__('to: '),));
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('filter2', 'date', array('name' => 'filter[]', 'format' => $i5e2f8ae4963934ca8fbc2fff6103b6356dd52c78, 'value' => Mage::app()->getLocale()->date()->toString(), 'image' => Mage::getDesign()->getSkinUrl('images/grid-cal.gif'),));
                                            $i8114d84b871449f246242a4433e364f848daff0c[] = sprintf($i03474abc9cad4f5c29a2f0bca70a29051a128bc9, 'filter1', $i376a6873d4104d44a8d8f0acacfc41b40105e11f, 'filter1');
                                            $i8114d84b871449f246242a4433e364f848daff0c[] = sprintf($i03474abc9cad4f5c29a2f0bca70a29051a128bc9, 'filter2', $i376a6873d4104d44a8d8f0acacfc41b40105e11f, 'filter2');
                                            $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setJs($i8114d84b871449f246242a4433e364f848daff0c);
                                            break;
                                        case 'date':
                                            $i8114d84b871449f246242a4433e364f848daff0c = array();
                                            $i03474abc9cad4f5c29a2f0bca70a29051a128bc9 = 'Calendar.setup({
												inputField: "%s",
												ifFormat: "%s",
												showsTime: false,
												button: "%s_trig",
												align: "Bl",
												singleClick : true
											});';
                                            $i5e2f8ae4963934ca8fbc2fff6103b6356dd52c78 = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
                                            $i376a6873d4104d44a8d8f0acacfc41b40105e11f = Varien_Date::convertZendToStrFtime($i5e2f8ae4963934ca8fbc2fff6103b6356dd52c78, true, true);
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('filter1', 'date', array('name' => 'filter[]', 'format' => $i5e2f8ae4963934ca8fbc2fff6103b6356dd52c78, 'value' => Mage::app()->getLocale()->date()->toString(), 'image' => Mage::getDesign()->getSkinUrl('images/grid-cal.gif'),));
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('note', 'note', array('text' => Mage::helper('magesms')->__('to: '),));
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('filter2', 'date', array('name' => 'filter[]', 'format' => $i5e2f8ae4963934ca8fbc2fff6103b6356dd52c78, 'value' => Mage::app()->getLocale()->date()->toString(), 'image' => Mage::getDesign()->getSkinUrl('images/grid-cal.gif'),));
                                            $i8114d84b871449f246242a4433e364f848daff0c[] = sprintf($i03474abc9cad4f5c29a2f0bca70a29051a128bc9, 'filter1', $i376a6873d4104d44a8d8f0acacfc41b40105e11f, 'filter1');
                                            $i8114d84b871449f246242a4433e364f848daff0c[] = sprintf($i03474abc9cad4f5c29a2f0bca70a29051a128bc9, 'filter2', $i376a6873d4104d44a8d8f0acacfc41b40105e11f, 'filter2');
                                            $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setJs($i8114d84b871449f246242a4433e364f848daff0c);
                                            break;
                                        case 'birthdayall':
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('note1', 'note', array('text' => Mage::helper('magesms')->__('day') . ': ',));
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('filter1', 'select', array('name' => 'filter[]', 'values' => array_combine(range(1, 31), range(1, 31)),));
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('note2', 'note', array('text' => Mage::helper('magesms')->__('month') . ': ',));
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('filter2', 'select', array('name' => 'filter[]', 'values' => array_combine(range(1, 12), range(1, 12)),));
                                            break;
                                        case 'number':
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('filter1', 'select', array('name' => 'filter[]', 'values' => array('0' => '<', '1' => '>', '2' => '=', '3' => '≠'), 'style' => 'min-width:auto;width:40px'));
                                            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('filter2', 'text', array('name' => 'filter[]',));
                                            break;
                                    }
                                    $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setHtml($i1791b2d1f89bb2bd83b34046f59125af207713db->getHtml());
                                }
                            }
                            break;
                        case 'applyFilter':
                            $if2eee0665f163a28f4adcfe84e3fc666bf1bcd89 = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('value');
                            if (is_array($if2eee0665f163a28f4adcfe84e3fc666bf1bcd89) && count($if2eee0665f163a28f4adcfe84e3fc666bf1bcd89) == 1) $if2eee0665f163a28f4adcfe84e3fc666bf1bcd89 = $if2eee0665f163a28f4adcfe84e3fc666bf1bcd89[0];
                            if (($i2bd9743336318d0e14be0600c9129730279505dd = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('name')) && $if2eee0665f163a28f4adcfe84e3fc666bf1bcd89 !== '') {
                                $i2d8fb6b6f17ec9aa17899ea311cc26bc493cd9a2 = Mage::getModel('magesms/marketing_filter_collection');
                                $i2d8fb6b6f17ec9aa17899ea311cc26bc493cd9a2->addApplyFilter($i2bd9743336318d0e14be0600c9129730279505dd, $if2eee0665f163a28f4adcfe84e3fc666bf1bcd89);
                                $this->marketing_filter_collection();
                                $i21e55df616c305955791876c1eb4da83448beba2 = $this->_getBlockCustomer();
                                $i1791b2d1f89bb2bd83b34046f59125af207713db = $this->getLayout()->createBlock('magesms/marketing_form');
                                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setHtml(array('appliedFilters' => $i1791b2d1f89bb2bd83b34046f59125af207713db->getHtmlFilters(), 'customers' => $i21e55df616c305955791876c1eb4da83448beba2->toHtml(), 'count' => $this->_collection->count()));
                            }
                            break;
                        case 'removeFilter':
                            $i7d411c0cc32cdb65ec82b9e8d79aa996946f5538 = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('id');
                            if (is_numeric($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538)) {
                                $i2d8fb6b6f17ec9aa17899ea311cc26bc493cd9a2 = Mage::getModel('magesms/marketing_filter_collection');
                                $i2d8fb6b6f17ec9aa17899ea311cc26bc493cd9a2->removeFilter($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538);
                                $this->marketing_filter_collection();
                                $i21e55df616c305955791876c1eb4da83448beba2 = $this->_getBlockCustomer();
                                $i9e86252a333eb6c832bb895a8d1690c48b2ed3fd = $this->_getBlockDeleted();
                                $i1791b2d1f89bb2bd83b34046f59125af207713db = $this->getLayout()->createBlock('magesms/marketing_form');
                                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setHtml(array('appliedFilters' => $i1791b2d1f89bb2bd83b34046f59125af207713db->getHtmlFilters(), 'customers' => $i21e55df616c305955791876c1eb4da83448beba2->toHtml(), 'deleted' => $i9e86252a333eb6c832bb895a8d1690c48b2ed3fd->toHtml(), 'count' => $this->_collection->count()));
                            }
                            break;
                        case 'listCustomers':
                            if ($i47b2a41e4081b6f8d8381f411087dcd7042bfb53 = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('letter')) {
                                $i2d8fb6b6f17ec9aa17899ea311cc26bc493cd9a2 = Mage::getModel('magesms/marketing_filter_collection');
                                $this->marketing_filter_collection();
                                $this->_collection->addFieldToFilter('lastname', array('like' => $i47b2a41e4081b6f8d8381f411087dcd7042bfb53 . '%'));
                                $i21e55df616c305955791876c1eb4da83448beba2 = $this->getBlockCustomer();
                                $i21e55df616c305955791876c1eb4da83448beba2->setCollection($this->_collection);
                                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setHtml($i21e55df616c305955791876c1eb4da83448beba2->toHtml());
                                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setType('customer');
                            }
                            break;
                        case 'removeCustomer':
                            if ($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538 = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('id')) {
                                $i2d8fb6b6f17ec9aa17899ea311cc26bc493cd9a2 = Mage::getModel('magesms/marketing_filter_collection');
                                $i2d8fb6b6f17ec9aa17899ea311cc26bc493cd9a2->addRemoveCustomer($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538);
                                $this->marketing_filter_collection();
                                $ib1285cda66d7403b4e0132565b5359295c62d58c = clone $this->_collection;
                                $i21e55df616c305955791876c1eb4da83448beba2 = $this->_getBlockCustomer();
                                $i9e86252a333eb6c832bb895a8d1690c48b2ed3fd = $this->_getBlockDeleted();
                                $id82aaf2f437652c4b6efbd55703199f614e8e516 = array('customers' => $i21e55df616c305955791876c1eb4da83448beba2->toHtml(), 'deleted' => $i9e86252a333eb6c832bb895a8d1690c48b2ed3fd->toHtml(), 'count' => $this->_collection->count());
                                if ($i47b2a41e4081b6f8d8381f411087dcd7042bfb53 = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('letter')) {
                                    $ib1285cda66d7403b4e0132565b5359295c62d58c->addFieldToFilter('lastname', array('like' => $i47b2a41e4081b6f8d8381f411087dcd7042bfb53 . '%'));
                                    $i2ca8461421e371a2dc8ff5b5c9a248f5fb0a6dbc = $this->getBlockCustomer();
                                    $i2ca8461421e371a2dc8ff5b5c9a248f5fb0a6dbc->setCollection($ib1285cda66d7403b4e0132565b5359295c62d58c);
                                    $id82aaf2f437652c4b6efbd55703199f614e8e516['customer_letter'] = $i2ca8461421e371a2dc8ff5b5c9a248f5fb0a6dbc->toHtml();
                                    $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setType('customer');
                                }
                                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setHtml($id82aaf2f437652c4b6efbd55703199f614e8e516);
                            }
                            break;
                        case 'reset':
                            $i2d8fb6b6f17ec9aa17899ea311cc26bc493cd9a2 = Mage::getModel('magesms/marketing_filter_collection');
                            $i2d8fb6b6f17ec9aa17899ea311cc26bc493cd9a2->resetFilter();
                            $this->marketing_filter_collection();
                            $i21e55df616c305955791876c1eb4da83448beba2 = $this->_getBlockCustomer();
                            $i9e86252a333eb6c832bb895a8d1690c48b2ed3fd = $this->_getBlockDeleted();
                            $i1791b2d1f89bb2bd83b34046f59125af207713db = $this->getLayout()->createBlock('magesms/marketing_form');
                            $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setHtml(array('appliedFilters' => $i1791b2d1f89bb2bd83b34046f59125af207713db->getHtmlFilters(), 'customers' => $i21e55df616c305955791876c1eb4da83448beba2->toHtml(), 'deleted' => $i9e86252a333eb6c832bb895a8d1690c48b2ed3fd->toHtml(), 'count' => $this->_collection->count()));
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

    protected function _popup($iacea0d13bc5e2676192c06d68cb091dc0ce26320 = true)
    {
        $id82aaf2f437652c4b6efbd55703199f614e8e516 = '';
        if ($iacea0d13bc5e2676192c06d68cb091dc0ce26320) {
            $i1791b2d1f89bb2bd83b34046f59125af207713db = $this->getLayout()->createBlock('Topefekt_Magesms_Block_Template', 'magesms_marketing_templateform', array('template' => 'topefekt/magesms/marketing/form.phtml'));
            $id82aaf2f437652c4b6efbd55703199f614e8e516 = $i1791b2d1f89bb2bd83b34046f59125af207713db->toHtml();
        }
        $i42cf41da37138d64d37b0778e6561aab5e1239d6 = $this->getLayout()->createBlock('magesms/marketing_template');
        return $id82aaf2f437652c4b6efbd55703199f614e8e516 . $i42cf41da37138d64d37b0778e6561aab5e1239d6->toHtml();
    }

    public function sendAction()
    {

        $var_object = new Varien_Object();
        $var_object->setError(false);
        if ($this->getRequest()->getPost()) {
            try {
              ///  Mage::getModel('magesms/observer')->cronUpdate();//bunu version için kullanıyor
                $regqst_data = Mage::app()->getRequest();
                $git_data = $regqst_data->getPost('text');
                $unique = $regqst_data->getPost('unique') ? true : false;
                $unicode = $regqst_data->getPost('unicode') ? true : false;
                $coupon = $regqst_data->getPost('coupon');
                $sms_info = Mage::getModel('magesms/sms');
                $sms_info->setMessage($git_data)->setType(Topefekt_Magesms_Model_Sms::TYPE_MARKETING)->setPriority(false)->setUnicode($unicode)->setUnique($unique);
                if ($regqst_data->getPost('sendlater') && $regqst_data->getPost('datumodesl')) {
                    $datumodesl = $regqst_data->getPost('datumodesl');
                    $datumodesl_hour = $regqst_data->getPost('datumodesl_hour');
                    $datumodesl_min = $regqst_data->getPost('datumodesl_min');
                    $datereal = $regqst_data->getPost('datereal', 0);
                    $datumodesl = strtotime("$datumodesl $datumodesl_hour:$datumodesl_min:00") + 3600 * $datereal;
                    $sms_info->setSendlater($datumodesl);
                }
                $this->marketing_filter_collection();
                $coupon_bkz = null;
                if ($coupon) {
                    $coupon_bkz = Mage::getSingleton('salesrule/rule')->load($coupon);
                    if ($coupon_bkz) {
                        if ($coupon_bkz->getUseAutoGeneration()) {
                            if (count($coupon_bkz->getCoupons()) < $this->_collection->count()) {
                                $info_data = Mage::helper('magesms')->__('Few coupons have been generated. Generate more coupons.');
                                $info_data .= '<br />' . Mage::helper('magesms')->__('Number of coupons: %s', count($coupon_bkz->getCoupons()));
                                $info_data .= '<br />' . Mage::helper('magesms')->__('Number of recipients: %s', $this->_collection->count());
                                Mage::throwException($info_data);
                            }
                        }
                        if ($get_coup_look = $coupon_bkz->getCoupons()) {
                            $coupon_bkz->setCoupon(current($get_coup_look));
                        }
                    }
                }
                foreach ($this->_collection as $coll_row) {
                    if ($coll_row->getWebsiteId()) {
                        if (isset($this->web_site_inf['website_' . $coll_row->getWebsiteId()])) {
                            $web_site_ = $this->web_site_inf['website_' . $coll_row->getWebsiteId()];
                            $store_id_ = $this->web_site_inf['store-id_' . $coll_row->getWebsiteId()];
                        } else {
                            $this->web_site_inf['website_' . $coll_row->getWebsiteId()] = $web_site_ = Mage::getModel('core/website')->load($coll_row->getWebsiteId());
                            $this->web_site_inf['store-id_' . $coll_row->getWebsiteId()] = $store_id_ = $web_site_->getDefaultStore()->getId();
                        }
                    } else {
                        $store_id_ = null;
                    }
                    $sms_info->addRecipient(
                        $coll_row->getTelephone(),
                        array(
                            'country' => $coll_row->getCountryId(),
                            'customerId' => $coll_row->getId(),
                            'recipient' => $coll_row->getFirstname() . ' ' . $coll_row->getLastname(),
                            'text' => $this->_prepareText($git_data, $store_id_, $coll_row, $coupon_bkz),
                            'dnd' => !(($dnd_look_ = $coll_row->getMagesmsCustomerMarketing()) ? $dnd_look_ : is_null($dnd_look_) ? 1 : $dnd_look_),
                            )
                    );

                    if ($coupon_bkz && $coupon_bkz->getUseAutoGeneration()) {
                        $coupon_bkz->setCoupon(next($get_coup_look));
                    }
                }
                $sms_info->send();//onemli olan kısım

                $this->getResponse()->setBody($var_object->toJson());
            } catch (Exception $exception_info) {
                Mage::getSingleton('adminhtml/session')->addError($exception_info->getMessage());
                $this->_initLayoutMessages('adminhtml/session');
                $var_object->setError(true);
                $var_object->setMessage($this->getLayout()->getMessagesBlock()->getGroupedHtml());
                $this->getResponse()->setBody($var_object->toJson());
            }
        } else {
            $this->getResponse()->setBody($var_object->toJson());
        }
        return $this;
    }

    public function sentAction()
    {
        $this->_redirect('*/*/index');
    }

    protected function _getBlockCustomer()
    {
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2 = $this->getLayout()->createBlock('magesms/marketing_customer');
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2->setCollection($this->_collection);
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2->setTitle(Mage::helper('magesms')->__('Customers found: '));
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2->setId('customer');
        return $i8ee45e0018a32fb1a855b82624506e35789cc4d2;
    }

    protected function _getBlockDeleted()
    {
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2 = $this->getLayout()->createBlock('magesms/marketing_customer');
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2->setDeleteCustomer(true);
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2->setTitle(Mage::helper('magesms')->__('Removed Customers: '));
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2->setId('deleted');
        $iff7e46827cbb6547116c592bf800f4687428abf9 = Mage::helper('magesms')->getCustomerCollection();
        $iff7e46827cbb6547116c592bf800f4687428abf9->addFieldToFilter('entity_id', array('in' => $this->_filters->getCache()->getCustomers()->getIds()));
        foreach ($iff7e46827cbb6547116c592bf800f4687428abf9 as $i705fa7c9639d497e1179d7d5691c212668a8c9c8) {
            $i705fa7c9639d497e1179d7d5691c212668a8c9c8->setDetailUrl(Mage::helper("adminhtml")->getUrl('adminhtml/customer/edit', array('id' => $i705fa7c9639d497e1179d7d5691c212668a8c9c8->getId())));
            $i705fa7c9639d497e1179d7d5691c212668a8c9c8->setRemoveUrl($this->getUrl('*/*/filter', array('action' => 'removeCustomer', 'id' => $i705fa7c9639d497e1179d7d5691c212668a8c9c8->getId())));
        }
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2->setCollection($iff7e46827cbb6547116c592bf800f4687428abf9);
        return $i8ee45e0018a32fb1a855b82624506e35789cc4d2;
    }

    protected function _getCollection()
    {
        $iff7e46827cbb6547116c592bf800f4687428abf9 = Mage::helper('magesms')->getCustomerCollection();
        $iff7e46827cbb6547116c592bf800f4687428abf9->addAttributeToSelect('magesms_customer_marketing');
        return $iff7e46827cbb6547116c592bf800f4687428abf9;
    }

    protected function _initAction()
    {
        parent::_initAction();
        $this->_setActiveMenu('magesms/marketing')->_title(Mage::helper('magesms')->__('Marketing SMS'));
        $i3358fd35282548f1f8ccafbf23d60a4ade466fd3 = '
			Translator.add("Filter has been applied.", "' . $this->__('Filter has been applied.') . '");
			Translator.add("Filter has been saved.", "' . $this->__('Filter has been saved.') . '");
			Translator.add("Are you sure you want to reset the filter?", "' . $this->__('Are you sure you want to reset the filter?') . '");
			Translator.add("Are you sure you want to remove the filter?", "' . $this->__('Are you sure you want to remove the filter?') . '");
			Translator.add("Filter has been reset.", "' . $this->__('Filter has been reset.') . '");
		';
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2 = $this->getLayout()->createBlock('core/text', 'marketing')->setText(Mage::helper('adminhtml/media_js')->getScript($i3358fd35282548f1f8ccafbf23d60a4ade466fd3));
        $this->_addContent($i8ee45e0018a32fb1a855b82624506e35789cc4d2);
        return $this;
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('magesms/marketing');
    }
}