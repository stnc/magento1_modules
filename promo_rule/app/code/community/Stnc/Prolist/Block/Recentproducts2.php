<?php
class Stnc_Prolist_Block_Recentproducts2 extends Mage_Core_Block_Template {
  public function PromoList() {
      $products = Mage::getModel("stncprolist/recentproducts")->getRecentProducts();
      return $products;
  }
}

