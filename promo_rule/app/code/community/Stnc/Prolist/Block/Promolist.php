<?php
class Stnc_Prolist_Block_PromoList extends Mage_Core_Block_Template {
  public function PromoListable() {
      $products = Mage::getModel("stncprolist/recentproducts")->getRecentProducts();
      return $products;
  }
}

