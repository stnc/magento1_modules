<?php
class Stnc_Prolist_Block_PromoListProducts extends Mage_Core_Block_Template {
  public function getProducts() {
      $products = Mage::getModel("stncprolist/recentproducts")->getRecentProducts();
      return $products;
  }
}

