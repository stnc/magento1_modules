<?php

/**
 * Mageticaret Notification
 * @category    SMS / Notification
 * @package     Stnc_Promorule
 * @copyright   Copyright (c) 2018 Mageticaret (http://www.mageticaret.com/)
 * @author      selmantunc.com
 * @email       selmantunc@gmail.com
 * @version     Release: 1.0.0.0
 */
class Stnc_Prolist_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     *
     *
     * $_item = $this->getItem();
     * if($_item->getAppliedRuleIds()) {
     * $appliedRulesArray = explode(',',$_item->getAppliedRuleIds());
     * foreach($appliedRulesArray as $ruleId){
     * $rule = mage::getModel('salesrule/rule')->load($ruleId);
     * $name = $rule->getName();
     * }
     *
     * }
     * */
    public function indexAction()
    {
//https://gist.github.com/antoinekociuba/2408d8a7c52342c3930c
        //https://stackoverflow.com/questions/16360192/get-a-sale-rule-coupons
        /*
        $rules = Mage::getModel('salesrule/rule');

        foreach ($rules as $rule ){
            echo $description = $rule->getDescription();
            echo '<br>';
        }

        $class_methods = get_class_methods($rule);

        foreach ($class_methods as $method_name) {
            echo "$method_name\n";
        }
*/
        $rulesCollection = Mage::getModel('salesrule/rule')->getCollection();


        foreach ($rulesCollection as $rule) {
            //   echo  $coupon = $rule->getCode();
            //  echo  $coupon = $rule->getAmpromoType();
            echo "<div> ";

            echo $coupon = '<strong>Promosyon Adı</strong>  ' . $rule->getName();
            echo '<br>';
            echo $coupon = '<strong>ampromo Banner Açıklama </strong>' . $rule->getAmpromoTopBannerDescription();
            echo '<br>';
            echo $AmpromoType = '<strong>ampromo Promosyon tipi</strong> ' . $rule->getAmpromoType();
            echo '<br>';
            echo $AmpromoType = '<strong>getAmpromoType </strong>' . $rule->getAmpromoType();
            echo '<br>';
            echo $ampromo_min_price = ' <strong>ampromo min price </strong>' . $rule->getAmpromoMinPrice();
            echo '<br>';
            echo $use_discount_amount = '<strong>ampromo discount_amount</strong> ' . $rule->getAmpromoUseDiscountAmount();
            echo '<br>';
            echo $use_discount_amount = '<strong>ampromo ShowOrigPrice </strong>' . $rule->getAmpromoShowOrigPrice();
            echo '<br>';
            echo $use_discount_amount = '<strong> Ampromo Free Shipping </strong>' . $rule->getAmpromoFreeShipping();
            echo '<br>';
            echo $use_discount_amount = '<strong> ampromo top banner img </strong>' . $rule->getAmpromoTopBannerImg();
            echo '<br>';
            echo $use_discount_amount = '<strong> ampromo top banner alt </strong>' . $rule->getAmpromoTopBannerAlt();
            echo '<br>';
            echo $use_discount_amount = '<strong> ampromo TopBannerHoverTex</strong> ' . $rule->getAmpromoTopBannerHoverText();
            echo '<br>';
            echo $use_discount_amount = ' <strong>ampromo op_banner_link </strong>' . $rule->getAmpromoTopBannerLink();

            echo '<br>';
            echo $use_discount_amount = '<strong> ampromo_top_banner_gift_images</strong> ' . $rule->getAmpromoTopBannerGiftImages();
            echo '<br>';
            echo $use_discount_amount = ' <strong>ampromo_after_name_banner_description</strong> ' . $rule->getAmpromoAfterNameBannerDescription();
            echo '<br>';
            echo $use_discount_amount = ' <strong>ampromo_after_name_banner_img</strong>' . $rule->getAmpromoAfterNameBannerImg();
            echo '<br>';
            echo $use_discount_amount = '<strong> ampromo_after_name_banner_alt</strong>' . $rule->getAmpromoAfterNameBanneAlt();
            echo '<br>';
            echo $use_discount_amount = '<strong> ampromo_after_name_banner_hover_text</strong>' . $rule->getAmpromoAfterNameBannerHoverText();
            echo '<br>';
            echo $use_discount_amount = '<strong> ampromo_after_name_banner_link</strong>' . $rule->getAmpromoAfterNameBannerLink();
            echo '<br>';
            echo $use_discount_amount = '<strong>  Label Img</strong>' . $rule->getAmpromoLabelImg();
            echo '<br>';
            echo $use_discount_amount = '<strong> ampromo_after_name_banner_gift_images</strong>' . $rule->getAmpromoAfterNameBannerGiftImages();
            echo '<br>';
            echo $use_discount_amount = '<strong> ampromo_after_name_banner_link</strong>' . $rule->getAmpromoLabelAlt();

            echo '<hr>';
        }
    }

   /* function gelAction(){
        // echo '<pre>';
        // print_r(Mage::getModel("StncPromorule/promoproducts")->GetPromoList());
        //http://blog.chapagain.com.np/magento-how-to-call-block-directly-from-phtml-file-without-defining-in-layout/
        //http://blog.chapagain.com.np/magento-2-how-to-call-any-template-block-from-phtml-file/
        echo $this->getLayout()
            ->getBlockSingleton('recentproducts/recentproducts');
    }*/


}

