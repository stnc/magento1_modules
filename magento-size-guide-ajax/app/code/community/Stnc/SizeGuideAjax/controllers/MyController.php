<?php
class Stnc_SizeGuideAjax_MyController extends Mage_Core_Controller_Front_Action
{

	/**
	 * bu kısım ajax ile gelen kontroller kısmıdır
	 * buraya gelen işlemler config.xml den devre dışı bıraklıldı
	 *
	 * */
    public function sizeAction()
    {
/* test içindir
        echo Mage::getStoreConfig('stnc/stnc_group/stnc_select',Mage::app()->getStore());;
        echo
        echo Mage::getStoreConfig('stnc/stnc_group/stnc_input_BlockName',Mage::app()->getStore());;
*/


//run

    //   $blockID= Mage::getStoreConfig('stnc/stnc_group/stnc_inputBlockid',Mage::app()->getStore());;
      //  echo $this->getLayout()->createBlock('cms/block')->setBlockId($blockID)->toHtml();


    }
}