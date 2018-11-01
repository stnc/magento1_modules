<?php

//https://magento.stackexchange.com/questions/133198/issues-while-creating-xml-feed-with-configurable-products

ini_set('memory_limit', '4000M');

require_once dirname(realpath(__FILE__)) . '/../app/Mage.php';

ini_set('display_errors', 1);
set_time_limit(0);

define('FEED_LOCATION', 'xml-feed.xml');
define('LIVE_EL_URL', 'https://www.kozmetist.com/');
define('DEV_EL_URL', 'http://dev1.kozmetist.com/');


Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
Mage::app('default');

try {
    $handle = fopen(FEED_LOCATION, 'w');
    $heading = '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
    $heading .= '<kozmetist>' . "\r\n";
    $feed_line = $heading;
    fwrite($handle, $feed_line);

    //GET THE PRODUCTS
    $products = Mage::getModel('catalog/product')->getCollection();
    $products->addAttributeToFilter('status', 1); //enabled
    $products->addAttributeToFilter('visibility', 4); //catalog, search
    $products->addAttributeToSelect('*');
    $products->setPageSize(20);
    $products->setCurPage(1);
    $prodIds = $products->getAllIds();
    $product = Mage::getModel('catalog/product');

    foreach ($prodIds as $productId) {
        //$product->load($productId);
        $product = $product->reset()->load($productId);
        $productType = $product->getTypeID();



        $product_data = array();
        $product_data['Products1'] = '<product>';
        $product_data['id'] = "\t" . '<Product_id><![CDATA[' . $product->getSku() . ']]></Product_id>' . "\r\n";
        $product_data['name'] = "\t" . '<Name><![CDATA[' . $product->getName() . ']]></Name>' . "\r\n"; //name

        /*
            foreach ($product->getMediaGalleryImages() as $image) {
                $product_data['additionalimage'] .= "\t" . '<additionalimage><![CDATA[' . $image->getUrl() . ']]></additionalimage>' . "\r\n"; //additional images
            }
            $product_data['additionalimage'] = "\t" . '<additionalimage><![CDATA[' . rtrim($product_data['additionalimage'], '> ') . ']]></additionalimage>' . "\r\n";  //belki ilerde açılabilri
*/

        foreach ($product->getCategoryIds() as $_categoryId) {
            $category = Mage::getModel('catalog/category')->load($_categoryId);
            $product_data['category'] .= $category->getName() . ' > ';
        }

        $product_data['category']=str_replace("Default Category > ","",$product_data['category']);
        $product_data['category']=str_replace("Root Catalog > ","",$product_data['category']);

        $product_data['category'] = "\t" . '<category><![CDATA[' . rtrim($product_data['category'], '> ') . ']]></category>' . "\r\n"; //category
        $normal_price = number_format($product->getPrice(), 2, '.', ''); //price
        $special_price = number_format($product->getSpecialPrice(), 2, '.', ''); //special price
        $price = "";
        $todayDate = date('m/d/y');
        $special_to_date = $product->getSpecialToDate();
        if ($special_price != "0.00") {
            if ($todayDate < $special_to_date) {
                $price = $normal_price;
            } else {
                $price = $special_price;
            }
        } else {
            $price = $normal_price;
        }

        $product_data['price'] = "\t" . '<Price>' . $price . '</Price>' . "\r\n";
        $product_data['brand'] = "\t" . '<brand><![CDATA[' . $product->getAttributeText('manufacturer') . ']]></brand>' . "\r\n"; //manufacturer
        $product_data['CurrencyType'] = "\t" . '<CurrencyType>TL</CurrencyType>' . "\r\n";
        $product_data['tax'] = "\t" . '<tax>18</tax>' . "\r\n";
        $product_data['Stock'] = "\t" . '<Stock>' . ceil($product->getStockItem()->getQty()) . '</Stock>' . "\r\n";//https://magento.stackexchange.com/questions/106455/get-product-stock-quantity-in-magento
        $product_data['Image1'] = "\t" . '<Image1><![CDATA[' . Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product' . $product->getImage() . ']]></Image1>' . "\r\n"; //image

        $product_data['description'] = "\t" . '<description><![CDATA[' . $product->getShortDescription() . ']]></description>' . "\r\n"; //description


        $product_data['end'] = '</product>';

        foreach ($product_data as $k => $val) {
            $product_data[$k] = $val;
        }

        $feed_line = implode("\t\t", $product_data) . "\r\n";
        fwrite($handle, $feed_line);
        fflush($handle);

    }


    $footer = '</kozmetist>';
    $feed_line = $footer;
    fwrite($handle, $feed_line);
    fclose($handle);
} catch (Exception $e) {
    die($e->getMessage());
}

######################################################################################################################################################################
######################################################################################################################################################################
######################################################################################################################################################################

// #######################################################################################################
function clear_text($text)
{

    $pairs = array(
        "\x0C" => "&#x0C;",
        "\x15" => "&#x15;",
        "\x26" => "&#x26;",
        "\x5D" => "&#x5D;",

        "\x03" => "&#x03;",
        "\x05" => "&#x05;",
        "\x0E" => "&#x0E;",
        "\x16" => "&#x16;",
    );
    $text = strtr($text, $pairs);

    return $text;

} // function sonu #######################################################################################


// #######################################################################################################
function str_replace_https($url)
{

    return str_replace("https:", "http:", $url);

} // function sonu #######################################################################################


?>