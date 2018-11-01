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
class Topefekt_Magesms_Adminhtml_Magesms_WizardController extends Topefekt_Magesms_Controller_Action
{
    public $confirmsms;

    protected function _construct()
    {
        parent::_construct();
        $this->confirmsms = Mage::helper('magesms')->__('Confirmation code: ');
    }

    public function indexAction()
    {
        $this->_initAction();
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2 = $this->getLayout()->createBlock('Topefekt_Magesms_Block_Template', 'my_block_name_here', array('template' => 'topefekt/magesms/wizard.phtml'));
        $this->getLayout()->getBlock('content')->append($i8ee45e0018a32fb1a855b82624506e35789cc4d2);
        $this->renderLayout();
        if (!Mage::app()->loadCache('magesms_pricelist_update') || Mage::app()->loadCache('magesms_pricelist_update') != date('Y-m-d')) {
            Mage::app()->saveCache(date('Y-m-d'), 'magesms_pricelist_update');
            $this->updatepricelistAction();
        }
        return $this;
    }

    public function editAction()
    {
        $ia118aa93019887b74fdff43dbcf59dce271cae7d = $this->getRequest()->getParam('country0');
        $i30f20aafde612a957f7f966cb5b85e35782bc88a = $this->getRequest()->getParam('type');
        $i4d3f3bffcd16d5910b26a4511d33ad3b5e4c61d4 = true;
        if ($ia118aa93019887b74fdff43dbcf59dce271cae7d && $i30f20aafde612a957f7f966cb5b85e35782bc88a) {
            $i037b855bc01175f2c77d5c3e19eda9a0003feff4 = Mage::getSingleton('magesms/country_area')->getCollection()->addFilter('country_name', $ia118aa93019887b74fdff43dbcf59dce271cae7d);
            if ($i037b855bc01175f2c77d5c3e19eda9a0003feff4->count()) {
                $ia61712c27ea241bd7a543dc2b02ea572274d0322 = 'action=dost&username=' . urlencode($this->profile->user->user) . '&password=' . urlencode($this->profile->user->passwd) . '&area=' . urlencode($i037b855bc01175f2c77d5c3e19eda9a0003feff4->getFirstItem()->getArea()) . '&currency=' . urlencode($this->profile->currency);
                $i55dd4e7042a1f9031b84f07f04c37165ce3d0720 = Mage::getModel('magesms/api')->serverPost($ia61712c27ea241bd7a543dc2b02ea572274d0322);
                if ($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] == 1 && !empty($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['data'])) {
                    $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec = Mage::getModel('magesms/routes');
                    $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->setInfo($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['datasrc']);
                    $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->setArea($i037b855bc01175f2c77d5c3e19eda9a0003feff4->getFirstItem()->getArea());
                    $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->setType($i30f20aafde612a957f7f966cb5b85e35782bc88a);
                    $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->setAreaText($ia118aa93019887b74fdff43dbcf59dce271cae7d);
                    Mage::register('routes', $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec);
                } else {
                    $i4d3f3bffcd16d5910b26a4511d33ad3b5e4c61d4 = false;
                }
            } else {
                $i4d3f3bffcd16d5910b26a4511d33ad3b5e4c61d4 = false;
            }
        }
        if ($i4d3f3bffcd16d5910b26a4511d33ad3b5e4c61d4) {
            $this->_initAction();
            $i8ee45e0018a32fb1a855b82624506e35789cc4d2 = $this->getLayout()->createBlock('Topefekt_Magesms_Block_Template', 'my_block_name_here', array('template' => 'topefekt/magesms/wizard-edit.phtml'));
            $this->getLayout()->getBlock('content')->append($i8ee45e0018a32fb1a855b82624506e35789cc4d2);
            $this->renderLayout();
            return $this;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find a Route to load.'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538 = $this->getRequest()->getParam('id')) {
            try {
                $ice10b700e3771fcda63608142bce93b608228583 = Mage::getModel('magesms/routes')->load($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538);
                $ice10b700e3771fcda63608142bce93b608228583->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($ice10b700e3771fcda63608142bce93b608228583->getAreaText() . $this->__(' was deleted.'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $i8c174347956f0a76258a09557543e84f88beb4a0) {
                Mage::getSingleton('adminhtml/session')->addError($this->__($i8c174347956f0a76258a09557543e84f88beb4a0->getMessage()));
                $this->_redirect('*/*/');
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find a Route to delete.'));
        $this->_redirect('*/*/');
    }

    public function addcountrycustomerAction()
    {
        $this->getRequest()->setParam('type', 'customer');
        $this->addcountryAction();
    }

    public function addcountryadminAction()
    {
        $this->getRequest()->setParam('type', 'admin');
        $this->addcountryAction();
    }

    public function addcountryAction()
    {
        $ia118aa93019887b74fdff43dbcf59dce271cae7d = $this->getRequest()->getParam('country0');
        $i30f20aafde612a957f7f966cb5b85e35782bc88a = $this->getRequest()->getParam('type');
        if ($ia118aa93019887b74fdff43dbcf59dce271cae7d && $i30f20aafde612a957f7f966cb5b85e35782bc88a) {
            try {
                $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec = Mage::getSingleton('magesms/routes')->getCollection();
                $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->addFilter('area_text', $ia118aa93019887b74fdff43dbcf59dce271cae7d)->addFilter('type', $i30f20aafde612a957f7f966cb5b85e35782bc88a);
                if ($ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->count()) {
                    $i7d411c0cc32cdb65ec82b9e8d79aa996946f5538 = $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->getFirstItem()->getId();
                    $this->_redirect('*/*/edit', array('id' => $i7d411c0cc32cdb65ec82b9e8d79aa996946f5538));
                    return;
                }
                $this->_redirect('*/*/edit', array('country0' => $ia118aa93019887b74fdff43dbcf59dce271cae7d, 'type' => $i30f20aafde612a957f7f966cb5b85e35782bc88a, 'id' => 0));
                return;
            } catch (Exception $i8c174347956f0a76258a09557543e84f88beb4a0) {
                Mage::getSingleton('adminhtml/session')->addError($this->__($i8c174347956f0a76258a09557543e84f88beb4a0->getMessage()));
                $this->_redirect('*/*/');
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find a Route to load.'));
        $this->_redirect('*/*/');
    }

    public function addrouteAction()
    {
        if (Mage::getSingleton('adminhtml/session')->hasData('routes')) {
            $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec = Mage::getSingleton('adminhtml/session')->getData('routes');
            $this->_redirect('*/*/addroutesender');
        } else {
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::getSingleton('adminhtml/session')->getData('routesuccess') . $this->__(' was saved.'));
            Mage::getSingleton('adminhtml/session')->unsetData('routesuccess');
            $this->_redirect('*/*/index');
        }
    }

    public function addroutesenderAction()
    {
        if (Mage::getSingleton('adminhtml/session')->hasData('routes')) {
            $this->_initAction();
            $i8ee45e0018a32fb1a855b82624506e35789cc4d2 = $this->getLayout()->createBlock('Topefekt_Magesms_Block_Template', 'my_block_name_here', array('template' => 'topefekt/magesms/wizard-sender.phtml'));
            $this->getLayout()->getBlock('content')->append($i8ee45e0018a32fb1a855b82624506e35789cc4d2);
            $this->renderLayout();
            return $this;
        } else {
            $this->_redirect('*/*/index');
        }
    }

    public function validateAction($i5ba2c5364d6756af3701b475c0706df889a2545f = false)
    {
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e = new Varien_Object();
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setError(false);
        if ($this->getRequest()->getPost()) {
            try {
                $iacbd1c78463510856e506611fe14b5e1173581a6 = Mage::app()->getRequest();
                $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec = Mage::getModel('magesms/routes');
                if ($iacbd1c78463510856e506611fe14b5e1173581a6->getPost('id')) {
                    $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->load($iacbd1c78463510856e506611fe14b5e1173581a6->getPost('id'));
                }
                $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->setArea($iacbd1c78463510856e506611fe14b5e1173581a6->getPost('area'));
                $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->setAreaText($iacbd1c78463510856e506611fe14b5e1173581a6->getPost('country0'));
                $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->setType($iacbd1c78463510856e506611fe14b5e1173581a6->getPost('type'));
                $iecc25823227283479c5811005734b6ee2bd56071 = explode(';', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('isms'));
                $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->setIsms($iecc25823227283479c5811005734b6ee2bd56071[0]);
                $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->setSendertype($iecc25823227283479c5811005734b6ee2bd56071[1]);
                $ibdd27a8dd714410289189d318feb96fe6ed8e07f = $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->validate();
                if (is_array($ibdd27a8dd714410289189d318feb96fe6ed8e07f) && sizeof($ibdd27a8dd714410289189d318feb96fe6ed8e07f)) {
                    Mage::throwException(implode('<br />', $ibdd27a8dd714410289189d318feb96fe6ed8e07f));
                } else {
                    if ($i5ba2c5364d6756af3701b475c0706df889a2545f === true) {
                        $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->save();
                    } else {
                        if ($ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->getSendertype() == Topefekt_Magesms_Model_Routes::SENDER_SYSTEM || $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->getSendertype() == Topefekt_Magesms_Model_Routes::SENDER_SIM) {
                            $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->setData('senderID', '');
                            $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->save();
                            Mage::getSingleton('adminhtml/session')->unsetData('routes');
                            Mage::getSingleton('adminhtml/session')->setData('routesuccess', $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->getAreaText());
                        } else {
                            Mage::getSingleton('adminhtml/session')->setData('routes', $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec);
                        }
                    }
                }
            } catch (Exception $i8c174347956f0a76258a09557543e84f88beb4a0) {
                Mage::getSingleton('adminhtml/session')->addError($i8c174347956f0a76258a09557543e84f88beb4a0->getMessage());
                $this->_initLayoutMessages('adminhtml/session');
                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setError(true);
                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setMessage($this->getLayout()->getMessagesBlock()->getGroupedHtml());
            }
        }
        $this->getResponse()->setBody($ia1a238c1f12f3901520c7ca55efa646e471f7f6e->toJson());
    }

    public function validatesenderAction()
    {
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e = new Varien_Object();
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setError(false);
        if ($this->getRequest()->getPost()) {
            try {
                $iacbd1c78463510856e506611fe14b5e1173581a6 = Mage::app()->getRequest();
                $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec = Mage::getSingleton('adminhtml/session')->getData('routes');
                if ($ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->displayCode !== true) {
                    $i1b3f50fe6674f47cc7c1967f93ff153879178f04 = trim(($i51c6d8e5b3a92b4b73711680253408ec6d3d25f6 = $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('sender')) ? $i51c6d8e5b3a92b4b73711680253408ec6d3d25f6 : $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('newsender'));
                    $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->setData('senderID', $i1b3f50fe6674f47cc7c1967f93ff153879178f04);
                } else {
                    $id3e549697752385571e09ffe4add9278d2d6923b = $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('code');
                    $i1b3f50fe6674f47cc7c1967f93ff153879178f04 = $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->getData('senderID');
                }
                $ibdd27a8dd714410289189d318feb96fe6ed8e07f = $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->validate(true);
                if (is_array($ibdd27a8dd714410289189d318feb96fe6ed8e07f) && sizeof($ibdd27a8dd714410289189d318feb96fe6ed8e07f)) {
                    Mage::throwException(implode('<br />', $ibdd27a8dd714410289189d318feb96fe6ed8e07f));
                } else {
                    $i47f954bfb9dd4be93a5c46b2c8260d3fbc064235 = Mage::getModel('core/resource_transaction')->addObject($ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec);
                    if ($ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->getSendertype() == Topefekt_Magesms_Model_Routes::SENDER_OWN) {
                        $i451f679eaafeecb81387b150019f0d9e0fa83d16 = Mage::getModel('magesms/api');
                        if ($ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->displayCode !== true) {
                            $i74c7f58458d186850e8386ae20067ea0a7958311 = $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->getGate($i1b3f50fe6674f47cc7c1967f93ff153879178f04, 'admin');
                            $i9e1925546463c5a41ccbc625ed973556cc86a495 = '';
                            if (!$i74c7f58458d186850e8386ae20067ea0a7958311->isEmpty()): $i9e1925546463c5a41ccbc625ed973556cc86a495 = base64_decode("JmlzbXM9") . urlencode($i74c7f58458d186850e8386ae20067ea0a7958311->getIsms()) . base64_decode("JnNlbmRlcj0=") . urlencode($i74c7f58458d186850e8386ae20067ea0a7958311->getData('senderID')); endif;
                            $ia61712c27ea241bd7a543dc2b02ea572274d0322 = "action=checksenderID&text_sms=" . urlencode($this->confirmsms) . base64_decode("JnVzZXJuYW1lPQ==") . urlencode($this->profile->user->user) . base64_decode("JnBhc3N3b3JkPQ==") . urlencode($this->profile->user->passwd) . base64_decode("JnNlbmRlcklEPQ==") . urlencode($i1b3f50fe6674f47cc7c1967f93ff153879178f04) . $i9e1925546463c5a41ccbc625ed973556cc86a495;
                            $ia61712c27ea241bd7a543dc2b02ea572274d0322 = $i451f679eaafeecb81387b150019f0d9e0fa83d16->serverPost($ia61712c27ea241bd7a543dc2b02ea572274d0322);
                            if (in_array($ia61712c27ea241bd7a543dc2b02ea572274d0322['errno'], array(1, 11))) {
                                $i5ee2fa256ff77dd811a9c1911f7563263a694e4b = Mage::getSingleton('magesms/smshistory');
                                $i5ee2fa256ff77dd811a9c1911f7563263a694e4b->setNumber('+' . $i1b3f50fe6674f47cc7c1967f93ff153879178f04);
                                $i5ee2fa256ff77dd811a9c1911f7563263a694e4b->setDate(date('Y-m-d h:i:s', Mage::getModel('core/date')->timestamp(time())));
                                $i5ee2fa256ff77dd811a9c1911f7563263a694e4b->setText($this->confirmsms);
                                $i5ee2fa256ff77dd811a9c1911f7563263a694e4b->setStatus(1);
                                list($ie10d5ed46013be2962a9d08e0e1912a9c56891b4, $i58457975a91d59a84d2920953badcb7365ac1f01, $if928b7780c12c52495a2f84d8c183269cfcb7c63) = explode("__", $ia61712c27ea241bd7a543dc2b02ea572274d0322['datasrc']);
                                $i5ee2fa256ff77dd811a9c1911f7563263a694e4b->setPrice($i58457975a91d59a84d2920953badcb7365ac1f01);
                                $i5ee2fa256ff77dd811a9c1911f7563263a694e4b->setCredit($if928b7780c12c52495a2f84d8c183269cfcb7c63);
                                $i5ee2fa256ff77dd811a9c1911f7563263a694e4b->setSender($i74c7f58458d186850e8386ae20067ea0a7958311->getData('senderID'));
                                $i5ee2fa256ff77dd811a9c1911f7563263a694e4b->setUnicode(0);
                                $i5ee2fa256ff77dd811a9c1911f7563263a694e4b->setType(Topefekt_Magesms_Model_Sms::TYPE_ADMIN);
                                $i5ee2fa256ff77dd811a9c1911f7563263a694e4b->setSmsid($ie10d5ed46013be2962a9d08e0e1912a9c56891b4);
                                $i5ee2fa256ff77dd811a9c1911f7563263a694e4b->setTotal(1);
                                $i5ee2fa256ff77dd811a9c1911f7563263a694e4b->save();
                                $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->displayCode = true;
                                Mage::getSingleton('adminhtml/session')->setData('routes', $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec);
                            } elseif ($ia61712c27ea241bd7a543dc2b02ea572274d0322['errno'] == 111) {
                            } elseif ($ia61712c27ea241bd7a543dc2b02ea572274d0322['errno'] == 3 && $ia61712c27ea241bd7a543dc2b02ea572274d0322['error'] == 9) {
                                Mage::throwException(Mage::helper('magesms')->__('error - wrong number or unavailable'));
                            } elseif ($ia61712c27ea241bd7a543dc2b02ea572274d0322['errno'] == 3 && $ia61712c27ea241bd7a543dc2b02ea572274d0322['error'] == 10) {
                                Mage::throwException(Mage::helper('magesms')->__('error - low credit for sending validation SMS'));
                            } elseif ($ia61712c27ea241bd7a543dc2b02ea572274d0322['errno'] == 3 && $ia61712c27ea241bd7a543dc2b02ea572274d0322['error'] == 15) {
                                Mage::throwException(Mage::helper('magesms')->__('error - unauthorized senderID in confirmation sms'));
                            } elseif ($ia61712c27ea241bd7a543dc2b02ea572274d0322['errno'] == 3) {
                                Mage::throwException(Mage::helper('magesms')->__('error - ' . $ia61712c27ea241bd7a543dc2b02ea572274d0322['error']));
                            } elseif ($ia61712c27ea241bd7a543dc2b02ea572274d0322['errno'] == 4) {
                                Mage::throwException(Mage::helper('magesms')->__('login error'));
                            } else {
                                Mage::throwException(Mage::helper('magesms')->__('can not connect to SMS server') . ' ' . $ia61712c27ea241bd7a543dc2b02ea572274d0322['error']);
                            }
                        } else {
                            $ia61712c27ea241bd7a543dc2b02ea572274d0322 = "action=checksenderIDcode&username=" . urlencode($this->profile->user->user) . base64_decode("JnBhc3N3b3JkPQ==") . urlencode($this->profile->user->passwd) . base64_decode("JmNvZGU9") . urlencode($id3e549697752385571e09ffe4add9278d2d6923b) . base64_decode("JnNlbmRlcklEPQ==") . urlencode($ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->getData('senderID'));
                            $ia61712c27ea241bd7a543dc2b02ea572274d0322 = $i451f679eaafeecb81387b150019f0d9e0fa83d16->serverPost($ia61712c27ea241bd7a543dc2b02ea572274d0322);
                            if ($ia61712c27ea241bd7a543dc2b02ea572274d0322['errno'] == 1) {
                                $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->displayCode = false;
                            } elseif ($ia61712c27ea241bd7a543dc2b02ea572274d0322['errno'] == 3) {
                                Mage::throwException(Mage::helper('magesms')->__('error - ') . $ia61712c27ea241bd7a543dc2b02ea572274d0322['error']);
                            } elseif ($ia61712c27ea241bd7a543dc2b02ea572274d0322['errno'] == 4) {
                                Mage::throwException(Mage::helper('magesms')->__('login error'));
                            } elseif ($ia61712c27ea241bd7a543dc2b02ea572274d0322['errno'] == 5) {
                                Mage::throwException(Mage::helper('magesms')->__('correctly confirm sms code'));
                            } else {
                                Mage::throwException(Mage::helper('magesms')->__('can not connect to SMS server'));
                            }
                        }
                        $i2e5aa867ea7c6f8ed9ffffe56b63b837364669dd = 'ownnumbersender';
                    } else {
                        $i2e5aa867ea7c6f8ed9ffffe56b63b837364669dd = 'textsender';
                    }
                    if ($ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->displayCode !== true) {
                        $i5b2de9a29c087ac444f7af969b9863250e38aa27 = Mage::getSingleton('magesms/' . $i2e5aa867ea7c6f8ed9ffffe56b63b837364669dd)->getCollection()->addFilter('val', $i1b3f50fe6674f47cc7c1967f93ff153879178f04)->getFirstItem();
                        $i0a2378e8d343fdb890a9c568b07c541a35a12341 = Mage::getSingleton('magesms/' . $i2e5aa867ea7c6f8ed9ffffe56b63b837364669dd)->load($i5b2de9a29c087ac444f7af969b9863250e38aa27->getId())->setVal($i1b3f50fe6674f47cc7c1967f93ff153879178f04);
                        $i47f954bfb9dd4be93a5c46b2c8260d3fbc064235->addObject($i0a2378e8d343fdb890a9c568b07c541a35a12341)->save();
                        Mage::getSingleton('adminhtml/session')->unsetData('routes');
                        if ($i2e5aa867ea7c6f8ed9ffffe56b63b837364669dd == 'textsender') {
                            Mage::getSingleton('adminhtml/session')->setData('routesuccess', $this->__('Text sender ID for ') . $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->getAreaText() . $this->__(' was saved.'));
                        } else {
                            Mage::getSingleton('adminhtml/session')->setData('routesuccess', $this->__('Own number sender ID for ') . $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->getAreaText() . $this->__(' was saved.'));
                        }
                    }
                }
            } catch (Exception $i8c174347956f0a76258a09557543e84f88beb4a0) {
                Mage::getSingleton('adminhtml/session')->addError($i8c174347956f0a76258a09557543e84f88beb4a0->getMessage());
                $this->_initLayoutMessages('adminhtml/session');
                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setError(true);
                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setMessage($this->getLayout()->getMessagesBlock()->getGroupedHtml());
            }
        }
        $this->getResponse()->setBody($ia1a238c1f12f3901520c7ca55efa646e471f7f6e->toJson());
    }

    public function savesenderAction()
    {
        if (Mage::getSingleton('adminhtml/session')->hasData('routes')) {
            $this->_redirect('*/*/addroutesender');
        } else {
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::getSingleton('adminhtml/session')->getData('routesuccess'));
            Mage::getSingleton('adminhtml/session')->unsetData('routesuccess');
            $this->_redirect('*/*/index');
        }
    }

    public function updatepricelistAction()
    {
        $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec = Mage::getSingleton('magesms/routes')->updatepricelist($this->profile->currency);
        Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Pricelist was successfully updated.'));
        $this->_redirect('*/*/index');
    }

    public function alternativeAction()
    {
        $this->_initAction();
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2 = $this->getLayout()->createBlock('Topefekt_Magesms_Block_Template', 'my_block_name_here', array('template' => 'topefekt/magesms/wizard-alternative.phtml'));
        $i7d411c0cc32cdb65ec82b9e8d79aa996946f5538 = $this->getRequest()->getParam('id');
        $ice10b700e3771fcda63608142bce93b608228583 = Mage::getModel('magesms/routes')->load($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538);
        if ($ice10b700e3771fcda63608142bce93b608228583->getSendertype() == Topefekt_Magesms_Model_Routes::SENDER_TEXT) {
            $i8ee45e0018a32fb1a855b82624506e35789cc4d2->setRoute($ice10b700e3771fcda63608142bce93b608228583);
            $ie7d1444276fe9dee937fd96d6e0519397fdc5701 = Mage::getModel('core/store_group')->getCollection()->setLoadDefault(false);
            $i9bd2c88ca2206122845c5e189e2b6856a2409e3a = Mage::getModel('magesms/routes_alternative')->getCollection()->addFieldToFilter('route_id', $ice10b700e3771fcda63608142bce93b608228583->getId());
            foreach ($ie7d1444276fe9dee937fd96d6e0519397fdc5701 as $i7079b107a03c03d74ad14b853dad74b85b2d25d1) {
                $i7079b107a03c03d74ad14b853dad74b85b2d25d1->setTextsender($ice10b700e3771fcda63608142bce93b608228583->getData('senderID'));
                foreach ($i9bd2c88ca2206122845c5e189e2b6856a2409e3a as $ida3b491904fb073f446bf820cd55a0ff69b347d1) {
                    if ($ida3b491904fb073f446bf820cd55a0ff69b347d1->getStoreGroupId() == $i7079b107a03c03d74ad14b853dad74b85b2d25d1->getId()) {
                        $i7079b107a03c03d74ad14b853dad74b85b2d25d1->setTextsenderAlternative($ida3b491904fb073f446bf820cd55a0ff69b347d1->getTextsender());
                        break;
                    }
                }
            }
            $i8ee45e0018a32fb1a855b82624506e35789cc4d2->setStores($ie7d1444276fe9dee937fd96d6e0519397fdc5701);
            $this->getLayout()->getBlock('content')->append($i8ee45e0018a32fb1a855b82624506e35789cc4d2);
            $this->renderLayout();
            return $this;
        }
        $this->_redirect('*/*/index');
    }

    public function validatesenderalternativeAction()
    {
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e = new Varien_Object();
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setError(false);
        if ($this->getRequest()->getPost()) {
            $i75cfaf6baf7d451ab67af9aeef048aecfea24a82 = Mage::getModel('core/resource_transaction');
            try {
                $iacbd1c78463510856e506611fe14b5e1173581a6 = Mage::app()->getRequest();
                $i9bd2c88ca2206122845c5e189e2b6856a2409e3a = Mage::getModel('magesms/routes_alternative')->getCollection()->addFieldToFilter('route_id', $this->getRequest()->getParam('id'));
                $if2edf17aeebbb7b610065024e328c82ec7b37bbe = $iacbd1c78463510856e506611fe14b5e1173581a6->getParam('store_group');
                $ice10b700e3771fcda63608142bce93b608228583 = Mage::getModel('magesms/routes')->load($this->getRequest()->getParam('id'));
                foreach ($i9bd2c88ca2206122845c5e189e2b6856a2409e3a as $ida3b491904fb073f446bf820cd55a0ff69b347d1) {
                    $if433319f9b66f967b64d332ee0b51bea06276d26 = false;
                    foreach ($if2edf17aeebbb7b610065024e328c82ec7b37bbe as $i3bf172bc34c83f4a18624b192bc0bd7c4d647a66 => $i340682ca0ed5a64e8ea449191da847abaf0aec6f) {
                        if ($ida3b491904fb073f446bf820cd55a0ff69b347d1->getStoreGroupId() == $i3bf172bc34c83f4a18624b192bc0bd7c4d647a66) {
                            $if433319f9b66f967b64d332ee0b51bea06276d26 = true;
                            if ($ida3b491904fb073f446bf820cd55a0ff69b347d1->getTextsender() != $i340682ca0ed5a64e8ea449191da847abaf0aec6f || $ice10b700e3771fcda63608142bce93b608228583->getData('senderID') == $i340682ca0ed5a64e8ea449191da847abaf0aec6f) {
                                if (!$i340682ca0ed5a64e8ea449191da847abaf0aec6f || $ice10b700e3771fcda63608142bce93b608228583->getData('senderID') == $i340682ca0ed5a64e8ea449191da847abaf0aec6f) {
                                    $ida3b491904fb073f446bf820cd55a0ff69b347d1->isDeleted(true);
                                } else {
                                    $ida3b491904fb073f446bf820cd55a0ff69b347d1->setTextsender($i340682ca0ed5a64e8ea449191da847abaf0aec6f);
                                }
                            }
                            unset($if2edf17aeebbb7b610065024e328c82ec7b37bbe[$i3bf172bc34c83f4a18624b192bc0bd7c4d647a66]);
                            break;
                        }
                    }
                    if ($if433319f9b66f967b64d332ee0b51bea06276d26 !== true) $ida3b491904fb073f446bf820cd55a0ff69b347d1->isDeleted(true);
                    $i75cfaf6baf7d451ab67af9aeef048aecfea24a82->addObject($ida3b491904fb073f446bf820cd55a0ff69b347d1);
                }
                foreach ($if2edf17aeebbb7b610065024e328c82ec7b37bbe as $i3bf172bc34c83f4a18624b192bc0bd7c4d647a66 => $i340682ca0ed5a64e8ea449191da847abaf0aec6f) {
                    if ($ice10b700e3771fcda63608142bce93b608228583->getData('senderID') == $i340682ca0ed5a64e8ea449191da847abaf0aec6f) continue;
                    $ida3b491904fb073f446bf820cd55a0ff69b347d1 = Mage::getModel('magesms/routes_alternative');
                    $ida3b491904fb073f446bf820cd55a0ff69b347d1->setRouteId($this->getRequest()->getParam('id'));
                    $ida3b491904fb073f446bf820cd55a0ff69b347d1->setStoreGroupId($i3bf172bc34c83f4a18624b192bc0bd7c4d647a66);
                    $ida3b491904fb073f446bf820cd55a0ff69b347d1->setTextsender($i340682ca0ed5a64e8ea449191da847abaf0aec6f);
                    $i75cfaf6baf7d451ab67af9aeef048aecfea24a82->addObject($ida3b491904fb073f446bf820cd55a0ff69b347d1);
                }
                $i75cfaf6baf7d451ab67af9aeef048aecfea24a82->save();
            } catch (Exception $i8c174347956f0a76258a09557543e84f88beb4a0) {
                Mage::getSingleton('adminhtml/session')->addError($i8c174347956f0a76258a09557543e84f88beb4a0->getMessage());
                $this->_initLayoutMessages('adminhtml/session');
                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setError(true);
                $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setMessage($this->getLayout()->getMessagesBlock()->getGroupedHtml());
            }
        }
        $this->getResponse()->setBody($ia1a238c1f12f3901520c7ca55efa646e471f7f6e->toJson());
    }

    public function savesenderalternativeAction()
    {
        $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec = Mage::getModel('magesms/routes')->load($this->getRequest()->getParam('id'));
        Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Text sender ID for ') . $ie8b7b1b62dc29a284d794c9f11a8ee2ea7472eec->getAreaText() . $this->__(' was saved.'));
        $this->_redirect('*/*/index');
    }

    protected function _initAction()
    {
        parent::_initAction();
        $this->_setActiveMenu('magesms/wizard')->_title(Mage::helper('magesms')->__('SMS Settings'));
        return $this;
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('magesms/settings/wizard');
    }
}