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
class Topefekt_Magesms_Helper_Data extends Mage_Adminhtml_Helper_Data
{
    const MAGESMS_ENABLE = 'magesms/magesms/enable';
    private $v148194b5b9cc653ce2e35e9709e441dc6fd4123a = array();

    public function isActive($ibcdf76f8c9ddc330c79f805116a8bb146c43749d3bf172bc34c83f4a18624b192bc0bd7c4d647a66 = null)
    {
        return Mage::getStoreConfig(self::MAGESMS_ENABLE, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d3bf172bc34c83f4a18624b192bc0bd7c4d647a66);
    }

    public function prepareFilterString($i215e94a3ecdacdf2b3af7056dddcbb72bf4f3ad2)
    {
        $ia61712c27ea241bd7a543dc2b02ea572274d0322 = array();
        $i215e94a3ecdacdf2b3af7056dddcbb72bf4f3ad2 = base64_decode($i215e94a3ecdacdf2b3af7056dddcbb72bf4f3ad2);
        parse_str($i215e94a3ecdacdf2b3af7056dddcbb72bf4f3ad2, $ia61712c27ea241bd7a543dc2b02ea572274d0322);
        array_walk_recursive($ia61712c27ea241bd7a543dc2b02ea572274d0322, array($this, 'decodeFilter'));
        return $ia61712c27ea241bd7a543dc2b02ea572274d0322;
    }

    public function decodeFilter(&$ibcdf76f8c9ddc330c79f805116a8bb146c43749df2eee0665f163a28f4adcfe84e3fc666bf1bcd89)
    {
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749df2eee0665f163a28f4adcfe84e3fc666bf1bcd89 = rawurldecode($ibcdf76f8c9ddc330c79f805116a8bb146c43749df2eee0665f163a28f4adcfe84e3fc666bf1bcd89);
    }

    public function strlen($ibcdf76f8c9ddc330c79f805116a8bb146c43749d7c53db4e1e286ce8a65b930c9d93cdabb069954b)
    {
        return strlen(utf8_decode($ibcdf76f8c9ddc330c79f805116a8bb146c43749d7c53db4e1e286ce8a65b930c9d93cdabb069954b));
    }

    public function substr($ibcdf76f8c9ddc330c79f805116a8bb146c43749d7c53db4e1e286ce8a65b930c9d93cdabb069954b, $ibcdf76f8c9ddc330c79f805116a8bb146c43749dee10b1113e98c522f9d7b19b278ac191206cf98d, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d4616676bff4c07942c8542e6b4e0ccf29d473424 = -1)
    {
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749d353d238323208401995f652ac6757c9d9fd6d8d5 = preg_split('//u', $ibcdf76f8c9ddc330c79f805116a8bb146c43749d7c53db4e1e286ce8a65b930c9d93cdabb069954b, -1);
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749dd3f9e660973a05c72dd2df52c035747f20824128 = $ibcdf76f8c9ddc330c79f805116a8bb146c43749d4616676bff4c07942c8542e6b4e0ccf29d473424 == -1 ? count($ibcdf76f8c9ddc330c79f805116a8bb146c43749d353d238323208401995f652ac6757c9d9fd6d8d5) : $ibcdf76f8c9ddc330c79f805116a8bb146c43749d4616676bff4c07942c8542e6b4e0ccf29d473424;
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749d43e9cdc24374813037dc691df23094b5f8072dac = '';
        for ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d = $ibcdf76f8c9ddc330c79f805116a8bb146c43749dee10b1113e98c522f9d7b19b278ac191206cf98d; $ibcdf76f8c9ddc330c79f805116a8bb146c43749d < $ibcdf76f8c9ddc330c79f805116a8bb146c43749dd3f9e660973a05c72dd2df52c035747f20824128; $ibcdf76f8c9ddc330c79f805116a8bb146c43749d++) $ibcdf76f8c9ddc330c79f805116a8bb146c43749d43e9cdc24374813037dc691df23094b5f8072dac .= $ibcdf76f8c9ddc330c79f805116a8bb146c43749d353d238323208401995f652ac6757c9d9fd6d8d5[$ibcdf76f8c9ddc330c79f805116a8bb146c43749d];
        return $ibcdf76f8c9ddc330c79f805116a8bb146c43749d43e9cdc24374813037dc691df23094b5f8072dac;
    }

    public function strpos($icf8e6d55f3b73687e31b5bfb7df726c05be874e6, $ibcdf76f8c9ddc330c79f805116a8bb146c43749dfba351358ab7c7f378315c6b3cb913d7f4d7b0fa, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d37e0852c5c95f9440a8999674f38c2ab1fbd56e2 = 0)
    {
        return mb_strpos($icf8e6d55f3b73687e31b5bfb7df726c05be874e6, $ibcdf76f8c9ddc330c79f805116a8bb146c43749dfba351358ab7c7f378315c6b3cb913d7f4d7b0fa, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d37e0852c5c95f9440a8999674f38c2ab1fbd56e2, 'UTF-8');
    }

    public function detectLang($ibcdf76f8c9ddc330c79f805116a8bb146c43749dccb00baf62ef7b52dab4785b2fe3e5d6471b5d03 = false)
    {
        if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $ibcdf76f8c9ddc330c79f805116a8bb146c43749d593f9fb6306ab4cdb862f1ef6769504d63647c90 = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
            if (!empty($ibcdf76f8c9ddc330c79f805116a8bb146c43749d593f9fb6306ab4cdb862f1ef6769504d63647c90[1])) {
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749db473854f4b306e706e896b68ceb14665e7bc5475 = explode(';', $ibcdf76f8c9ddc330c79f805116a8bb146c43749d593f9fb6306ab4cdb862f1ef6769504d63647c90[1]);
                if (!empty($ibcdf76f8c9ddc330c79f805116a8bb146c43749db473854f4b306e706e896b68ceb14665e7bc5475[0])) $ibcdf76f8c9ddc330c79f805116a8bb146c43749d593f9fb6306ab4cdb862f1ef6769504d63647c90[1] = $ibcdf76f8c9ddc330c79f805116a8bb146c43749db473854f4b306e706e896b68ceb14665e7bc5475[0];
            }
            $iff7e46827cbb6547116c592bf800f4687428abf9 = Mage::getModel('magesms/country_lang')->getCollection();
            $iff7e46827cbb6547116c592bf800f4687428abf9->addFilter('lang', strtolower($ibcdf76f8c9ddc330c79f805116a8bb146c43749d593f9fb6306ab4cdb862f1ef6769504d63647c90[0]));
            foreach ($iff7e46827cbb6547116c592bf800f4687428abf9 as $i4cf0596ef3a67e5add95b49723a3c49aecd1dbd3) {
                return $ibcdf76f8c9ddc330c79f805116a8bb146c43749dccb00baf62ef7b52dab4785b2fe3e5d6471b5d03 ? $i4cf0596ef3a67e5add95b49723a3c49aecd1dbd3->getData('iso2') : $i4cf0596ef3a67e5add95b49723a3c49aecd1dbd3->getData('country_name');
            }
            if (!empty($ibcdf76f8c9ddc330c79f805116a8bb146c43749d593f9fb6306ab4cdb862f1ef6769504d63647c90[1])) {
                $iff7e46827cbb6547116c592bf800f4687428abf9 = Mage::getModel('magesms/country_lang')->getCollection();
                $iff7e46827cbb6547116c592bf800f4687428abf9->addFilter('lang', strtolower($ibcdf76f8c9ddc330c79f805116a8bb146c43749d593f9fb6306ab4cdb862f1ef6769504d63647c90[1]));
                foreach ($iff7e46827cbb6547116c592bf800f4687428abf9 as $i4cf0596ef3a67e5add95b49723a3c49aecd1dbd3) {
                    return $ibcdf76f8c9ddc330c79f805116a8bb146c43749dccb00baf62ef7b52dab4785b2fe3e5d6471b5d03 ? $i4cf0596ef3a67e5add95b49723a3c49aecd1dbd3->getData('iso2') : $i4cf0596ef3a67e5add95b49723a3c49aecd1dbd3->getData('country_name');
                }
            }
            Mage::log('Dont detect lang: ' . $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        }
        return 'en';
    }

    public function formatPrice($ibcdf76f8c9ddc330c79f805116a8bb146c43749d58457975a91d59a84d2920953badcb7365ac1f01, $i2457499363c0873527a65aa9ad19ce774bd79cbc = 4)
    {
        return number_format((float)$ibcdf76f8c9ddc330c79f805116a8bb146c43749d58457975a91d59a84d2920953badcb7365ac1f01, $i2457499363c0873527a65aa9ad19ce774bd79cbc, ",", " ");
    }

    public function moreText($ibcdf76f8c9ddc330c79f805116a8bb146c43749ddfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d4616676bff4c07942c8542e6b4e0ccf29d473424, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d41874a76da96da0584b16b9f04de6e3f06863c83)
    {
        if ($this->strlen($ibcdf76f8c9ddc330c79f805116a8bb146c43749ddfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa) > $ibcdf76f8c9ddc330c79f805116a8bb146c43749d41874a76da96da0584b16b9f04de6e3f06863c83): $ibcdf76f8c9ddc330c79f805116a8bb146c43749d838a72d011cf88c91dfc0040ea07c7fa8e44c6ae = $this->strpos($ibcdf76f8c9ddc330c79f805116a8bb146c43749ddfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa, ' ', $ibcdf76f8c9ddc330c79f805116a8bb146c43749d4616676bff4c07942c8542e6b4e0ccf29d473424, 'UTF-8');
            if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d838a72d011cf88c91dfc0040ea07c7fa8e44c6ae > $ibcdf76f8c9ddc330c79f805116a8bb146c43749d41874a76da96da0584b16b9f04de6e3f06863c83 || $ibcdf76f8c9ddc330c79f805116a8bb146c43749d838a72d011cf88c91dfc0040ea07c7fa8e44c6ae == 0) $ibcdf76f8c9ddc330c79f805116a8bb146c43749d838a72d011cf88c91dfc0040ea07c7fa8e44c6ae = $ibcdf76f8c9ddc330c79f805116a8bb146c43749d41874a76da96da0584b16b9f04de6e3f06863c83;
            return "<span style=\"cursor:help;text-decoration:underline;\" title=\"" . $ibcdf76f8c9ddc330c79f805116a8bb146c43749ddfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa . "\">" . $this->substr($ibcdf76f8c9ddc330c79f805116a8bb146c43749ddfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa, 0, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d838a72d011cf88c91dfc0040ea07c7fa8e44c6ae) . "...</span>";
        else: return $ibcdf76f8c9ddc330c79f805116a8bb146c43749ddfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa; endif;
    }

    public function isPhoneNumber($ibcdf76f8c9ddc330c79f805116a8bb146c43749d9e76a736cd2ce866634b875b0e477fe802efd466)
    {
        return preg_match('/^[0-9]{7,18}$/', $ibcdf76f8c9ddc330c79f805116a8bb146c43749d9e76a736cd2ce866634b875b0e477fe802efd466);
    }

    public function isTextSender($ibcdf76f8c9ddc330c79f805116a8bb146c43749d1e0ab2cc14bf21436fd5165a18812bf40da12d82)
    {
        return preg_match('/(?!^\d+$)^[0-9a-zA-Z_.]{3,11}$/', $ibcdf76f8c9ddc330c79f805116a8bb146c43749d1e0ab2cc14bf21436fd5165a18812bf40da12d82);
    }

    public function countSms($ibcdf76f8c9ddc330c79f805116a8bb146c43749ddfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa, $ibcdf76f8c9ddc330c79f805116a8bb146c43749de8d90f6313614fbb6564426c0b0cb59a0ca4cecd)
    {
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749ddfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa = str_replace("\r\n", "\n", $ibcdf76f8c9ddc330c79f805116a8bb146c43749ddfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa);
        if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749de8d90f6313614fbb6564426c0b0cb59a0ca4cecd) {
            $ibcdf76f8c9ddc330c79f805116a8bb146c43749d8cf55ea687bc1e974c51c5dbd65047184db69956 = $this->strlen($ibcdf76f8c9ddc330c79f805116a8bb146c43749ddfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa);
            if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d8cf55ea687bc1e974c51c5dbd65047184db69956 < 71) $if295547318143e26fc7026b92d58e3d1eec229db = 1; elseif ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d8cf55ea687bc1e974c51c5dbd65047184db69956 % 67 == 0) $if295547318143e26fc7026b92d58e3d1eec229db = floor($ibcdf76f8c9ddc330c79f805116a8bb146c43749d8cf55ea687bc1e974c51c5dbd65047184db69956 / 67);
            else $if295547318143e26fc7026b92d58e3d1eec229db = floor($ibcdf76f8c9ddc330c79f805116a8bb146c43749d8cf55ea687bc1e974c51c5dbd65047184db69956 / 67) + 1;
        } else {
            $ibcdf76f8c9ddc330c79f805116a8bb146c43749d8cf55ea687bc1e974c51c5dbd65047184db69956 = $this->strlen($ibcdf76f8c9ddc330c79f805116a8bb146c43749ddfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa);
            if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d8cf55ea687bc1e974c51c5dbd65047184db69956 < 161) $if295547318143e26fc7026b92d58e3d1eec229db = 1; elseif ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d8cf55ea687bc1e974c51c5dbd65047184db69956 % 153 == 0) $if295547318143e26fc7026b92d58e3d1eec229db = floor($ibcdf76f8c9ddc330c79f805116a8bb146c43749d8cf55ea687bc1e974c51c5dbd65047184db69956 / 153);
            else $if295547318143e26fc7026b92d58e3d1eec229db = floor($ibcdf76f8c9ddc330c79f805116a8bb146c43749d8cf55ea687bc1e974c51c5dbd65047184db69956 / 153) + 1;
        }
        return $if295547318143e26fc7026b92d58e3d1eec229db;
    }

    public function prepareNumber($ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d30f20aafde612a957f7f966cb5b85e35782bc88a, $ibcdf76f8c9ddc330c79f805116a8bb146c43749df0177bfe4bf22cfbb3da2ac06eca557829f0a4cd, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d3bf172bc34c83f4a18624b192bc0bd7c4d647a66 = null)
    {
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749dbad5149cd536c7e1f814c7b3874463985a5fc9e0 = $ibcdf76f8c9ddc330c79f805116a8bb146c43749db40be13647f8bcb177e647eb770e6ac08b117290 = 0;
        $i7492a7ab99a6ff1e0ae253366480ecb40a550224 = '';
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2 = str_replace(array(' ', '-', '(', ')', '/'), '', $ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2);
        if (strpos($ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2, '+') === 0) $ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2 = substr($ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2, 1);
        if (strpos($ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2, '00') === 0) $ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2 = substr($ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2, 2); elseif (strpos($ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2, '0') === 0) $ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2 = substr($ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2, 1);
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2 = Mage::getSingleton('magesms/exceptions')->number($ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2, $ibcdf76f8c9ddc330c79f805116a8bb146c43749df0177bfe4bf22cfbb3da2ac06eca557829f0a4cd);
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749db8c2593511e733deb36fb6bc932a747fcf3b754c = strlen($ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2);
        if (isset($this->v148194b5b9cc653ce2e35e9709e441dc6fd4123a['maps'])) $ibcdf76f8c9ddc330c79f805116a8bb146c43749dd567d29153b9150b8add34bc81058cd5432e46a0 = $this->v148194b5b9cc653ce2e35e9709e441dc6fd4123a['maps']; else $this->v148194b5b9cc653ce2e35e9709e441dc6fd4123a['maps'] = $ibcdf76f8c9ddc330c79f805116a8bb146c43749dd567d29153b9150b8add34bc81058cd5432e46a0 = Mage::getSingleton('magesms/maps')->getCollection();
        if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749dd567d29153b9150b8add34bc81058cd5432e46a0->count()) {
            if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749df0177bfe4bf22cfbb3da2ac06eca557829f0a4cd) {
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749db4e103fdfd1ed6cc442d5e4b10b704780717812b = $ibcdf76f8c9ddc330c79f805116a8bb146c43749df0177bfe4bf22cfbb3da2ac06eca557829f0a4cd . $ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2;
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749da272895aa0a96c7311ddc14cd99cfde9b3e11fa0 = strlen($ibcdf76f8c9ddc330c79f805116a8bb146c43749db4e103fdfd1ed6cc442d5e4b10b704780717812b);
                foreach ($ibcdf76f8c9ddc330c79f805116a8bb146c43749dd567d29153b9150b8add34bc81058cd5432e46a0 as $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d) {
                    if (preg_match("/^" . $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d->getArea() . "/", $ibcdf76f8c9ddc330c79f805116a8bb146c43749db4e103fdfd1ed6cc442d5e4b10b704780717812b, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d45e0dbda03c5e1b049126d29f809da95d0e0aa03)) {
                        $i7492a7ab99a6ff1e0ae253366480ecb40a550224 = substr($ibcdf76f8c9ddc330c79f805116a8bb146c43749db4e103fdfd1ed6cc442d5e4b10b704780717812b, 0, strlen($ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d->getArea()));
                        $ibcdf76f8c9ddc330c79f805116a8bb146c43749dc155ac0a2e7d522b71a8f6aae45a2917bd596596 = $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d->getNumber();
                        if (($ibcdf76f8c9ddc330c79f805116a8bb146c43749da272895aa0a96c7311ddc14cd99cfde9b3e11fa0 - strlen($ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d->getArea())) == $ibcdf76f8c9ddc330c79f805116a8bb146c43749dc155ac0a2e7d522b71a8f6aae45a2917bd596596) {
                            $ibcdf76f8c9ddc330c79f805116a8bb146c43749db40be13647f8bcb177e647eb770e6ac08b117290 = 1;
                            $ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2 = $ibcdf76f8c9ddc330c79f805116a8bb146c43749db4e103fdfd1ed6cc442d5e4b10b704780717812b;
                            break;
                        }
                    }
                }
            }
            if (!$ibcdf76f8c9ddc330c79f805116a8bb146c43749db40be13647f8bcb177e647eb770e6ac08b117290) {
                foreach ($ibcdf76f8c9ddc330c79f805116a8bb146c43749dd567d29153b9150b8add34bc81058cd5432e46a0 as $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d) {
                    if (preg_match("/^" . $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d->getArea() . "/", $ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d45e0dbda03c5e1b049126d29f809da95d0e0aa03)) {
                        $i7492a7ab99a6ff1e0ae253366480ecb40a550224 = substr($ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2, 0, strlen($ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d->getArea()));
                        $ibcdf76f8c9ddc330c79f805116a8bb146c43749dc155ac0a2e7d522b71a8f6aae45a2917bd596596 = $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d->getNumber();
                        if (($ibcdf76f8c9ddc330c79f805116a8bb146c43749db8c2593511e733deb36fb6bc932a747fcf3b754c - strlen($ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d->getArea())) == $ibcdf76f8c9ddc330c79f805116a8bb146c43749dc155ac0a2e7d522b71a8f6aae45a2917bd596596) {
                            $ibcdf76f8c9ddc330c79f805116a8bb146c43749dbad5149cd536c7e1f814c7b3874463985a5fc9e0 = 1;
                            continue;
                        }
                    }
                }
            }
        }
        if (!$ibcdf76f8c9ddc330c79f805116a8bb146c43749dbad5149cd536c7e1f814c7b3874463985a5fc9e0 && !$ibcdf76f8c9ddc330c79f805116a8bb146c43749db40be13647f8bcb177e647eb770e6ac08b117290) $ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2 = $ibcdf76f8c9ddc330c79f805116a8bb146c43749df0177bfe4bf22cfbb3da2ac06eca557829f0a4cd . $ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2; elseif (($ibcdf76f8c9ddc330c79f805116a8bb146c43749dbad5149cd536c7e1f814c7b3874463985a5fc9e0 || $ibcdf76f8c9ddc330c79f805116a8bb146c43749db40be13647f8bcb177e647eb770e6ac08b117290) && $i7492a7ab99a6ff1e0ae253366480ecb40a550224) $ibcdf76f8c9ddc330c79f805116a8bb146c43749df0177bfe4bf22cfbb3da2ac06eca557829f0a4cd = $i7492a7ab99a6ff1e0ae253366480ecb40a550224;
        if (!$ibcdf76f8c9ddc330c79f805116a8bb146c43749df0177bfe4bf22cfbb3da2ac06eca557829f0a4cd && $i7492a7ab99a6ff1e0ae253366480ecb40a550224) $ibcdf76f8c9ddc330c79f805116a8bb146c43749df0177bfe4bf22cfbb3da2ac06eca557829f0a4cd = $i7492a7ab99a6ff1e0ae253366480ecb40a550224;
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749dd96ad83fb93ea5189e8edb176831948b382810df = array('mobile' => $ibcdf76f8c9ddc330c79f805116a8bb146c43749daab7d0929a7000dca6467ef8cddbf22298ab81f2, 'prefix' => $ibcdf76f8c9ddc330c79f805116a8bb146c43749df0177bfe4bf22cfbb3da2ac06eca557829f0a4cd, 'isms' => '', 'sendertype' => '', 'senderID' => '');
        if (isset($this->v148194b5b9cc653ce2e35e9709e441dc6fd4123a['routes_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749d30f20aafde612a957f7f966cb5b85e35782bc88a . '_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749df0177bfe4bf22cfbb3da2ac06eca557829f0a4cd])) $ibcdf76f8c9ddc330c79f805116a8bb146c43749dd567d29153b9150b8add34bc81058cd5432e46a0 = $this->v148194b5b9cc653ce2e35e9709e441dc6fd4123a['routes_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749d30f20aafde612a957f7f966cb5b85e35782bc88a . '_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749df0177bfe4bf22cfbb3da2ac06eca557829f0a4cd]; else $this->v148194b5b9cc653ce2e35e9709e441dc6fd4123a['routes_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749d30f20aafde612a957f7f966cb5b85e35782bc88a . '_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749df0177bfe4bf22cfbb3da2ac06eca557829f0a4cd] = $ibcdf76f8c9ddc330c79f805116a8bb146c43749dd567d29153b9150b8add34bc81058cd5432e46a0 = Mage::getSingleton('magesms/routes')->getCollection()->addFieldToFilter('area', $ibcdf76f8c9ddc330c79f805116a8bb146c43749df0177bfe4bf22cfbb3da2ac06eca557829f0a4cd)->addFieldToFilter('type', $ibcdf76f8c9ddc330c79f805116a8bb146c43749d30f20aafde612a957f7f966cb5b85e35782bc88a);
        if (!is_null($ibcdf76f8c9ddc330c79f805116a8bb146c43749d3bf172bc34c83f4a18624b192bc0bd7c4d647a66)) $ibcdf76f8c9ddc330c79f805116a8bb146c43749d898347c1def9d4effdd15deb4483c4b4a4aa8ab7 = Mage::getModel('core/store')->load($ibcdf76f8c9ddc330c79f805116a8bb146c43749d3bf172bc34c83f4a18624b192bc0bd7c4d647a66)->getGroup()->getId();
        foreach ($ibcdf76f8c9ddc330c79f805116a8bb146c43749dd567d29153b9150b8add34bc81058cd5432e46a0 as $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d) {
            $ibcdf76f8c9ddc330c79f805116a8bb146c43749dd96ad83fb93ea5189e8edb176831948b382810df['isms'] = $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d['isms'];
            $ibcdf76f8c9ddc330c79f805116a8bb146c43749dd96ad83fb93ea5189e8edb176831948b382810df['sendertype'] = $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d['sendertype'];
            $ibcdf76f8c9ddc330c79f805116a8bb146c43749dd96ad83fb93ea5189e8edb176831948b382810df['senderID'] = $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d['senderID'];
            if (!is_null($ibcdf76f8c9ddc330c79f805116a8bb146c43749d3bf172bc34c83f4a18624b192bc0bd7c4d647a66)) {
                if (isset($this->v148194b5b9cc653ce2e35e9709e441dc6fd4123a['routes-alternative_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d->getId() . '_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749d898347c1def9d4effdd15deb4483c4b4a4aa8ab7])) $ida3b491904fb073f446bf820cd55a0ff69b347d1 = $this->v148194b5b9cc653ce2e35e9709e441dc6fd4123a['routes-alternative_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d->getId() . '_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749d898347c1def9d4effdd15deb4483c4b4a4aa8ab7]; else $this->v148194b5b9cc653ce2e35e9709e441dc6fd4123a['routes-alternative_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d->getId() . '_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749d898347c1def9d4effdd15deb4483c4b4a4aa8ab7] = $ida3b491904fb073f446bf820cd55a0ff69b347d1 = Mage::getSingleton('magesms/routes_alternative')->getCollection()->addFieldToFilter('route_id', $ibcdf76f8c9ddc330c79f805116a8bb146c43749debe3a16a01f87f9a4ebbb9731163db3e3e64cc3d->getId())->addFieldToFilter('store_group_id', $ibcdf76f8c9ddc330c79f805116a8bb146c43749d898347c1def9d4effdd15deb4483c4b4a4aa8ab7);
                if ($ida3b491904fb073f446bf820cd55a0ff69b347d1->count()) {
                    $ibcdf76f8c9ddc330c79f805116a8bb146c43749dd96ad83fb93ea5189e8edb176831948b382810df['senderID'] = $ida3b491904fb073f446bf820cd55a0ff69b347d1->getFirstItem()->getTextsender();
                }
            }
        }
        return $ibcdf76f8c9ddc330c79f805116a8bb146c43749dd96ad83fb93ea5189e8edb176831948b382810df;
    }

    public function getHooks($i45529c33bd7aa0ebcc4b6e41bd3e02f2889252fc, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d30f20aafde612a957f7f966cb5b85e35782bc88a, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d7137e40370cf1c5ccf937060891613788203e2d6 = 'default')
    {
        if (isset(Topefekt_Magesms_Model_Hooks::$groups[$i45529c33bd7aa0ebcc4b6e41bd3e02f2889252fc]) && $i45529c33bd7aa0ebcc4b6e41bd3e02f2889252fc != 'order_status') {
            $if739aceffec69fa2733946a3d319defaa354082d = Mage::getSingleton('magesms/hooks')->getCollection()->addFieldToFilter('lang', Mage::getStoreConfig('magesms/template/language'))->addFieldToFilter('owner', array('neq' => 1))->addFieldToFilter('group', Topefekt_Magesms_Model_Hooks::$groups[$i45529c33bd7aa0ebcc4b6e41bd3e02f2889252fc]);
        } elseif (isset(Topefekt_Magesms_Model_Hooks::$groups[$i45529c33bd7aa0ebcc4b6e41bd3e02f2889252fc])) {
            $i42ee48f418943c9662de0976069476c7dc8f620d = Mage::getSingleton('magesms/hooks')->getCollection()->addFieldToFilter('lang', Mage::getStoreConfig('magesms/template/language'))->addFieldToFilter('owner', array('neq' => 1))->addFieldToFilter('group', Topefekt_Magesms_Model_Hooks::$groups[$i45529c33bd7aa0ebcc4b6e41bd3e02f2889252fc])->getFirstItem();
            $ibcdf76f8c9ddc330c79f805116a8bb146c43749dd09e842bda9623afdb1b69812abe0b86eaf039c9 = Mage::getSingleton('sales/order_status')->getCollection();
            $if739aceffec69fa2733946a3d319defaa354082d = array();
            foreach ($ibcdf76f8c9ddc330c79f805116a8bb146c43749dd09e842bda9623afdb1b69812abe0b86eaf039c9 as $ibcdf76f8c9ddc330c79f805116a8bb146c43749d712821c3a64ae4a252ded9f3deaaddb6e942d985) {
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749d35f7502d936f0fb94b528aa6d4fbaca3f779fa05 = clone($i42ee48f418943c9662de0976069476c7dc8f620d);
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749d0bd865ed0ae1ae72e839b8c033a4c0f7d84122b5 = Mage::helper('sales')->__($ibcdf76f8c9ddc330c79f805116a8bb146c43749d712821c3a64ae4a252ded9f3deaaddb6e942d985->getLabel());
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749d35f7502d936f0fb94b528aa6d4fbaca3f779fa05->setTemplate(str_replace('{{order_status_name}}', $ibcdf76f8c9ddc330c79f805116a8bb146c43749d0bd865ed0ae1ae72e839b8c033a4c0f7d84122b5, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d35f7502d936f0fb94b528aa6d4fbaca3f779fa05->getTemplate()));
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749d35f7502d936f0fb94b528aa6d4fbaca3f779fa05->setTemplate2(str_replace('{{order_status_name}}', $ibcdf76f8c9ddc330c79f805116a8bb146c43749d0bd865ed0ae1ae72e839b8c033a4c0f7d84122b5, $ibcdf76f8c9ddc330c79f805116a8bb146c43749d35f7502d936f0fb94b528aa6d4fbaca3f779fa05->getTemplate2()));
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749da0b4e748647d3e52f7c9741d5f659711a2db6dc5 = $ibcdf76f8c9ddc330c79f805116a8bb146c43749d712821c3a64ae4a252ded9f3deaaddb6e942d985->getStatus();
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749da0b4e748647d3e52f7c9741d5f659711a2db6dc5 = preg_replace('/[^a-zA-Z0-9_]/', '_', $ibcdf76f8c9ddc330c79f805116a8bb146c43749da0b4e748647d3e52f7c9741d5f659711a2db6dc5);
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749da0b4e748647d3e52f7c9741d5f659711a2db6dc5 = preg_replace('/^([^a-zA-Z])/', 'x$1', $ibcdf76f8c9ddc330c79f805116a8bb146c43749da0b4e748647d3e52f7c9741d5f659711a2db6dc5);
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749d35f7502d936f0fb94b528aa6d4fbaca3f779fa05->setName('orderStatus' . uc_words($ibcdf76f8c9ddc330c79f805116a8bb146c43749da0b4e748647d3e52f7c9741d5f659711a2db6dc5, ''));
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749d35f7502d936f0fb94b528aa6d4fbaca3f779fa05->setStatusName($ibcdf76f8c9ddc330c79f805116a8bb146c43749d712821c3a64ae4a252ded9f3deaaddb6e942d985->getLabel());
                $if739aceffec69fa2733946a3d319defaa354082d[] = $ibcdf76f8c9ddc330c79f805116a8bb146c43749d35f7502d936f0fb94b528aa6d4fbaca3f779fa05;
            }
        } else {
            $i42ee48f418943c9662de0976069476c7dc8f620d = Mage::getModel('magesms/hooks');
            if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d30f20aafde612a957f7f966cb5b85e35782bc88a == 'customers') Mage::dispatchEvent('topefekt_magesms_customersms_hook', array('hook' => $i42ee48f418943c9662de0976069476c7dc8f620d, 'mutation' => $ibcdf76f8c9ddc330c79f805116a8bb146c43749d7137e40370cf1c5ccf937060891613788203e2d6)); else Mage::dispatchEvent('topefekt_magesms_adminsms_hook', array('hook' => $i42ee48f418943c9662de0976069476c7dc8f620d));
        }
        $ia61712c27ea241bd7a543dc2b02ea572274d0322 = array();
        foreach ($if739aceffec69fa2733946a3d319defaa354082d as $i42ee48f418943c9662de0976069476c7dc8f620d) {
            $ia61712c27ea241bd7a543dc2b02ea572274d0322[$i42ee48f418943c9662de0976069476c7dc8f620d->getName()] = $i42ee48f418943c9662de0976069476c7dc8f620d;
        }
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749d1ddb77d41f3678bb92f39c5c4d47aa6e58d4b89e = Mage::getSingleton('magesms/hooks_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749d30f20aafde612a957f7f966cb5b85e35782bc88a)->getCollection();
        if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d30f20aafde612a957f7f966cb5b85e35782bc88a == 'customers') $ibcdf76f8c9ddc330c79f805116a8bb146c43749d1ddb77d41f3678bb92f39c5c4d47aa6e58d4b89e->addFieldToFilter('mutation', $ibcdf76f8c9ddc330c79f805116a8bb146c43749d7137e40370cf1c5ccf937060891613788203e2d6);
        if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d1ddb77d41f3678bb92f39c5c4d47aa6e58d4b89e->count()) {
            foreach ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d1ddb77d41f3678bb92f39c5c4d47aa6e58d4b89e as $ibcdf76f8c9ddc330c79f805116a8bb146c43749d4df015c4c10bbcf1d38137f3659b01221d2dc076) {
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749d670253c23c6fcba76bc4256a88fdd8fbc1041039 = $ibcdf76f8c9ddc330c79f805116a8bb146c43749d4df015c4c10bbcf1d38137f3659b01221d2dc076->getName();
                if (isset($ia61712c27ea241bd7a543dc2b02ea572274d0322[$ibcdf76f8c9ddc330c79f805116a8bb146c43749d670253c23c6fcba76bc4256a88fdd8fbc1041039])) {
                    $ia61712c27ea241bd7a543dc2b02ea572274d0322[$ibcdf76f8c9ddc330c79f805116a8bb146c43749d670253c23c6fcba76bc4256a88fdd8fbc1041039]->setSmstext($ibcdf76f8c9ddc330c79f805116a8bb146c43749d4df015c4c10bbcf1d38137f3659b01221d2dc076->getSmstext());
                    if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d30f20aafde612a957f7f966cb5b85e35782bc88a == 'admins') {
                        $ia61712c27ea241bd7a543dc2b02ea572274d0322[$ibcdf76f8c9ddc330c79f805116a8bb146c43749d670253c23c6fcba76bc4256a88fdd8fbc1041039][$ibcdf76f8c9ddc330c79f805116a8bb146c43749d4df015c4c10bbcf1d38137f3659b01221d2dc076->getAdminId() . '_' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749d4df015c4c10bbcf1d38137f3659b01221d2dc076->getStoreGroupId()] = 1;
                        $ia61712c27ea241bd7a543dc2b02ea572274d0322[$ibcdf76f8c9ddc330c79f805116a8bb146c43749d670253c23c6fcba76bc4256a88fdd8fbc1041039]->setActive(1);
                    } else {
                        $ia61712c27ea241bd7a543dc2b02ea572274d0322[$ibcdf76f8c9ddc330c79f805116a8bb146c43749d670253c23c6fcba76bc4256a88fdd8fbc1041039]->setActive($ibcdf76f8c9ddc330c79f805116a8bb146c43749d4df015c4c10bbcf1d38137f3659b01221d2dc076->getActive());
                    }
                }
            }
        }
        return $ia61712c27ea241bd7a543dc2b02ea572274d0322;
    }

    public function hookVariablesJS($ibcdf76f8c9ddc330c79f805116a8bb146c43749ddfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa)
    {
        if (preg_match_all('/{(.*?)}/', $ibcdf76f8c9ddc330c79f805116a8bb146c43749ddfc9fbe8edf868c14fc4a3f15c7f40aabfa080aa, $ibcdf76f8c9ddc330c79f805116a8bb146c43749da00c63b7b8f0d76f361b9bd281e5073cc0d0aa3e)) {
            $ibcdf76f8c9ddc330c79f805116a8bb146c43749d0933475b5bd80561a9f50282fd9eb0b8345cec4b = array();
            foreach ($ibcdf76f8c9ddc330c79f805116a8bb146c43749da00c63b7b8f0d76f361b9bd281e5073cc0d0aa3e[1] as $ibcdf76f8c9ddc330c79f805116a8bb146c43749debd691e534c6cf2e84cf8a88790a5271154fca05) {
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749d0933475b5bd80561a9f50282fd9eb0b8345cec4b[$ibcdf76f8c9ddc330c79f805116a8bb146c43749debd691e534c6cf2e84cf8a88790a5271154fca05] = '{' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749debd691e534c6cf2e84cf8a88790a5271154fca05 . '}';
            }
            $ibcdf76f8c9ddc330c79f805116a8bb146c43749d322d20c6b1eb01ecb5d5801e003969fcc1f407a9 = Mage::getSingleton('magesms/variables')->getCollection()->addFieldToFilter('name', array('in' => array(array_keys($ibcdf76f8c9ddc330c79f805116a8bb146c43749d0933475b5bd80561a9f50282fd9eb0b8345cec4b))));
            foreach ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d322d20c6b1eb01ecb5d5801e003969fcc1f407a9 as $ibcdf76f8c9ddc330c79f805116a8bb146c43749debd691e534c6cf2e84cf8a88790a5271154fca05) {
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749d0933475b5bd80561a9f50282fd9eb0b8345cec4b[$ibcdf76f8c9ddc330c79f805116a8bb146c43749debd691e534c6cf2e84cf8a88790a5271154fca05->getName()] = $ibcdf76f8c9ddc330c79f805116a8bb146c43749debd691e534c6cf2e84cf8a88790a5271154fca05->getTemplate() ? Mage::helper('magesms')->__($ibcdf76f8c9ddc330c79f805116a8bb146c43749debd691e534c6cf2e84cf8a88790a5271154fca05->getTemplate()) : $ibcdf76f8c9ddc330c79f805116a8bb146c43749debd691e534c6cf2e84cf8a88790a5271154fca05->getTemplate();
            }
            $ibcdf76f8c9ddc330c79f805116a8bb146c43749d5528ed14b056e3debe4695094269de3a98f76fe7 = '';
            foreach ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d0933475b5bd80561a9f50282fd9eb0b8345cec4b as $ibcdf76f8c9ddc330c79f805116a8bb146c43749d670253c23c6fcba76bc4256a88fdd8fbc1041039 => $ibcdf76f8c9ddc330c79f805116a8bb146c43749df2eee0665f163a28f4adcfe84e3fc666bf1bcd89) {
                if (!empty($ibcdf76f8c9ddc330c79f805116a8bb146c43749d5528ed14b056e3debe4695094269de3a98f76fe7)) $ibcdf76f8c9ddc330c79f805116a8bb146c43749d5528ed14b056e3debe4695094269de3a98f76fe7 .= ', ';
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749d5528ed14b056e3debe4695094269de3a98f76fe7 .= $ibcdf76f8c9ddc330c79f805116a8bb146c43749d670253c23c6fcba76bc4256a88fdd8fbc1041039 . ': "' . $ibcdf76f8c9ddc330c79f805116a8bb146c43749df2eee0665f163a28f4adcfe84e3fc666bf1bcd89 . '"';
            }
            return $ibcdf76f8c9ddc330c79f805116a8bb146c43749d5528ed14b056e3debe4695094269de3a98f76fe7;
        }
    }

    public function filterDates($if66f788c75229f5f3ea1a622ab4dee258553c789, $ic78bc645a0f45c428f6551163ed2dce47dd289ee)
    {
        if (empty($ic78bc645a0f45c428f6551163ed2dce47dd289ee)) {
            return $if66f788c75229f5f3ea1a622ab4dee258553c789;
        }
        $i25d716f44b9a21507a214e968cc96805785eff97 = new Zend_Filter_LocalizedToNormalized(array('date_format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)));
        $id1da71c6f00d9b85058894facc6aae99ed82822c = new Zend_Filter_NormalizedToLocalized(array('date_format' => Varien_Date::DATE_INTERNAL_FORMAT));
        foreach ($ic78bc645a0f45c428f6551163ed2dce47dd289ee as $i36424a86007474ffc648c582cbfca240cda58c1e) {
            if (array_key_exists($i36424a86007474ffc648c582cbfca240cda58c1e, $if66f788c75229f5f3ea1a622ab4dee258553c789) && !empty($i36424a86007474ffc648c582cbfca240cda58c1e)) {
                $if66f788c75229f5f3ea1a622ab4dee258553c789[$i36424a86007474ffc648c582cbfca240cda58c1e] = $i25d716f44b9a21507a214e968cc96805785eff97->filter($if66f788c75229f5f3ea1a622ab4dee258553c789[$i36424a86007474ffc648c582cbfca240cda58c1e]);
                $if66f788c75229f5f3ea1a622ab4dee258553c789[$i36424a86007474ffc648c582cbfca240cda58c1e] = $id1da71c6f00d9b85058894facc6aae99ed82822c->filter($if66f788c75229f5f3ea1a622ab4dee258553c789[$i36424a86007474ffc648c582cbfca240cda58c1e]);
            }
        }
        return $if66f788c75229f5f3ea1a622ab4dee258553c789;
    }

    public function getCustomerCollection()
    {
        $iff7e46827cbb6547116c592bf800f4687428abf9 = Mage::getResourceModel('customer/customer_collection')->addNameToSelect()->joinAttribute('billing_telephone', 'customer_address/telephone', 'default_billing', null, 'left')->joinAttribute('shipping_telephone', 'customer_address/telephone', 'default_shipping', null, 'left')->joinAttribute('billing_city', 'customer_address/city', 'default_billing', null, 'left')->joinAttribute('billing_country_id', 'customer_address/country_id', 'default_billing', null, 'left')->joinAttribute('shipping_country_id', 'customer_address/country_id', 'default_shipping', null, 'left')->addFieldToFilter(array(array('attribute' => 'billing_telephone', array(array('notnull' => true), array('neq' => ''))), array('attribute' => 'shipping_telephone', array(array('notnull' => true), array('neq' => '')))));
        if (version_compare(Mage::getVersion(), '1.6', '>=')) {
            $iff7e46827cbb6547116c592bf800f4687428abf9->getSelect()->columns('IF(`at_shipping_telephone`.`value`, `at_shipping_telephone`.`value`, `at_billing_telephone`.`value`) AS telephone');
            $iff7e46827cbb6547116c592bf800f4687428abf9->getSelect()->columns('IF(`at_shipping_country_id`.`value`, `at_shipping_country_id`.`value`, `at_billing_country_id`.`value`) AS country_id');
        } else {
            $iff7e46827cbb6547116c592bf800f4687428abf9->getSelect()->columns('IF(`_table_shipping_telephone`.`value`, `_table_shipping_telephone`.`value`, `_table_billing_telephone`.`value`) AS telephone');
            $iff7e46827cbb6547116c592bf800f4687428abf9->getSelect()->columns('IF(`_table_shipping_country_id`.`value`, `_table_shipping_country_id`.`value`, `_table_billing_country_id`.`value`) AS country_id');
        }
        return $iff7e46827cbb6547116c592bf800f4687428abf9;
    }

    public function addOptoutProduct($i7fff76b02be2f63877a1782ca871e62a287fa16f = false)
    {
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b = $this->getOptoutProduct();
        if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b) {
            if ($i7fff76b02be2f63877a1782ca871e62a287fa16f) {
                $i32bd8782f9db301dda31691016fa281ffd5c7c36 = Mage::getResourceModel('catalog/product')->getAttributeRawValue($ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b->getId(), 'magesms_optout', Mage::app()->getStore()->getId());
                if (!$i32bd8782f9db301dda31691016fa281ffd5c7c36) return $this;
            }
            $ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b->setStoreId(Mage::app()->getStore()->getId());
            $ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b->load($ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b->getId());
            if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b->getStatus() == Mage_Catalog_Model_Product_Status::STATUS_ENABLED) {
                $i45b08fe558d3b8e0743a1b58de231fa7ffc6c495 = Mage::getSingleton('checkout/cart');
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749d12f98417e3df53ca8bc49671d89c1a89cdceeb8b = $i45b08fe558d3b8e0743a1b58de231fa7ffc6c495->getItems();
                $ibcdf76f8c9ddc330c79f805116a8bb146c43749ddd690844e5b6fae774e02ace13c0608c4bd6bfbc = false;
                foreach ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d12f98417e3df53ca8bc49671d89c1a89cdceeb8b as $ibcdf76f8c9ddc330c79f805116a8bb146c43749d705fa7c9639d497e1179d7d5691c212668a8c9c8) {
                    if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d705fa7c9639d497e1179d7d5691c212668a8c9c8->getSku() == Mage::getConfig()->getNode('default/config/optout')->sku) {
                        $ibcdf76f8c9ddc330c79f805116a8bb146c43749ddd690844e5b6fae774e02ace13c0608c4bd6bfbc = true;
                        break;
                    }
                }
                if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749ddd690844e5b6fae774e02ace13c0608c4bd6bfbc === false) {
                    $i45b08fe558d3b8e0743a1b58de231fa7ffc6c495->init();
                    $i45b08fe558d3b8e0743a1b58de231fa7ffc6c495->addProduct($ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b, array('qty' => 1));
                    $i45b08fe558d3b8e0743a1b58de231fa7ffc6c495->save();
                    $ibcdf76f8c9ddc330c79f805116a8bb146c43749d0e3e80cee9c51f140b823db0b7df66493acca657 = Mage::getSingleton('checkout/session');
                    $ibcdf76f8c9ddc330c79f805116a8bb146c43749d0e3e80cee9c51f140b823db0b7df66493acca657->setCartWasUpdated(true);
                    $ibcdf76f8c9ddc330c79f805116a8bb146c43749d8091f3f14f616f7c7725a766ecf5f3d4a561a828 = Mage::helper('checkout')->__('%s was added to your shopping cart.', Mage::helper('core')->escapeHtml($ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b->getName()));
                    $ibcdf76f8c9ddc330c79f805116a8bb146c43749d0e3e80cee9c51f140b823db0b7df66493acca657->addSuccess($ibcdf76f8c9ddc330c79f805116a8bb146c43749d8091f3f14f616f7c7725a766ecf5f3d4a561a828);
                }
            }
        }
        return $this;
    }

    public function removeOptoutProduct($i7fff76b02be2f63877a1782ca871e62a287fa16f = false)
    {
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b = $this->getOptoutProduct();
        if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b) {
            $i45b08fe558d3b8e0743a1b58de231fa7ffc6c495 = Mage::getSingleton('checkout/cart');
            $ibcdf76f8c9ddc330c79f805116a8bb146c43749d705fa7c9639d497e1179d7d5691c212668a8c9c8 = $i45b08fe558d3b8e0743a1b58de231fa7ffc6c495->getQuote()->getItemByProduct($ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b);
            if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d705fa7c9639d497e1179d7d5691c212668a8c9c8 && !$i7fff76b02be2f63877a1782ca871e62a287fa16f || $ibcdf76f8c9ddc330c79f805116a8bb146c43749d705fa7c9639d497e1179d7d5691c212668a8c9c8 && $i45b08fe558d3b8e0743a1b58de231fa7ffc6c495->getItemsCount() == 2) {
                $i45b08fe558d3b8e0743a1b58de231fa7ffc6c495->removeItem($ibcdf76f8c9ddc330c79f805116a8bb146c43749d705fa7c9639d497e1179d7d5691c212668a8c9c8->getId());
                $i45b08fe558d3b8e0743a1b58de231fa7ffc6c495->save();
            }
        }
    }

    public function getOptoutProduct()
    {
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749dc010a5d08128ec6abcd0a1a16cb1d8abe7bf2142 = Mage::getConfig()->getNode('default/config/optout')->sku;
        $ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b = Mage::getModel('catalog/product')->loadByAttribute('sku', $ibcdf76f8c9ddc330c79f805116a8bb146c43749dc010a5d08128ec6abcd0a1a16cb1d8abe7bf2142);
        if ($ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b && $ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b->getStatus() == Mage_Catalog_Model_Product_Status::STATUS_ENABLED) return $ibcdf76f8c9ddc330c79f805116a8bb146c43749d69a1201e93806d55c970dfb18feec53d221ba37b;
    }
}