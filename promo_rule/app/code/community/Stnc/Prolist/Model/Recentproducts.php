<?php
class Stnc_Prolist_Model_Recentproducts extends Mage_Core_Model_Abstract {

    public function getRecentProducts() {

        /*
      $products = Mage::getModel("catalog/product")
                  ->getCollection()
                  ->addAttributeToSelect('*')
                  ->setOrder('entity_id', 'DESC')
                  ->setPageSize(5);

      return $products;
      */

        $rulesCollection = Mage::getModel('salesrule/rule')->getCollection()
            ->addFieldToFilter('is_active', 1)
            ->addFieldToFilter('ampromo_after_name_banner_enable', 1)
            ->setOrder('rule_id', 'DESC');;
        foreach ($rulesCollection as $key => $rule) {
            //   echo  $coupon = $rule->getCode();
            $dizi[] = array(
                'RuleId' => $rule->getRuleId(),
                'Name' => $rule->getName(),
                'A_TopBannerDescription' => $rule->getAmpromoTopBannerDescription(),
                'A_promoType' => $rule->getAmpromoType(),
                'A_promoMinPrice' => $rule->getAmpromoMinPrice(),
                'A_Type' => $rule->getAmpromoType(),
                'A_MinPrice' => $rule->getAmpromoMinPrice(),
                'A_UseDiscountAmount' => $rule->getAmpromoUseDiscountAmount(),
                'A_ShowOrigPrice' => $rule->getAmpromoShowOrigPrice(),
                'A_FreeShipping' => $rule->getAmpromoFreeShipping(),
                'A_TopBannerImg' => $rule->getAmpromoTopBannerImg(),
                'A_TopBannerAlt' => $rule->getAmpromoTopBannerAlt(),
                'A_TopBannerHoverText' => $rule->getAmpromoTopBannerHoverText(),
                'A_TopBannerLink' => $rule->getAmpromoTopBannerLink(),
                'A_TopBannerGiftImages' => $rule->getAmpromoTopBannerGiftImages(),
                'A_AfterNameBannerDescription' => $rule->getAmpromoAfterNameBannerDescription(),
                'A_AfterNameBannerImg' => $rule->getAmpromoAfterNameBannerImg(),
                'A_AfterNameBanneAlt' => $rule->getAmpromoAfterNameBannerAlt(),
                'A_AfterNameBannerHoverText' => $rule->getAmpromoAfterNameBannerHoverText(),
                'A_AfterNameBannerLink' => $rule->getAmpromoAfterNameBannerLink(),
                'A_LabelImg' => $rule->getAmpromoLabelImg(),
                'A_AfterNameBannerGiftImages' => $rule->getAmpromoAfterNameBannerGiftImages(),
                'A_LabelAlt' => $rule->getAmpromoLabelAlt(),
            );
        }
        return $dizi;

    }
}

