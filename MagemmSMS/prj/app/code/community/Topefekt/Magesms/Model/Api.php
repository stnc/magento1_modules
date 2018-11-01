<?php

/**
 * Mage SMS - SMS notification & SMS marketing
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the BSD 3-Clause License
 * It is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/BSD-3-Clause
 *
 * @category    TOPefekt
 * @package     TOPefekt_Magesms
 * @copyright   Copyright (c) 2012-2015 TOPefekt s.r.o. (http://www.mage-sms.com)
 * @license     http://opensource.org/licenses/BSD-3-Clause
 */
class Topefekt_Magesms_Model_Api extends Topefekt_Magesms_Controller_AtakSmsApi
{
	private $v9f1e7fea943b3d06ee78f55d3b61a95353536218 = 'Magento';
	private $modul_version;
	private $version;
	private $appi_id;
	private $smsapi;
	public $data;
	public $query;
	private $v31d4e11356546b3c102ad42948b903df3b2dcbfc = array();
	private $v8adb8a55748ba4eeb0af088f166489d679f689d0 = array();

	public function __construct($api_value = null)
	{
		//   print_r($api_value);

		$this->modul_version = Mage::getVersion();
		$this->version = Mage::getConfig()->getModuleConfig('Topefekt_Magesms')->version;
		$this->appi_id = Mage::getStoreConfig('magesms/appId');
		if (empty($this->appi_id))
			$this->appi_id = 'no-appId';


		//get_parent_class($this)

		return $this;
	}


	public function serverPost($user_info, $bos_data = true)
	{
		$user_name = $user_info['username'];
		$pass = $user_info['pass'];

		parent::__construct($user_name, $pass);

		return parent::getBalance();

	}

//https://regex101.com/r/nzSKzO/1
	public function turkcell_validator($str)
	{
		$regex = '/^(\+?12)?(9053\d{1}|7[1-9]\d{1})\d{7}$/';

		preg_match_all($regex, $str, $matches, PREG_SET_ORDER, 0);

		if (is_array($matches) && count($matches) > 0) {
			return "var";
		} else {
			return "yok";
		}
	}


	public function vodafone_validator($str)
	{
		$regex = '/^(\+?12)?(9054\d{1}|7[1-9]\d{1})\d{7}$/';

		preg_match_all($regex, $str, $matches, PREG_SET_ORDER, 0);

		if (is_array($matches) && count($matches) > 0) {
			return "var";
		} else {
			return "yok";
		}
	}

	public function avea_validator1($str)
	{
		$regex = '/^(\+?12)?(9050\d{1}|7[1-9]\d{1})\d{7}$/';
		preg_match_all($regex, $str, $matches, PREG_SET_ORDER, 0);
		if (is_array($matches) && count($matches) > 0) {
			return "var";
		} else {
			return "yok";
		}
	}

	public function avea_validator2($str)
	{
		//$regex = '/^(\+?12)?(09055\d{1}|7[1-9]\d{1})\d{7}$/m'; //multiline
		$regex = '/^(\+?12)?(9055\d{1}|7[1-9]\d{1})\d{7}$/';
		preg_match_all($regex, $str, $matches, PREG_SET_ORDER, 0);
		if (is_array($matches) && count($matches) > 0) {
			return "var";
		} else {
			return "yok";
		}
	}

	public function all_mobile_sms_validator($str)
	{

		$sonuc = array();
		$result = false;
		/*$sonuc[0]=avea_validator1("0905016159679");
		$sonuc[1]=vodafone_validator("0905486159679");
		$sonuc[2]=turkcell_validator("0905386159679");*/

		$sonuc[0] = $this->avea_validator1($str);
		$sonuc[1] = $this->vodafone_validator($str);
		$sonuc[2] = $this->turkcell_validator($str);
		$sonuc[3] = $this->avea_validator2($str);
		$sonuc[4] = ($str);

		if (in_array("var", $sonuc)) {
			$result = true;
		}

		return $result;
	}

	/*submit_test e e gore */
	public function SmsSend($user_info, $tel, $message)
	{
		/*$validator = "
		avea = " . ($this->avea_validator1($tel)) . " ,
		avea2 = " . ($this->avea_validator2($tel)) . ",
		vodafone_validator = " . ($this->vodafone_validator($tel)) . ",
		turkcell_validator = " . ($this->turkcell_validator($tel)) . "
		";
		$mail = new Zend_Mail();
		$mail->setBodyText('My Nice Test Text');
		$mail->setBodyHtml(($validator));
		$mail->setFrom('selmantunc@gmail.com', 'Some Sender');
		$mail->addTo('selmantunc@gmail.com', 'Some Recipient');
		$mail->setSubject('HAtalar sonuçlar  ');
		$mail->send();*/


		$sonuc = array();
		$numra_dogrula = false;

		$sonuc[0] = $this->avea_validator1($tel);
		$sonuc[1] = $this->vodafone_validator($tel);
		$sonuc[2] = $this->turkcell_validator($tel);
		$sonuc[3] = $this->avea_validator2($tel);


		if (in_array("var", $sonuc)) {
			$numra_dogrula = true;
		}


		$tel = explode(';', $tel);

		if (is_array($tel)) {
			$to_list = $tel; // array('00905300000002', '+905360000001');
		} else {
			$to_list = array($tel);
		}

		/*$mail = new Zend_Mail();
		$mail->setBodyText('My Nice Test Text');
		$mail->setBodyHtml(json_encode($numra_dogrula));
		$mail->setFrom('selmantunc@gmail.com', 'Some Sender');
		$mail->addTo('selmantunc@gmail.com', 'Some Recipient');
		$mail->setSubject('yeni duzende  $numra_dogrula degeri ');
		$mail->send();*/
		//$numra_dogrula = $this->all_mobile_sms_validator($to_list);//iptal

		$mail_gonderme = false;

		if ($numra_dogrula == false) {
			$sonuc = array(
				'sorgu_return' => '400',
				'sonuc' => 'sorun oluştu cep telefonu numarası degil===',
				'tel' => $tel,
				'sonucc' => $numra_dogrula,
			);
			if ($mail_gonderme) {
				$mail = new Zend_Mail();
				$mail->setSubject('girer 400 hatası');
				$mail->setBodyHtml(json_encode($sonuc));
				$mail->setFrom('selmantunc@gmail.com', 'Some Sender');
				$mail->addTo('selmantunc@gmail.com', 'Some Recipient');
				$mail->setBodyText('My Nice Test Text');
				$mail->send();
				//return (($sonuc));
			}

		}


		if ($numra_dogrula) {

			//eğer array değilse olayına bakılacak
			$user_name = $user_info['username'];
			$pass = $user_info['pass'];
			parent::__construct($user_name, $pass);

			// $to_list = array($tel); // array('00905300000002', '+905360000001');


			$from = null;
			$validity_period = 1440;
			$data_coding = 'Default';
			date_default_timezone_set('UTC');
			$date = mktime(15, 55, 0, 07, 04, 2017); // 5 November 2011 //11 - 5 -2011
			$scheduled_delivery_time = date(DATE_ATOM, $date); // '2011-11-05T00:00:00+00:00'

			/* Send SMS at 2011-11-05 00:00+01:00, valid for 61 minute and with unicode support */
			//  $response = parent::submit($to_list, $message, $from, $scheduled_delivery_time, $validity_period, $data_coding);

			/* Send SMS immediately, with default sender (from) and  24h validity period, using default GSM 3.38 alphabet */
			// $response = $smsapi->submit($to_list, 'hello world');

			/* Send SMS immediately, with default sender (from) and  24h validity period, with unicode support */
			$response = parent::submit($to_list, $message, null, null, null, 'Default');//sel


			/* Check submit response */
			if ($response->status) {
				if ($response->payload->Status->Code == 200) {
					$log1 = array(
						'code' => $response->payload->Status->Code,
						'return' => true,
						'return_id' => $response->payload->MessageId
					);
					$array = json_decode(json_encode($log1), true);//mecbur array e cevirilmeli

					//usleep(3000000);
					$sorgu_return = $this->sorgu($user_info, $array['return_id'][0]);


					$sonuc = array(
						'sorgu_return' => $sorgu_return,
						'sonuc' => $array,
					);
					return $sonuc;
				} else {
					$log1 = array(
						'code' => $response->payload->Status->Code,
						'desc' => $response->payload->Status->Description,
						'return' => false,
						'return_id' => $response->payload->MessageId
					);

					$array = json_decode(json_encode($log1), true);
					$sonuc = array(
						'sorgu_return' => null,
						'sonuc' => $array,
					);

					return $sonuc;


				}
			} else {
				return $response->error;
			}
		}

	}

	private function sorgu($user_info, $message_id)
	{

		//eğer array değilse olayına bakılacak
		$user_name = $user_info['username'];
		$pass = $user_info['pass'];
		parent::__construct($user_name, $pass);

		/* Query SMS messages status by message_id */
		$response = parent::query($message_id, null);

		/* Query SMS message status by message_id and MSISDN (cell phone number) */
		//$response = $smsapi->query(48357370, '905300000001');

		/* Check query response */
		if ($response->status) {
			if ($response->payload->Status->Code == 200) {

				foreach ($response->payload->ReportDetail->List->ReportDetailItem as $item) {
					$dizi[] = $item;

					// return $item->Id . "\t|" . $item->MSISDN . "\t|" . $item->State . "\t|" . $item->ErrorCode . "\t|"  . $item->LastUpdated . "\t\r\n";
				}
				return json_decode(json_encode($dizi), true);
			} else {
				return "No client error but server responded with error: "
					. $response->payload->Status->Code . "-" . $response->payload->Status->Description;
			}
		} else {
			return "Client error: $response->error";
		}
	}

	public function parser($hedaer_bilgisi_gelen_metod, $ia9229b7048dd0adf905022d8569b2d2310c74a8d = ';')
	{
		if (is_bool($hedaer_bilgisi_gelen_metod)) return $hedaer_bilgisi_gelen_metod;
		$i3bd625bb1dc4606e8c0dc77ad823797f51341fc3 = array('errno' => 99, 'error' => 'Parse error: ' . $hedaer_bilgisi_gelen_metod, 'query' => $this->query, 'source' => $hedaer_bilgisi_gelen_metod, 'data' => NULL, 'datasrc' => null);
		if (preg_match('/<b>(.*?)<\/b>/', $hedaer_bilgisi_gelen_metod, $i712821c3a64ae4a252ded9f3deaaddb6e942d985)) {
			$i3bd625bb1dc4606e8c0dc77ad823797f51341fc3['errno'] = $i712821c3a64ae4a252ded9f3deaaddb6e942d985[1];
		}
		if (preg_match('/<u>(.*)<\/u>/', $hedaer_bilgisi_gelen_metod, $i5528ed14b056e3debe4695094269de3a98f76fe7)) {
			if (!in_array($i3bd625bb1dc4606e8c0dc77ad823797f51341fc3['errno'], array(1, 11, 111))) {
				$i3bd625bb1dc4606e8c0dc77ad823797f51341fc3['error'] = $i5528ed14b056e3debe4695094269de3a98f76fe7[1];
				$i3bd625bb1dc4606e8c0dc77ad823797f51341fc3['datasrc'] = $i5528ed14b056e3debe4695094269de3a98f76fe7[1];
			} else {
				$i3bd625bb1dc4606e8c0dc77ad823797f51341fc3['error'] = 'OK';
				$i3bd625bb1dc4606e8c0dc77ad823797f51341fc3['datasrc'] = $i5528ed14b056e3debe4695094269de3a98f76fe7[1];
				$i3bd625bb1dc4606e8c0dc77ad823797f51341fc3['data'] = explode($ia9229b7048dd0adf905022d8569b2d2310c74a8d, $i5528ed14b056e3debe4695094269de3a98f76fe7[1]);
			}
		}
		return $i3bd625bb1dc4606e8c0dc77ad823797f51341fc3;
	}
}