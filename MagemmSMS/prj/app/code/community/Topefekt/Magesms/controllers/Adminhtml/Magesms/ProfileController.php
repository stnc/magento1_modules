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
class Topefekt_Magesms_Adminhtml_Magesms_ProfileController extends Topefekt_Magesms_Controller_Action
{
    public function preDispatch()
    {
        return Mage_Adminhtml_Controller_Action::preDispatch();
    }

    public function indexAction()
    {

        $this->_initAction();
        $i8ee45e0018a32fb1a855b82624506e35789cc4d2 = $this->getLayout()->createBlock('Topefekt_Magesms_Block_Template', 'my_block_name_here', array('template' => 'topefekt/magesms/profile.phtml'));
        $this->getLayout()->getBlock('content')->append($i8ee45e0018a32fb1a855b82624506e35789cc4d2);
        $this->renderLayout();
        // if ($this->profile->user->user) Mage::getModel('magesms/observer')->cronUpdate();
        /*   if (Mage::app()->loadCache('magesms_update_available')) {
               Mage::getSingleton('adminhtml/session')->addNotice($this->__('New version available for download:') . ' ' . Mage::app()->loadCache('magesms_update_available'));
           }*/
        return $this;
    }

    public function loginAction()
    {
        $username = Mage::app()->getRequest()->getParam('username');
        $password = Mage::app()->getRequest()->getParam('password');
        $mageApi = Mage::getModel('magesms/api');
        $user_send_info = array('username' => $username, 'pass' => $password);
        $user_control = $mageApi->serverPost($user_send_info);

        if ($user_control->status != 1) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Şifreniz yada Kullanıcı adı yanlıştır Ayrıntılı HATA : '.$user_control->error));
        } else {
           /* $user_save = Mage::getModel('magesms/smsuser')->addData(array('user' => $username, 'passwd' => $password, 'email' => $user_control['data'][0], 'companyname' => $user_control['data'][1], 'regtype' => $user_control['data'][1] ? 'firm' : 'person', 'addressstreet' => $user_control['data'][2], 'addresscity' => $user_control['data'][3], 'addresszip' => $user_control['data'][4], 'companyid' => $user_control['data'][5], 'companyvat' => $user_control['data'][6], 'country0' => $user_control['data'][7], 'firstname' => $user_control['data'][8], 'lastname' => $user_control['data'][9]))->save();*/

            $user_save = Mage::getModel('magesms/smsuser')->addData(array('user' => $username, 'passwd' => $password))->save();

            Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Giriş Başarılı'));
        }
        $this->_redirect('*/*/');
    }

    public function validateAction()
    {
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e = new Varien_Object();
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setError(false);
        if ($this->getRequest()->getPost()) {
            try {
                $iacbd1c78463510856e506611fe14b5e1173581a6 = Mage::app()->getRequest();
                $this->profile->user->setData('email', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('email', ''));
                $this->profile->user->setData('addressstreet', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('addressstreet', ''));
                $this->profile->user->setData('addresszip', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('addresszip', ''));
                $this->profile->user->setData('addresscity', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('addresscity', ''));
                $this->profile->user->setData('country0', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('country0', ''));
                $this->profile->user->setData('regtype', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('regtype', ''));
                $this->profile->user->setData('firstname', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('firstname', ''));
                $this->profile->user->setData('lastname', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('lastname', ''));
                if ($this->profile->user->getRegtype() == 'firm') {
                    $this->profile->user->setData('companyname', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('companyname', ''));
                    $this->profile->user->setData('companyid', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('companyid', ''));
                    $this->profile->user->setData('companyvat', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('companyvat', ''));
                } else {
                    $this->profile->user->setData('companyname', '');
                    $this->profile->user->setData('companyid', '');
                    $this->profile->user->setData('companyvat', '');
                }
                $this->profile->user->setData('agree', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('agree', 0));
                $ibdd27a8dd714410289189d318feb96fe6ed8e07f = $this->profile->user->validate();
                if (is_array($ibdd27a8dd714410289189d318feb96fe6ed8e07f) && sizeof($ibdd27a8dd714410289189d318feb96fe6ed8e07f)) {
                    Mage::throwException(implode('<br />', $ibdd27a8dd714410289189d318feb96fe6ed8e07f));
                }
                if ($this->profile->user->user) {
                    $user_control = base64_decode("YWN0aW9uPWVkaXQmdXNlcm5hbWU9") . urlencode($this->profile->user->user) . base64_decode("JnBhc3N3b3JkPQ==") . urlencode($this->profile->user->passwd);
                } else {
                    $ie955ee51cd0c7df255b696081bc48b422055d462 = Mage::getConfig()->getNode('default/config/referer');
                    if ($ie955ee51cd0c7df255b696081bc48b422055d462) {
                        $ie955ee51cd0c7df255b696081bc48b422055d462 = $ie955ee51cd0c7df255b696081bc48b422055d462->id;
                    } else {
                        $ie955ee51cd0c7df255b696081bc48b422055d462 = $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('refererid', '');
                    }
                    $user_control = 'action=register&refererid=' . urlencode($ie955ee51cd0c7df255b696081bc48b422055d462) . '&';
                }
                $user_control .= base64_decode("JmVtYWlsPQ==") . urlencode($this->profile->user->email) . base64_decode("JmptZW5vPQ==") . urlencode($this->profile->user->companyname) . base64_decode("Jmtvc29iYT0=") . urlencode($this->profile->user->firstname) . base64_decode("JmtwcmlqbWVuaT0=") . urlencode($this->profile->user->lastname) . "&adresa_ulice=" . urlencode($this->profile->user->addressstreet) . "&adresa_mesto=" . urlencode($this->profile->user->addresscity) . "&adresa_PSC=" . urlencode($this->profile->user->addresszip) . "&country0=" . urlencode($this->profile->user->country0) . base64_decode("JklDTz0=") . urlencode($this->profile->user->companyid) . base64_decode("JkRJQz0=") . urlencode($this->profile->user->companyvat);


                $i55dd4e7042a1f9031b84f07f04c37165ce3d0720 = Mage::getSingleton('magesms/api')->serverPost($user_control);
                if ($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] != 1 || empty($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['data'])) {
                    if (is_array($ibdd27a8dd714410289189d318feb96fe6ed8e07f) && sizeof($ibdd27a8dd714410289189d318feb96fe6ed8e07f)) {
                        $ibdd27a8dd714410289189d318feb96fe6ed8e07f[] = Mage::helper('magesms')->__($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['error']);
                    } else {
                        $ibdd27a8dd714410289189d318feb96fe6ed8e07f = array(Mage::helper('magesms')->__($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['error']));
                    }
                } elseif (!$this->profile->user->user && $i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] == 1) {
                    $this->profile->user->setUser($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['data'][0]);
                    $this->profile->user->setPasswd($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['data'][1]);
                }
                if (is_array($ibdd27a8dd714410289189d318feb96fe6ed8e07f) && sizeof($ibdd27a8dd714410289189d318feb96fe6ed8e07f)) {
                    Mage::throwException(implode('<br />', $ibdd27a8dd714410289189d318feb96fe6ed8e07f));
                } else {
                    $i5bf407a3ecf35ff195a9c7e8f546cfc606253fad = $this->profile->user->getId();
                    $this->profile->user->save();
                    if ($i5bf407a3ecf35ff195a9c7e8f546cfc606253fad) Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Account was changed.')); else {
                        Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Account was created.'));
                        $ie2d3c964f264968835c26fc02ee0d5f0820fe0ce = Mage::app()->getDefaultStoreView()->getBaseUrl() . 'magesms/delivery';
                        $user_control = base64_decode("YWN0aW9uPWVkaXQyJnVzZXJuYW1lPQ==") . urlencode($this->profile->user->user) . base64_decode("JnBhc3N3b3JkPQ==") . urlencode($this->profile->user->passwd) . "&shop_domain=" . urlencode($ie2d3c964f264968835c26fc02ee0d5f0820fe0ce);
                        $i55dd4e7042a1f9031b84f07f04c37165ce3d0720 = Mage::getSingleton('magesms/api')->serverPost($user_control);
                        if ($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] != 99 || !empty($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['data'])) {
                            if ($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] == 1 || $i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] == 5) $this->profile->user->setData('URLreports', 1)->save();
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
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setError(false);
        $this->getResponse()->setBody($ia1a238c1f12f3901520c7ca55efa646e471f7f6e->toJson());
    }

    public function saveAction()
    {
        $this->_redirect('*/*/');
    }

    public function deleteadminAction()
    {
        if ($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538 = $this->getRequest()->getParam('id')) {
            try {
                $this->profile->admins->load($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Admin was deleted.'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $i8c174347956f0a76258a09557543e84f88beb4a0) {
                Mage::getSingleton('adminhtml/session')->addError($this->__($i8c174347956f0a76258a09557543e84f88beb4a0->getMessage()));
                $this->_redirect('*/*/');
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find a Admin to delete.'));
        $this->_redirect('*/*/');
    }

    public function saveadminAction()
    {
        $this->_redirect('*/*/');
    }

    public function validateadminAction()
    {
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e = new Varien_Object();
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setError(false);
        if ($this->getRequest()->getPost()) {
            try {
                $this->profile->admins->setData(Mage::app()->getRequest()->getPost());
                $i7d411c0cc32cdb65ec82b9e8d79aa996946f5538 = $this->getRequest()->getParam('id');
                if ($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538 > 0) {
                    $this->profile->admins->setId($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538);
                }
                $ibdd27a8dd714410289189d318feb96fe6ed8e07f = $this->profile->admins->validate();
                if (is_array($ibdd27a8dd714410289189d318feb96fe6ed8e07f) && sizeof($ibdd27a8dd714410289189d318feb96fe6ed8e07f)) {
                    Mage::throwException(implode('<br />', $ibdd27a8dd714410289189d318feb96fe6ed8e07f));
                } else {
                    $this->profile->admins->save();
                    if ($i7d411c0cc32cdb65ec82b9e8d79aa996946f5538) Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Admin was changed.')); else Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Admin was created.'));
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

    public function validatesettingsAction()
    {
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e = new Varien_Object();
        $ia1a238c1f12f3901520c7ca55efa646e471f7f6e->setError(false);
        if ($this->getRequest()->getPost()) {
            try {
                $iacbd1c78463510856e506611fe14b5e1173581a6 = Mage::app()->getRequest();
                $this->profile->user->setData('simulatesms', (int)$iacbd1c78463510856e506611fe14b5e1173581a6->getPost('simulatesms', 0));
                $this->profile->user->setData('deletedb', (int)$iacbd1c78463510856e506611fe14b5e1173581a6->getPost('deletedb', 0));
                $this->profile->user->setData('URLreports', (int)$iacbd1c78463510856e506611fe14b5e1173581a6->getPost('URLreports', 0));
                $this->profile->user->setData('pocetkredit', (int)$iacbd1c78463510856e506611fe14b5e1173581a6->getPost('pocetkredit', 0));
                $this->profile->user->setData('deliveryemail', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('deliveryemail', ''));
                $this->profile->user->setData('prefbilling', $iacbd1c78463510856e506611fe14b5e1173581a6->getPost('prefbilling', 0));
                $ibdd27a8dd714410289189d318feb96fe6ed8e07f = $this->profile->user->validate();
                $ie2d3c964f264968835c26fc02ee0d5f0820fe0ce = '';
                if ($this->profile->user->getData('URLreports')) {
                    $ie2d3c964f264968835c26fc02ee0d5f0820fe0ce = Mage::app()->getDefaultStoreView()->getBaseUrl() . 'magesms/delivery';
                }
                $user_control = base64_decode("YWN0aW9uPWVkaXQyJnVzZXJuYW1lPQ==") . urlencode($this->profile->user->user) . base64_decode("JnBhc3N3b3JkPQ==") . urlencode($this->profile->user->passwd) . "&shop_domain=" . urlencode($ie2d3c964f264968835c26fc02ee0d5f0820fe0ce) . base64_decode("JnBvY2V0a3JlZGl0PQ==") . urlencode($this->profile->user->pocetkredit) . base64_decode("JmVtYWlsPQ==") . urlencode($this->profile->user->deliveryemail);
                $i55dd4e7042a1f9031b84f07f04c37165ce3d0720 = Mage::getSingleton('magesms/api')->serverPost($user_control);
                if ($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] != 99 || !empty($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['data'])) {
                    if ($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] == 1 || $i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] == 5) {
                        Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Account was changed.'));
                    } elseif ($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] == 11) {
                        Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Account was changed, but module URL for DR does not answer.'));
                        $this->profile->user->setData('URLreports', 0);
                    } elseif ($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] == 3) {
                        $if3b1e2c1706de4c1bca112c669caba3a0420b880 = Mage::helper('magesms')->__('error');
                    } elseif ($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] == 4) {
                        $if3b1e2c1706de4c1bca112c669caba3a0420b880 = Mage::helper('magesms')->__('you can change account after ') . $i55dd4e7042a1f9031b84f07f04c37165ce3d0720['error'] . Mage::helper('magesms')->__(' seconds');
                    }
                } else {
                    $if3b1e2c1706de4c1bca112c669caba3a0420b880 = Mage::helper('magesms')->__('error');
                }
                if (!empty($if3b1e2c1706de4c1bca112c669caba3a0420b880) && is_array($ibdd27a8dd714410289189d318feb96fe6ed8e07f) && sizeof($ibdd27a8dd714410289189d318feb96fe6ed8e07f)) {
                    $ibdd27a8dd714410289189d318feb96fe6ed8e07f[] = $if3b1e2c1706de4c1bca112c669caba3a0420b880;
                } elseif (!empty($if3b1e2c1706de4c1bca112c669caba3a0420b880)) {
                    $ibdd27a8dd714410289189d318feb96fe6ed8e07f = array($if3b1e2c1706de4c1bca112c669caba3a0420b880);
                }
                if (is_array($ibdd27a8dd714410289189d318feb96fe6ed8e07f) && sizeof($ibdd27a8dd714410289189d318feb96fe6ed8e07f)) {
                    Mage::throwException(implode('<br />', $ibdd27a8dd714410289189d318feb96fe6ed8e07f));
                } else {
                    $this->profile->user->save();
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

    public function savesettingsAction()
    {
        $this->_redirect('*/*/');
    }

    public function vatvalidateAction()
    {
        $i4d3f3bffcd16d5910b26a4511d33ad3b5e4c61d4 = '';
        if ($this->getRequest()->getParams()) {
            $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2 = $this->getRequest();
            if ($i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('country') && $i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('companyvat')) {
                $user_control = 'action=checkVAT&country0=' . urlencode($i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('country')) . '&DIC=' . urlencode($i628d8ebfdcd1b4d13c7bb90cffb2f53678d994d2->getParam('companyvat'));
                $i55dd4e7042a1f9031b84f07f04c37165ce3d0720 = Mage::getSingleton('magesms/api')->serverPost($user_control);
                if ($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['errno'] == 1 && !empty($i55dd4e7042a1f9031b84f07f04c37165ce3d0720['data'])) {
                    $i4d3f3bffcd16d5910b26a4511d33ad3b5e4c61d4 = 'true';
                }
            }
        }
        $this->getResponse()->clearHeaders()->setHeader('Content-Type', 'text/html')->setBody($i4d3f3bffcd16d5910b26a4511d33ad3b5e4c61d4);
    }

    protected function _initAction()
    {
        parent::_initAction();
        $this->_setActiveMenu('magesms/profile')->_title(Mage::helper('magesms')->__('Edit user account'));;
        return $this;
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('magesms/settings/smsprofile');
    }
}