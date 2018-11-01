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
    $heading .= '<mywebstore>' . "\r\n";
    $heading .= "\t" . "<created_at>" . date('Y-m-d G:i') . "</created_at>" . "\r\n";
    $heading .= "\t" . '<products>' . "\r\n";
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
        $product->load($productId);
        $productType = $product->getTypeID();

        if ($product->getTypeId() == "configurable"):
        // $productgetId = Mage::getModel('catalog/product')->load($product->getId()); //cancel
        echo  $product->getSku()."<br>";
        //https://www.tripleginteractive.com/blog/magento/magento-configurable-products-simple-product-data/
        if ($product->getTypeId() == "configurable"):
            $conf = Mage::getModel('catalog/product_type_configurable')->setProduct($product);
            $simple_collection = $conf->getUsedProductCollection()->addAttributeToSelect('*')->addFilterByRequiredOptions();
            foreach ($simple_collection as $simple_product) {
                echo $simple_product->getSku() . " - " . $simple_product->getName() . " - " . Mage::helper('core')->currency($simple_product->getPrice()) . "<br>";
               // echo $product->getResource()->getAttribute('color')->getFrontend()->getValue($product) . "<br>";
                echo   $simple_product->getAttributeText('color'). "<br>";
            }
        endif;

        $product_data = array();
        $product_data['start'] = "\t\t" . '<product>' . "\r\n";
        $product_data['id'] = "\t" . '<id>' . $product->getSku() . '</id>' . "\r\n"; //id
        $product_data['name'] = "\t" . '<name><![CDATA[' . $product->getName() . ']]></name>' . "\r\n"; //name
        $product_data['link'] = "\t" . '<link><![CDATA[' . LIVE_EL_URL . $product->getUrlPath() . ']]></link>' . "\r\n"; //url
        $product_data['image'] = "\t" . '<image><![CDATA[' . Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product' . $product->getImage() . ']]></image>' . "\r\n"; //image

        foreach ($product->getMediaGalleryImages() as $image) {
            $product_data['additionalimage'] .= "\t" . '<additionalimage><![CDATA[' . $image->getUrl() . ']]></additionalimage>' . "\r\n"; //additional images
        }
        //   $product_data['additionalimage'] = "\t" . '<additionalimage><![CDATA[' . rtrim($product_data['additionalimage'], '> ') . ']]></additionalimage>' . "\r\n";  //belki ilerde açılabilri


        foreach ($product->getCategoryIds() as $_categoryId) {
            $category = Mage::getModel('catalog/category')->load($_categoryId);
            $product_data['category'] .= $category->getName() . ' > ';
        }

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

        $product_data['price'] = "\t" . '<price_with_vat>' . $price . '</price_with_vat>' . "\r\n";
        $product_data['manufacturer'] = "\t" . '<manufacturer><![CDATA[' . $product->getResource()->getAttribute('manufacturer')->getFrontend()->getValue($product) . ']]></manufacturer>' . "\r\n"; //manufacturer
        $product_data['description'] = "\t" . '<description><![CDATA[' . $product->getShortDescription() . ']]></description>' . "\r\n"; //description
        $product_data['instock'] = "\t" . '<instock>Y</instock>' . "\r\n"; // Y: InStock, N: NOT InStock
        $product_data['availability'] = "\t" . '<availability>In Stock</availability>' . "\r\n";
        $product_data['shipping'] = "\t" . '<shipping>0</shipping>' . "\r\n"; // 0: Free Shipping

        $product_data['color'] = "\t" . '<color>' . $product->getResource()->getAttribute('color')->getFrontend()->getValue($product) . '</color>' . "\r\n";


        $product_data['end'] = '</product>';

        foreach ($product_data as $k => $val) {
            $product_data[$k] = $val;
        }

        $feed_line = implode("\t\t", $product_data) . "\r\n";
        fwrite($handle, $feed_line);
        fflush($handle);
        endif;
    }


    $footer = "\t" . '</products>' . "\r\n";
    $footer .= '</mywebstore>';
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