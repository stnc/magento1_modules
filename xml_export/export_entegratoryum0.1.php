<?php

//https://magento.stackexchange.com/questions/133198/issues-while-creating-xml-feed-with-configurable-products
ini_set('memory_limit', '4000M');

$file_name = "xml_export_google_pl_5192767543.xml";

$mageFilename = dirname(realpath(__FILE__)) . '/../app/Mage.php';
require_once $mageFilename;

Mage::app();

ini_set('display_errors', 1);
set_time_limit(0);

define('FEED_LOCATION', 'xml-feed.xml');
define('LIVE_EL_URL', 'https://www.my-domain.com/');
define('DEV_EL_URL', 'http://dev.my-domain.com/');

require_once dirname(realpath(__FILE__)) . '/../app/Mage.php';

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
    $products->addAttributeToFilter('status', 1); //Enabled
    $products->addAttributeToFilter('visibility', 4); //Catalog, Search
    $products->addAttributeToSelect('*');
    $prodIds = $products->getAllIds();
    $product = Mage::getModel('catalog/product');
    foreach ($prodIds as $productId) {
        $product->load($productId);

        $productType = $product->getTypeID();
        if ($productType == 'configurable') {
            $productgetId = Mage::getModel('catalog/product')->load($product->getId());

            $product_data = array();
            $product_data['start'] = "\t\t" . '<product>' . "\r\n";
            $product_data['id'] = "\t" . '<id>' . $product->getSku() . '</id>' . "\r\n"; //ID
            $product_data['name'] = "\t" . '<name><![CDATA[' . $product->getName() . ' (' . $product->getResource()->getAttribute('color')->getFrontend()->getValue($product) . ')]]></name>' . "\r\n"; //Name
            $product_data['link'] = "\t" . '<link><![CDATA[' . LIVE_EL_URL . $product->getUrlPath() . ']]></link>' . "\r\n"; //URL
            $product_data['image'] = "\t" . '<image><![CDATA[' . Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product' . $product->getImage() . ']]></image>' . "\r\n"; //Image

            foreach ($productgetId->getMediaGalleryImages() as $image) {
                $product_data['additionalimage'] .= "\t" . '<additionalimage><![CDATA[' . $image->getUrl() . ']]></additionalimage>' . "\r\n"; //Additional images
            }

            $categoriesList = $productgetId->getCategoryIds();
            $categoryId = end($categoriesList);
            $category = Mage::getModel('catalog/category')->load($categoryId);
            $product_data['category'] = "\t" . '<category><![CDATA[' . $category->getName() . ']]></category>' . "\r\n"; //Category

            $normal_price = number_format($product->getPrice(), 2, '.', ''); //Price
            $special_price = number_format($product->getSpecialPrice(), 2, '.', ''); //Special Price
            $price = "";
            $todayDate = strtotime(date('Y-m-d H:i:s'));
            $special_to_date = strtotime($product->getSpecialToDate());
            if ($special_price !== "0.00") {
                if ($special_to_date) {
                    if ($todayDate - $special_to_date > 0) {
                        $price = $normal_price;
                    } else {
                        $price = $special_price;
                    }
                } else {
                    $price = $special_price;
                }
            } else {
                $price = $normal_price;
            }
            $product_data['price'] = "\t" . '<price_with_vat>' . $price . '</price_with_vat>' . "\r\n";

            $product_data['manufacturer'] = "\t" . '<manufacturer><![CDATA[' . $product->getResource()->getAttribute('manufacturer')->getFrontend()->getValue($product) . ']]></manufacturer>' . "\r\n"; // Manufacturer
            $product_data['description'] = "\t" . '<description><![CDATA[' . $product->getShortDescription() . ']]></description>' . "\r\n"; // Description

            $product_data['instock'] = "\t" . '<instock>Y</instock>' . "\r\n"; // Y: InStock, N: NOT InStock
            $product_data['availability'] = "\t" . '<availability>Available</availability>' . "\r\n";
            $product_data['shipping'] = "\t" . '<shipping>0</shipping>' . "\r\n"; // 0: Free Shipping




            $product_data['color'] = "\t" . '<color>' . $product->getResource()->getAttribute('color')->getFrontend()->getValue($product) . '</color>' . "\r\n";

            $product_data['end'] = '</product>';

            foreach ($product_data as $k => $val) {
                $product_data[$k] = $val;
            }

            $feed_line = implode("\t\t", $product_data) . "\r\n";
            fwrite($handle, $feed_line);
            fflush($handle);
        }
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