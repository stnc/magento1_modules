<?
	ini_set('memory_limit','4000M');
	ini_set('max_execution_time','999999999');

	$file_name = "xml_export_criteo_384864826.xml";

	$mageFilename = dirname(realpath(__FILE__)).'/../app/Mage.php';
	require_once $mageFilename;

	Mage::app('default');

	$prod_model	= Mage::getModel("catalog/product");
	$cat_model	= Mage::getModel("catalog/category");
	$prod_helper	= Mage::helper('catalog/output');

	//$conn		= Mage::getSingleton('core/resource');
	//$db			= $conn->getConnection('core_write');
	
	//$collection = Mage::getResourceModel('catalog/product_collection');
	//$collection = Mage::getModel("catalog/product")->getResourceCollection()->load();
	$collection = Mage::getModel('catalog/product')->getCollection();
	//Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
	
//	$collection->addAttributeToFilter('sku', array('eq'=>array('PAR-G041159')));
	$total_cnt = $collection->count();
	echo $total_cnt." adet urun bulundu... \n";

	$xml_out=
	'<?xml version="1.0" encoding="utf-8"?>
		<products>
		';

	$out=fopen($file_name,"w");
	fwrite($out,$xml_out);


	foreach ($collection as $prod) 
	{
		$cnt++;

		if ($cnt < 7000) 
		{
			///continue;
		} // if sonu
		
		$prod = $prod_model->reset()->load($prod->getId());

		if ($prod->getSku() != 'lo-b09022720') 
		{
			echo ".";
			continue;
		} // if sonu
		
		echo "CRITEO - ".$cnt."/".$total_cnt." - ".$prod->getSku()." - ".$prod->getName()." -- ".$prod->getProductUrl()."\n";

		/// Ek alanlar -----------------------------------------
		if ($prod->getShortDescription() != "") 
		{
			$prod_desc	= $prod->getShortDescription();
		} // if sonu
		else 
		{
			$prod_desc	= $prod->getName();
		} // else sonu

		$prod_desc = clear_text($prod_desc);

		//$manufacturer	= $prod->getAttributeText('manufacturer');

		$base_image		= str_replace_https(Mage::helper('catalog/image')->init($prod, 'image')->resize(800)->__toString());
		$small_image	= str_replace_https(Mage::helper('catalog/image')->init($prod, 'small_image')->resize(120)->__toString());

		/// Stok -----------------------------------------
		
		$stock = $prod->getStockItem();
		if ($stock->getIsInStock()) 
		{
			$availability = "1";
		} 
		else 
		{
			$availability = "0";
		}

		/// Kategori -----------------------------------------

		$cat_ids=$prod->getCategoryIds();	

		$cat_name="";
		$cat_id="";

		$cat_names = array();
		if (count($cat_ids)>0) 
		{
			$cat_ids	= array_reverse($cat_ids);
			foreach ($cat_ids as $cat_id) 
			{
				$category	= $cat_model->load($cat_id);
				$cat_names[]= $category->getName();
			} // foreach sonu
		} // if sonu

		/// XML -----------------------------------------
	
		$discount = '';
		if ($prod->getFinalPrice() < $prod->getPrice()) 
		{
			$discount = ( $prod->getPrice() - $prod->getFinalPrice() ) / ( $prod->getPrice() / 100 );
			$sale_price = number_format($prod->getFinalPrice(),2,",","");
			$price = number_format($prod->getPrice(),2,",","");
		} // if sonu
		else 
		{
			$discount = 0;
			$sale_price = number_format($prod->getFinalPrice(),2,",","");
			$price = number_format($prod->getPrice(),2,",","");
		} // else sonu
				
		$xml_out=
		'
		<product id="'.$prod->getSku().'">
			<name><![CDATA['.$prod->getName().']]></name>
			<producturl><![CDATA['.$prod->getProductUrl().']]></producturl>
			<bigimage><![CDATA['.$base_image.']]></bigimage>
			<description><![CDATA['.$prod_desc.']]></description>
			<discount>'.$discount.'</discount>
			<price>'.$price.'</price>
			<sale_price>'.$sale_price.'</sale_price>
			<instock>'.$availability.'</instock>

			<Categoryid1><![CDATA['.$cat_names[0].']]></Categoryid1>
			<Categoryid2><![CDATA['.$cat_names[1].']]></Categoryid2>
			<Categoryid3><![CDATA['.$cat_names[2].']]></Categoryid3>
		</product>
		';	


		fwrite($out,$xml_out);
	
//		if ($cnt > 20) 
//		{
//			break;
//		} // if sonu
		
		//$prod->reset();

	} // foreach sonu
	
	$xml_out='</products>';

	fwrite($out,$xml_out);
	fclose($out);


######################################################################################################################################################################
######################################################################################################################################################################
######################################################################################################################################################################

// #######################################################################################################
function clear_text($text) {

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
function str_replace_https($url) {

	return str_replace("https:","http:",$url);	

} // function sonu #######################################################################################
	
	
?>