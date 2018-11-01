<?
	ini_set('memory_limit','4000M');

	$file_name = "xml_export_google_pl_5192767543.xml";

	$mageFilename = dirname(realpath(__FILE__)).'/../app/Mage.php';
	require_once $mageFilename;

	Mage::app();

	$prod_model	= Mage::getModel("catalog/product");
	$cat_model	= Mage::getModel("catalog/category");
	$prod_helper	= Mage::helper('catalog/output');

	//$conn		= Mage::getSingleton('core/resource');
	//$db			= $conn->getConnection('core_write');
	
	$collection = Mage::getResourceModel('catalog/product_collection');
	Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
	
//	$collection->addAttributeToFilter('sku', array('eq'=>array('PAR-G041159')));

	$xml_out=
	'<?xml version="1.0" encoding="utf-8"?><channel xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:g="http://base.google.com/ns/1.0" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd">
		<id>0</id>
		<title>Sevil Parfümeri / http://www.sevil.com.tr</title>
		<description>Lider marka Sevil, kalitesini dünya çapında kanıtlamış parfüm, makyaj ve cilt bakımı markalarının yanında, Sevil’ e özel markalarını en uygun fiyatlarla sizlerle buluşturuyor.</description>
		<link>http://www.sevil.com.tr/</link>
		<lastBuildDate>'.date("d.m.Y H:i:s").'</lastBuildDate>
		';

	$out=fopen($file_name,"w");
	fwrite($out,$xml_out);

	$total_cnt = $collection->count();

	foreach ($collection as $prod) 
	{
		$prod = $prod_model->reset()->load($prod->getId());
	

		if ($prod->getTypeId() == 'configurable') 
		{
			continue;
		} // if sonu

//		if ($prod->getSku() != 'PAR-G041159') 
//		{
//			echo ".";
//			continue;
//		} // if sonu
		
		$cnt++;
		echo "GOOGLE - ".$cnt."/".$total_cnt." - ".$prod->getSku()." - ".$prod->getName()."\n";

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

		$manufacturer	= $prod->getAttributeText('manufacturer');
		$base_image		= str_replace_https(Mage::helper('catalog/image')->init($prod, 'image')->resize(500)->__toString());

		/// Stok -----------------------------------------
		
		$stock = $prod->getStockItem();
		if ($stock->getIsInStock()) 
		{
			$availability = "in stock";
		} 
		else 
		{
			$availability = "out of stock";
		}

		/// Kategori -----------------------------------------

		$cat_ids=$prod->getCategoryIds();	

		$cat_name="";
		$cat_id="";

		if (count($cat_ids)>0) 
		{
			$cat_ids	= array_reverse($cat_ids);
			$category	= $cat_model->load($cat_ids[0]);
			$parents	= explode("/",$category->getPath());

			if (count($parents)>1) 
			{
				unset($parents[0]);
				unset($parents[1]);
				$cat_names=array();
				foreach ($parents as $pcat_id) 
				{
					if ($pcat_id > 2) 
					{
						$pcat	= $cat_model->load($pcat_id);
						$cat_names[]=$pcat->getName();
					} // if sonu
					
				} // foreach sonu
				$cat_name=join(" > ",$cat_names);
			} // if sonu

		} // if sonu

		/// XML -----------------------------------------
		$price = '<g:price>'.number_format($prod->getFinalPrice(),2,",","").'TL</g:price>';
	
		$sale_price = '';
		if ($prod->getFinalPrice() < $prod->getPrice()) 
		{
			$sale_price = '<g:sale_price>'.number_format($prod->getFinalPrice(),2,",","").'TL</g:sale_price>';
		} // if sonu
		
		$xml_out=
		'
		<item>
			<title><![CDATA['.$prod->getName().']]></title>
			<link><![CDATA['.$prod->getProductUrl().']]></link>
			<description><![CDATA['.$prod_desc.']]></description>
			<g:id><![CDATA['.$prod->getSku().']]></g:id>
			<g:gtin><![CDATA['.trim($prod->getBarkod()).']]></g:gtin>
			<g:image_link><![CDATA['.$base_image.']]></g:image_link>
			'.$price.'
			'.$sale_price.'
			<g:condition>new</g:condition>
			<g:availability>'.$availability.'</g:availability>
			<g:brand><![CDATA['.$manufacturer.']]></g:brand>
			<g:product_type><![CDATA['.$cat_name.']]></g:product_type>
			<g:google_product_category><![CDATA[Sağlık ve Güzellik > Kişisel Bakım > Kozmetik]]></g:google_product_category>
			<g:mobile_link/>
			<g:shipping/>
		</item>
		';	


		fwrite($out,$xml_out);
	
//		if ($cnt > 20) 
//		{
//			break;
//		} // if sonu
		

	} // foreach sonu
	
	$xml_out='</channel>';

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