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
class Topefekt_Magesms_Adminhtml_Magesms_SendsmsController extends Topefekt_Magesms_Controller_Template_Action
{
    public function indexAction()
    {

        $this->_initAction();
        $blockNAme = $this->getLayout()->createBlock('Topefekt_Magesms_Block_Template', 'my_block_name_here', array('template' => 'topefekt/magesms/sendsms.phtml'));
        $id42c5963b49dec2d3a886ec5045e3b8e035c239f = '{shop_name}, {shop_domain}, {shop_email}, {shop_phone}';
        $blockNAme->setNotice($id42c5963b49dec2d3a886ec5045e3b8e035c239f);
        $blockNAme->setTranslate(Mage::helper('magesms')->hookVariablesJS($id42c5963b49dec2d3a886ec5045e3b8e035c239f));
        if (!Mage::app()->isSingleStoreMode()) {
            $ie7d1444276fe9dee937fd96d6e0519397fdc5701 = array(0 => array('value' => 0, 'label' => Mage::helper('adminhtml')->__('Default Config')));
            foreach (Mage::app()->getWebsites(false) as $i9fdb3b1e2e6984ebdd1220ec199279013c5483fc) {
                $ie7d1444276fe9dee937fd96d6e0519397fdc5701[$i9fdb3b1e2e6984ebdd1220ec199279013c5483fc->getId()] = array('value' => array(), 'label' => $i9fdb3b1e2e6984ebdd1220ec199279013c5483fc->getName());
                foreach ($i9fdb3b1e2e6984ebdd1220ec199279013c5483fc->getStores() as $i7079b107a03c03d74ad14b853dad74b85b2d25d1) {
                    $ie7d1444276fe9dee937fd96d6e0519397fdc5701[$i9fdb3b1e2e6984ebdd1220ec199279013c5483fc->getId()]['value'][] = array('value' => $i7079b107a03c03d74ad14b853dad74b85b2d25d1->getId(), 'label' => $i7079b107a03c03d74ad14b853dad74b85b2d25d1->getName());
                }
            }
            $i1791b2d1f89bb2bd83b34046f59125af207713db = new Varien_Data_Form();
            $i1791b2d1f89bb2bd83b34046f59125af207713db->addField('store', 'select', array('label' => $this->__('Store:'), 'name' => 'store', 'values' => $ie7d1444276fe9dee937fd96d6e0519397fdc5701,));
            $blockNAme->setSelectStore($i1791b2d1f89bb2bd83b34046f59125af207713db->getHtml());
        }
        $this->getLayout()->getBlock('content')->append($blockNAme);
        $this->renderLayout();
        return $this;
    }

    public function sendAction()
    {

        if ($this->getRequest()->getPost()) {
            try {
              //  Mage::getModel('magesms/observer')->cronUpdate();
                $PostDizisi = Mage::app()->getRequest();
                $GonderilenMesaj = $this->_prepareText($PostDizisi->getPost('text'), $PostDizisi->getPost('store'));
                $GonderilenMesaj = $PostDizisi->getPost('text');
                $post_unicode = $PostDizisi->getPost('unicode') ? true : false;
                $post_unique = $PostDizisi->getPost('unique') ? true : false;
                $post_recipients = explode(',', $PostDizisi->getPost('recipients'));

                if (!empty($_FILES['sms_file']['tmp_name']) && is_uploaded_file($_FILES['sms_file']['tmp_name'])) {
                    $text_tipi = array('application/vnd.ms-excel', 'text/plain', 'text/csv', 'text/tsv');
                    $CardTipi = array('text/vcard', 'text/x-vcard');
                    if (in_array($_FILES['sms_file']['type'], $text_tipi)) {
                        $post_recipients = array_merge($post_recipients, str_getcsv(file_get_contents($_FILES['sms_file']['tmp_name']), "\n"));
                    } elseif (in_array($_FILES['sms_file']['type'], $CardTipi)) {
                        $post_recipients = array_merge($post_recipients, preg_replace('/TEL;.*:/', '', preg_grep('/TEL;/', explode("\n", file_get_contents($_FILES['sms_file']['tmp_name'])))));
                    }
                }
                if (!$post_recipients) Mage::throwException(Mage::helper('magesms')->__('Recipients found: 0'));
                if (!$GonderilenMesaj) Mage::throwException(Mage::helper('magesms')->__('Fill in SMS text.'));
                $SqlKaydet = Mage::getModel('magesms/sms');
                $SqlKaydet->setRecipient($post_recipients)->setMessage($GonderilenMesaj)->setType(Topefekt_Magesms_Model_Sms::TYPE_SIMPLE)->setPriority(false)->setUnicode($post_unicode)->setUnique($post_unique);
                if ($PostDizisi->getPost('store')) {
                    $SqlKaydet->setStoreId($PostDizisi->getPost('store'));
                }
                if ($PostDizisi->getPost('sendlater') && $PostDizisi->getPost('datumodesl')) {
                    $datumodesl = $PostDizisi->getPost('datumodesl');
                    $datumodesl_hour = $PostDizisi->getPost('datumodesl_hour');
                    $datumodesl_min = $PostDizisi->getPost('datumodesl_min');
                    $datereal = $PostDizisi->getPost('datereal', 0);
                    $datumodesl = Mage::getModel('core/date')->gmtTimestamp(strtotime("$datumodesl $datumodesl_hour:$datumodesl_min:00") + 3600 * $datereal);
                    $SqlKaydet->setSendlater($datumodesl);
                }
                $SqlKaydet->send();
                $this->_redirect('*/*/index');
            } catch (Exception $exc_kontrol) {
                $this->_initAction();
                $blockNAme = $this->getLayout()->createBlock('Topefekt_Magesms_Block_Template', 'my_block_name_here', array('template' => 'topefekt/magesms/sendsms.phtml'));
                $this->getLayout()->getBlock('content')->append($blockNAme);
                Mage::getSingleton('adminhtml/session')->addError($exc_kontrol->getMessage());
                $this->renderLayout();
            }
        } else {
            $this->_redirect('*/*/index');
        }
        return $this;
    }

    public function loadCustomersAction()
    {
        $i4d3f3bffcd16d5910b26a4511d33ad3b5e4c61d4 = '';
        if ($this->getRequest()->getParams()) {
            $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2 = $this->getRequest();
            if ($i933cfa8bba921101c14f35998fc501e030c9db5b = $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('char')) {
                $i854b57231c05dbaa7f22331dbaed4152a402d2f1 = new Zend_Locale_Data();
                $i065c883e3f45e58104d21f8196ee3fe9bd2f513d = $i854b57231c05dbaa7f22331dbaed4152a402d2f1->getList('en-EN', 'phonetoterritory');
                $ibad8f78c098260b16424eb12ceee5f8336591d56 = Mage::helper('magesms')->getCustomerCollection();
                $ibad8f78c098260b16424eb12ceee5f8336591d56->addFieldToFilter('lastname', array('like' => $i933cfa8bba921101c14f35998fc501e030c9db5b . '%'));
                $ibad8f78c098260b16424eb12ceee5f8336591d56->addAttributeToSort('lastname', 'ASC');
                foreach ($ibad8f78c098260b16424eb12ceee5f8336591d56 as $i21e55df616c305955791876c1eb4da83448beba2) {
                    $i4d3f3bffcd16d5910b26a4511d33ad3b5e4c61d4 .= $i21e55df616c305955791876c1eb4da83448beba2->getLastname() . ', ' . $i21e55df616c305955791876c1eb4da83448beba2->getFirstname() . ';';
                    $id1caa2f79c0787a3e797d6d388cd6f00ced4282f = Mage::helper('magesms')->prepareNumber($i21e55df616c305955791876c1eb4da83448beba2->getTelephone(), 'customer', empty($i065c883e3f45e58104d21f8196ee3fe9bd2f513d[$i21e55df616c305955791876c1eb4da83448beba2->getCountryId()]) ? '' : $i065c883e3f45e58104d21f8196ee3fe9bd2f513d[$i21e55df616c305955791876c1eb4da83448beba2->getCountryId()]);
                    $i4d3f3bffcd16d5910b26a4511d33ad3b5e4c61d4 .= $id1caa2f79c0787a3e797d6d388cd6f00ced4282f['mobile'] . "\n";
                }
            }
        }
        $this->getResponse()->clearHeaders()->setHeader('Content-Type', 'text/html')->setBody($i4d3f3bffcd16d5910b26a4511d33ad3b5e4c61d4);
    }

    protected function _initAction()
    {
        parent::_initAction();
        $this->_setActiveMenu('magesms/sendsms')->_title(Mage::helper('magesms')->__('Send SMS'));
        return $this;
    }

    protected function _isAllowed()
    {
        return true;
    }
}