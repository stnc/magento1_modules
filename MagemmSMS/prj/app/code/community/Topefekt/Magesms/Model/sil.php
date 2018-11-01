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
class Topefekt_Magesms_Model_Api extends Varien_Object
{
    private $v9f1e7fea943b3d06ee78f55d3b61a95353536218 = 'Magento';
    private $v9f1e7fea943b3d06ee78f55d3b61a95353536218_version;
    private $v240a8b53893ca3ef75eff909fc854708b004d86d;
    private $v178a3e710e3d4aca00fd843753ef02f29eb2145d;
    private $v45213b023462fa21483839e6493acb7cbe1faeab = ' http://ataksms.com/Api//v1/xml/syncreply/Submit';
    private $v7d5fd66476c545cbe20f5b704f5ef46970896444 = ''/*'/api/api.php' sildim*/
    ;
    private $v9e19674cb6e6518d1f09715fae28b8fe6b262f87;
    private $v7cb5076e93f299085ab8c3bfa32e5712b4990f85 = 80;
    private $vb57aea5fc32ac2e31b4752c9f7610744dee1af4d = 443;
    private $v077a05d1aa14d236b9794734fee8900f425eefdf = 5;
    private $v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 = 'auto';
    private $vcb9f213798e6a676a15ee3c66b26bee41d69d0d4;
    private $vc4185f8999ea79fe5ab81e90671fb9efdd6f4bdb = false;
    public $data;
    public $query;
    private $v31d4e11356546b3c102ad42948b903df3b2dcbfc = array();
    private $v8adb8a55748ba4eeb0af088f166489d679f689d0 = array();

    public function __construct($i4fa8552ddebdef541b5cf2171f90a3e3066468e0 = null)
    {
        $this->v9f1e7fea943b3d06ee78f55d3b61a95353536218_version = Mage::getVersion();
        $this->v240a8b53893ca3ef75eff909fc854708b004d86d = Mage::getConfig()->getModuleConfig('Topefekt_Magesms')->version;
        $this->v178a3e710e3d4aca00fd843753ef02f29eb2145d = Mage::getStoreConfig('magesms/appId');
        if (empty($this->v178a3e710e3d4aca00fd843753ef02f29eb2145d)) $this->v178a3e710e3d4aca00fd843753ef02f29eb2145d = 'no-appId';
        $this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 = ($i35beb284d43488e678f4231cd9771c42363194b5 = Mage::getStoreConfig('magesms/magesms/connector', 0)) ? $i35beb284d43488e678f4231cd9771c42363194b5 : 'auto';
        if ($i4fa8552ddebdef541b5cf2171f90a3e3066468e0) $this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 = $i4fa8552ddebdef541b5cf2171f90a3e3066468e0;
        return $this;
    }

    private function f418217640effcf22811abf41fb6822676544f195($i4fa8552ddebdef541b5cf2171f90a3e3066468e0 = null)
    {
        if ($i4fa8552ddebdef541b5cf2171f90a3e3066468e0 != null) {
            if (in_array($i4fa8552ddebdef541b5cf2171f90a3e3066468e0, array('auto', 'ssl', 'curl-ssl', 'no-ssl', 'curl'))) $this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 = $i4fa8552ddebdef541b5cf2171f90a3e3066468e0;
        }
        if ($this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 == 'auto' || $this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 == 'ssl') {
            @$this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87 = fsockopen('ssl://' . $this->v45213b023462fa21483839e6493acb7cbe1faeab, $this->vb57aea5fc32ac2e31b4752c9f7610744dee1af4d, $this->v31d4e11356546b3c102ad42948b903df3b2dcbfc['ssl'], $this->v8adb8a55748ba4eeb0af088f166489d679f689d0['ssl'], $this->v077a05d1aa14d236b9794734fee8900f425eefdf);
            if (!empty($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87)) return 'ssl';
        }
        if ($this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 == 'auto' || $this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 == 'curl-ssl') {
            $this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87 = curl_init('https://' . $this->v45213b023462fa21483839e6493acb7cbe1faeab . $this->v7d5fd66476c545cbe20f5b704f5ef46970896444);
            $this->v31d4e11356546b3c102ad42948b903df3b2dcbfc['curl'] = curl_errno($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87);
            $this->v8adb8a55748ba4eeb0af088f166489d679f689d0['curl'] = curl_error($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87);
            if (!empty($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87) && empty($this->v31d4e11356546b3c102ad42948b903df3b2dcbfc['curl'])) return 'curl-ssl';
            $this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87 = null;
        }
        if ($this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 == 'auto' || $this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 == 'no-ssl') {
            @$this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87 = fsockopen($this->v45213b023462fa21483839e6493acb7cbe1faeab, $this->v7cb5076e93f299085ab8c3bfa32e5712b4990f85, $this->v31d4e11356546b3c102ad42948b903df3b2dcbfc['no-ssl'], $this->v8adb8a55748ba4eeb0af088f166489d679f689d0['no-ssl'], $this->v077a05d1aa14d236b9794734fee8900f425eefdf);
            if (!empty($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87)) return 'no-ssl';
        }
        if ($this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 == 'auto' || $this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 == 'curl') {
            $this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87 = curl_init('http://' . $this->v45213b023462fa21483839e6493acb7cbe1faeab . $this->v7d5fd66476c545cbe20f5b704f5ef46970896444);
            $this->v31d4e11356546b3c102ad42948b903df3b2dcbfc['curl'] = curl_errno($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87);
            $this->v8adb8a55748ba4eeb0af088f166489d679f689d0['curl'] = curl_error($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87);
            if (!empty($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87) && empty($this->v31d4e11356546b3c102ad42948b903df3b2dcbfc['curl'])) return 'curl';
            $this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87 = null;
        }
        return false;
    }

    private function fba8eb60cc038de71062462629784762fcf874461($ia61712c27ea241bd7a543dc2b02ea572274d0322)
    {
        if (empty($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87)) return false;
        $this->query = $ia61712c27ea241bd7a543dc2b02ea572274d0322;
        preg_match('/action=(.*?)&/', $ia61712c27ea241bd7a543dc2b02ea572274d0322, $i43da24755ffd60b125b8d028fe9374322824e354);
        $i87f2ea938389759d33b89c6fb4d2e619c5e100fa = $i43da24755ffd60b125b8d028fe9374322824e354[1];
        switch ($this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9) {
            case 'no-ssl':
            case 'ssl':
                fwrite($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, "POST " . $this->v7d5fd66476c545cbe20f5b704f5ef46970896444 . " HTTP/1.0\r\n");
                fwrite($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, "User-Agent: Smsmidlet-api/1.0 (" . $this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 . "; " . $this->v9f1e7fea943b3d06ee78f55d3b61a95353536218 . "; " . $this->v9f1e7fea943b3d06ee78f55d3b61a95353536218_version . "; call: $i87f2ea938389759d33b89c6fb4d2e619c5e100fa)\r\n");
                fwrite($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, "Host: " . $this->v45213b023462fa21483839e6493acb7cbe1faeab . "\r\n");
                fwrite($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, "Content-type: application/x-www-form-urlencoded; charset=utf-8\r\n");
                fwrite($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, "Content-length: " . strlen($ia61712c27ea241bd7a543dc2b02ea572274d0322) . "\r\n");
                fwrite($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, "\r\n" . $ia61712c27ea241bd7a543dc2b02ea572274d0322 . "\r\n");
                $i3bd625bb1dc4606e8c0dc77ad823797f51341fc3 = '';
                while (!feof($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87)) {
                    @$i3bd625bb1dc4606e8c0dc77ad823797f51341fc3 .= fgets($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, 2048);
                }
                $ie4a1f55ce89a34eb3838ef044286891434352fb7 = fclose($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87);
                list($ie3dffdbcc706f9e096534318ed81a9f59e289e7d, $this->data) = explode("\r\n\r\n", $i3bd625bb1dc4606e8c0dc77ad823797f51341fc3, 2);
                return $this->data;
                break;
            case 'curl':
            case 'curl-ssl':
                if (get_resource_type($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87) == 'curl') {
                    @curl_setopt($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, CURLOPT_POST, 1);
                    @curl_setopt($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, CURLOPT_POSTFIELDS, $ia61712c27ea241bd7a543dc2b02ea572274d0322);
                    @curl_setopt($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, CURLOPT_FOLLOWLOCATION, 1);
                    @curl_setopt($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, CURLOPT_HEADER, 0);
                    @curl_setopt($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, CURLOPT_RETURNTRANSFER, 1);
                    @curl_setopt($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, CURLOPT_SSL_VERIFYPEER, false);
                    @curl_setopt($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87, CURLOPT_USERAGENT, 'Smsmidlet-api/1.0 (' . $this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 . '; ' . $this->v9f1e7fea943b3d06ee78f55d3b61a95353536218 . '; ' . $this->v9f1e7fea943b3d06ee78f55d3b61a95353536218_version . "; call: $i87f2ea938389759d33b89c6fb4d2e619c5e100fa )");
                    @$i3bd625bb1dc4606e8c0dc77ad823797f51341fc3 = curl_exec($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87);
                    $i3bd625bb1dc4606e8c0dc77ad823797f51341fc3 = html_entity_decode($i3bd625bb1dc4606e8c0dc77ad823797f51341fc3);
                    curl_close($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87);
                    return $this->data = $i3bd625bb1dc4606e8c0dc77ad823797f51341fc3;
                }
                break;
        }
        return false;
    }

    public function getconnectMethod()
    {
        return $this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9;
    }

    public function serverPost($ia61712c27ea241bd7a543dc2b02ea572274d0322, $i17c20960d197486b19dc890665362a4f2fd6f24a = true)
    {
        if (empty($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87) && $this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 != 'auto') $i4fa8552ddebdef541b5cf2171f90a3e3066468e0 = $this->f418217640effcf22811abf41fb6822676544f195();
        if (empty($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87)) $i4fa8552ddebdef541b5cf2171f90a3e3066468e0 = $this->f418217640effcf22811abf41fb6822676544f195('auto');
        if (empty($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87)) return false;
        if (!empty($this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87) && isset($i4fa8552ddebdef541b5cf2171f90a3e3066468e0)) $this->v488f1ce59a4e07137e2e136095a7b0bc80a53bd9 = $i4fa8552ddebdef541b5cf2171f90a3e3066468e0;
        $i2f4c8461c23acd59e2d84b6cbd67931b74d28001 = '';
        if (Mage::registry('magesms_store_id')) $i2f4c8461c23acd59e2d84b6cbd67931b74d28001 = '&storeid=' . Mage::registry('magesms_store_id');
        $i3bd625bb1dc4606e8c0dc77ad823797f51341fc3 = $this->fba8eb60cc038de71062462629784762fcf874461($ia61712c27ea241bd7a543dc2b02ea572274d0322 . $i2f4c8461c23acd59e2d84b6cbd67931b74d28001 . '&AppID=' . $this->v178a3e710e3d4aca00fd843753ef02f29eb2145d . '&version=' . $this->v9f1e7fea943b3d06ee78f55d3b61a95353536218_version . '&moduleVersion=' . $this->v240a8b53893ca3ef75eff909fc854708b004d86d);
        $this->v9e19674cb6e6518d1f09715fae28b8fe6b262f87 = null;
        return $i17c20960d197486b19dc890665362a4f2fd6f24a ? $this->parser($i3bd625bb1dc4606e8c0dc77ad823797f51341fc3) : $i3bd625bb1dc4606e8c0dc77ad823797f51341fc3;
    }

    public function parser($ia61712c27ea241bd7a543dc2b02ea572274d0322, $ia9229b7048dd0adf905022d8569b2d2310c74a8d = ';')
    {
        if (is_bool($ia61712c27ea241bd7a543dc2b02ea572274d0322)) return $ia61712c27ea241bd7a543dc2b02ea572274d0322;
        $i3bd625bb1dc4606e8c0dc77ad823797f51341fc3 = array('errno' => 99, 'error' => 'Parse error: ' . $ia61712c27ea241bd7a543dc2b02ea572274d0322, 'query' => $this->query, 'source' => $ia61712c27ea241bd7a543dc2b02ea572274d0322, 'data' => NULL, 'datasrc' => null);
        if (preg_match('/<b>(.*?)<\/b>/', $ia61712c27ea241bd7a543dc2b02ea572274d0322, $i712821c3a64ae4a252ded9f3deaaddb6e942d985)) {
            $i3bd625bb1dc4606e8c0dc77ad823797f51341fc3['errno'] = $i712821c3a64ae4a252ded9f3deaaddb6e942d985[1];
        }
        if (preg_match('/<u>(.*)<\/u>/', $ia61712c27ea241bd7a543dc2b02ea572274d0322, $i5528ed14b056e3debe4695094269de3a98f76fe7)) {
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