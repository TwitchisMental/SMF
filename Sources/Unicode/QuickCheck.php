<?php

/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines https://www.simplemachines.org
 * @copyright 2022 Simple Machines and individual contributors
 * @license https://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.1.0
 */

if (!defined('SMF'))
	die('No direct access...');

/**
 * Helper function for utf8_is_normalized.
 *
 * Character class lists compiled from:
 * https://unicode.org/Public/UNIDATA/extracted/DerivedNormalizationProps.txt
 *
 * Developers: Do not update the data in this function manually. Instead,
 * run "php -f other/update_unicode_data.php" on the command line.
 *
 * @return array Character classes for disallowed characters in normalization forms.
 */
function utf8_regex_quick_check()
{
	return array(
		'NFC_QC' =>
			'\x{0340}-\x{0341}' .
			'\x{0343}-\x{0344}' .
			'\x{0374}' .
			'\x{037E}' .
			'\x{0387}' .
			'\x{0958}-\x{095F}' .
			'\x{09DC}-\x{09DD}' .
			'\x{09DF}' .
			'\x{0A33}' .
			'\x{0A36}' .
			'\x{0A59}-\x{0A5B}' .
			'\x{0A5E}' .
			'\x{0B5C}-\x{0B5D}' .
			'\x{0F43}' .
			'\x{0F4D}' .
			'\x{0F52}' .
			'\x{0F57}' .
			'\x{0F5C}' .
			'\x{0F69}' .
			'\x{0F73}' .
			'\x{0F75}-\x{0F76}' .
			'\x{0F78}' .
			'\x{0F81}' .
			'\x{0F93}' .
			'\x{0F9D}' .
			'\x{0FA2}' .
			'\x{0FA7}' .
			'\x{0FAC}' .
			'\x{0FB9}' .
			'\x{1F71}' .
			'\x{1F73}' .
			'\x{1F75}' .
			'\x{1F77}' .
			'\x{1F79}' .
			'\x{1F7B}' .
			'\x{1F7D}' .
			'\x{1FBB}' .
			'\x{1FBE}' .
			'\x{1FC9}' .
			'\x{1FCB}' .
			'\x{1FD3}' .
			'\x{1FDB}' .
			'\x{1FE3}' .
			'\x{1FEB}' .
			'\x{1FEE}-\x{1FEF}' .
			'\x{1FF9}' .
			'\x{1FFB}' .
			'\x{1FFD}' .
			'\x{2000}-\x{2001}' .
			'\x{2126}' .
			'\x{212A}-\x{212B}' .
			'\x{2329}-\x{232A}' .
			'\x{2ADC}' .
			'\x{F900}-\x{FA0D}' .
			'\x{FA10}' .
			'\x{FA12}' .
			'\x{FA15}-\x{FA1E}' .
			'\x{FA20}' .
			'\x{FA22}' .
			'\x{FA25}-\x{FA26}' .
			'\x{FA2A}-\x{FA6D}' .
			'\x{FA70}-\x{FAD9}' .
			'\x{FB1D}' .
			'\x{FB1F}' .
			'\x{FB2A}-\x{FB36}' .
			'\x{FB38}-\x{FB3C}' .
			'\x{FB3E}' .
			'\x{FB40}-\x{FB41}' .
			'\x{FB43}-\x{FB44}' .
			'\x{FB46}-\x{FB4E}' .
			'\x{1D15E}-\x{1D164}' .
			'\x{1D1BB}-\x{1D1C0}' .
			'\x{2F800}-\x{2FA1D}' .
			'\x{0300}-\x{0304}' .
			'\x{0306}-\x{030C}' .
			'\x{030F}' .
			'\x{0311}' .
			'\x{0313}-\x{0314}' .
			'\x{031B}' .
			'\x{0323}-\x{0328}' .
			'\x{032D}-\x{032E}' .
			'\x{0330}-\x{0331}' .
			'\x{0338}' .
			'\x{0342}' .
			'\x{0345}' .
			'\x{0653}-\x{0655}' .
			'\x{093C}' .
			'\x{09BE}' .
			'\x{09D7}' .
			'\x{0B3E}' .
			'\x{0B56}-\x{0B57}' .
			'\x{0BBE}' .
			'\x{0BD7}' .
			'\x{0C56}' .
			'\x{0CC2}' .
			'\x{0CD5}-\x{0CD6}' .
			'\x{0D3E}' .
			'\x{0D57}' .
			'\x{0DCA}' .
			'\x{0DCF}' .
			'\x{0DDF}' .
			'\x{102E}' .
			'\x{1161}-\x{1175}' .
			'\x{11A8}-\x{11C2}' .
			'\x{1B35}' .
			'\x{3099}-\x{309A}' .
			'\x{110BA}' .
			'\x{11127}' .
			'\x{1133E}' .
			'\x{11357}' .
			'\x{114B0}' .
			'\x{114BA}' .
			'\x{114BD}' .
			'\x{115AF}' .
			'\x{11930}',
		'NFKC_QC' =>
			'\x{00A0}' .
			'\x{00A8}' .
			'\x{00AA}' .
			'\x{00AF}' .
			'\x{00B2}-\x{00B5}' .
			'\x{00B8}-\x{00BA}' .
			'\x{00BC}-\x{00BE}' .
			'\x{0132}-\x{0133}' .
			'\x{013F}-\x{0140}' .
			'\x{0149}' .
			'\x{017F}' .
			'\x{01C4}-\x{01CC}' .
			'\x{01F1}-\x{01F3}' .
			'\x{02B0}-\x{02B8}' .
			'\x{02D8}-\x{02DD}' .
			'\x{02E0}-\x{02E4}' .
			'\x{0340}-\x{0341}' .
			'\x{0343}-\x{0344}' .
			'\x{0374}' .
			'\x{037A}' .
			'\x{037E}' .
			'\x{0384}-\x{0385}' .
			'\x{0387}' .
			'\x{03D0}-\x{03D6}' .
			'\x{03F0}-\x{03F2}' .
			'\x{03F4}-\x{03F5}' .
			'\x{03F9}' .
			'\x{0587}' .
			'\x{0675}-\x{0678}' .
			'\x{0958}-\x{095F}' .
			'\x{09DC}-\x{09DD}' .
			'\x{09DF}' .
			'\x{0A33}' .
			'\x{0A36}' .
			'\x{0A59}-\x{0A5B}' .
			'\x{0A5E}' .
			'\x{0B5C}-\x{0B5D}' .
			'\x{0E33}' .
			'\x{0EB3}' .
			'\x{0EDC}-\x{0EDD}' .
			'\x{0F0C}' .
			'\x{0F43}' .
			'\x{0F4D}' .
			'\x{0F52}' .
			'\x{0F57}' .
			'\x{0F5C}' .
			'\x{0F69}' .
			'\x{0F73}' .
			'\x{0F75}-\x{0F79}' .
			'\x{0F81}' .
			'\x{0F93}' .
			'\x{0F9D}' .
			'\x{0FA2}' .
			'\x{0FA7}' .
			'\x{0FAC}' .
			'\x{0FB9}' .
			'\x{10FC}' .
			'\x{1D2C}-\x{1D2E}' .
			'\x{1D30}-\x{1D3A}' .
			'\x{1D3C}-\x{1D4D}' .
			'\x{1D4F}-\x{1D6A}' .
			'\x{1D78}' .
			'\x{1D9B}-\x{1DBF}' .
			'\x{1E9A}-\x{1E9B}' .
			'\x{1F71}' .
			'\x{1F73}' .
			'\x{1F75}' .
			'\x{1F77}' .
			'\x{1F79}' .
			'\x{1F7B}' .
			'\x{1F7D}' .
			'\x{1FBB}' .
			'\x{1FBD}-\x{1FC1}' .
			'\x{1FC9}' .
			'\x{1FCB}' .
			'\x{1FCD}-\x{1FCF}' .
			'\x{1FD3}' .
			'\x{1FDB}' .
			'\x{1FDD}-\x{1FDF}' .
			'\x{1FE3}' .
			'\x{1FEB}' .
			'\x{1FED}-\x{1FEF}' .
			'\x{1FF9}' .
			'\x{1FFB}' .
			'\x{1FFD}-\x{1FFE}' .
			'\x{2000}-\x{200A}' .
			'\x{2011}' .
			'\x{2017}' .
			'\x{2024}-\x{2026}' .
			'\x{202F}' .
			'\x{2033}-\x{2034}' .
			'\x{2036}-\x{2037}' .
			'\x{203C}' .
			'\x{203E}' .
			'\x{2047}-\x{2049}' .
			'\x{2057}' .
			'\x{205F}' .
			'\x{2070}-\x{2071}' .
			'\x{2074}-\x{208E}' .
			'\x{2090}-\x{209C}' .
			'\x{20A8}' .
			'\x{2100}-\x{2103}' .
			'\x{2105}-\x{2107}' .
			'\x{2109}-\x{2113}' .
			'\x{2115}-\x{2116}' .
			'\x{2119}-\x{211D}' .
			'\x{2120}-\x{2122}' .
			'\x{2124}' .
			'\x{2126}' .
			'\x{2128}' .
			'\x{212A}-\x{212D}' .
			'\x{212F}-\x{2131}' .
			'\x{2133}-\x{2139}' .
			'\x{213B}-\x{2140}' .
			'\x{2145}-\x{2149}' .
			'\x{2150}-\x{217F}' .
			'\x{2189}' .
			'\x{222C}-\x{222D}' .
			'\x{222F}-\x{2230}' .
			'\x{2329}-\x{232A}' .
			'\x{2460}-\x{24EA}' .
			'\x{2A0C}' .
			'\x{2A74}-\x{2A76}' .
			'\x{2ADC}' .
			'\x{2C7C}-\x{2C7D}' .
			'\x{2D6F}' .
			'\x{2E9F}' .
			'\x{2EF3}' .
			'\x{2F00}-\x{2FD5}' .
			'\x{3000}' .
			'\x{3036}' .
			'\x{3038}-\x{303A}' .
			'\x{309B}-\x{309C}' .
			'\x{309F}' .
			'\x{30FF}' .
			'\x{3131}-\x{318E}' .
			'\x{3192}-\x{319F}' .
			'\x{3200}-\x{321E}' .
			'\x{3220}-\x{3247}' .
			'\x{3250}-\x{327E}' .
			'\x{3280}-\x{33FF}' .
			'\x{A69C}-\x{A69D}' .
			'\x{A770}' .
			'\x{A7F2}-\x{A7F4}' .
			'\x{A7F8}-\x{A7F9}' .
			'\x{AB5C}-\x{AB5F}' .
			'\x{AB69}' .
			'\x{F900}-\x{FA0D}' .
			'\x{FA10}' .
			'\x{FA12}' .
			'\x{FA15}-\x{FA1E}' .
			'\x{FA20}' .
			'\x{FA22}' .
			'\x{FA25}-\x{FA26}' .
			'\x{FA2A}-\x{FA6D}' .
			'\x{FA70}-\x{FAD9}' .
			'\x{FB00}-\x{FB06}' .
			'\x{FB13}-\x{FB17}' .
			'\x{FB1D}' .
			'\x{FB1F}-\x{FB36}' .
			'\x{FB38}-\x{FB3C}' .
			'\x{FB3E}' .
			'\x{FB40}-\x{FB41}' .
			'\x{FB43}-\x{FB44}' .
			'\x{FB46}-\x{FBB1}' .
			'\x{FBD3}-\x{FD3D}' .
			'\x{FD50}-\x{FD8F}' .
			'\x{FD92}-\x{FDC7}' .
			'\x{FDF0}-\x{FDFC}' .
			'\x{FE10}-\x{FE19}' .
			'\x{FE30}-\x{FE44}' .
			'\x{FE47}-\x{FE52}' .
			'\x{FE54}-\x{FE66}' .
			'\x{FE68}-\x{FE6B}' .
			'\x{FE70}-\x{FE72}' .
			'\x{FE74}' .
			'\x{FE76}-\x{FEFC}' .
			'\x{FF01}-\x{FFBE}' .
			'\x{FFC2}-\x{FFC7}' .
			'\x{FFCA}-\x{FFCF}' .
			'\x{FFD2}-\x{FFD7}' .
			'\x{FFDA}-\x{FFDC}' .
			'\x{FFE0}-\x{FFE6}' .
			'\x{FFE8}-\x{FFEE}' .
			'\x{10781}-\x{10785}' .
			'\x{10787}-\x{107B0}' .
			'\x{107B2}-\x{107BA}' .
			'\x{1D15E}-\x{1D164}' .
			'\x{1D1BB}-\x{1D1C0}' .
			'\x{1D400}-\x{1D454}' .
			'\x{1D456}-\x{1D49C}' .
			'\x{1D49E}-\x{1D49F}' .
			'\x{1D4A2}' .
			'\x{1D4A5}-\x{1D4A6}' .
			'\x{1D4A9}-\x{1D4AC}' .
			'\x{1D4AE}-\x{1D4B9}' .
			'\x{1D4BB}' .
			'\x{1D4BD}-\x{1D4C3}' .
			'\x{1D4C5}-\x{1D505}' .
			'\x{1D507}-\x{1D50A}' .
			'\x{1D50D}-\x{1D514}' .
			'\x{1D516}-\x{1D51C}' .
			'\x{1D51E}-\x{1D539}' .
			'\x{1D53B}-\x{1D53E}' .
			'\x{1D540}-\x{1D544}' .
			'\x{1D546}' .
			'\x{1D54A}-\x{1D550}' .
			'\x{1D552}-\x{1D6A5}' .
			'\x{1D6A8}-\x{1D7CB}' .
			'\x{1D7CE}-\x{1D7FF}' .
			'\x{1E030}-\x{1E06D}' .
			'\x{1EE00}-\x{1EE03}' .
			'\x{1EE05}-\x{1EE1F}' .
			'\x{1EE21}-\x{1EE22}' .
			'\x{1EE24}' .
			'\x{1EE27}' .
			'\x{1EE29}-\x{1EE32}' .
			'\x{1EE34}-\x{1EE37}' .
			'\x{1EE39}' .
			'\x{1EE3B}' .
			'\x{1EE42}' .
			'\x{1EE47}' .
			'\x{1EE49}' .
			'\x{1EE4B}' .
			'\x{1EE4D}-\x{1EE4F}' .
			'\x{1EE51}-\x{1EE52}' .
			'\x{1EE54}' .
			'\x{1EE57}' .
			'\x{1EE59}' .
			'\x{1EE5B}' .
			'\x{1EE5D}' .
			'\x{1EE5F}' .
			'\x{1EE61}-\x{1EE62}' .
			'\x{1EE64}' .
			'\x{1EE67}-\x{1EE6A}' .
			'\x{1EE6C}-\x{1EE72}' .
			'\x{1EE74}-\x{1EE77}' .
			'\x{1EE79}-\x{1EE7C}' .
			'\x{1EE7E}' .
			'\x{1EE80}-\x{1EE89}' .
			'\x{1EE8B}-\x{1EE9B}' .
			'\x{1EEA1}-\x{1EEA3}' .
			'\x{1EEA5}-\x{1EEA9}' .
			'\x{1EEAB}-\x{1EEBB}' .
			'\x{1F100}-\x{1F10A}' .
			'\x{1F110}-\x{1F12E}' .
			'\x{1F130}-\x{1F14F}' .
			'\x{1F16A}-\x{1F16C}' .
			'\x{1F190}' .
			'\x{1F200}-\x{1F202}' .
			'\x{1F210}-\x{1F23B}' .
			'\x{1F240}-\x{1F248}' .
			'\x{1F250}-\x{1F251}' .
			'\x{1FBF0}-\x{1FBF9}' .
			'\x{2F800}-\x{2FA1D}' .
			'\x{0300}-\x{0304}' .
			'\x{0306}-\x{030C}' .
			'\x{030F}' .
			'\x{0311}' .
			'\x{0313}-\x{0314}' .
			'\x{031B}' .
			'\x{0323}-\x{0328}' .
			'\x{032D}-\x{032E}' .
			'\x{0330}-\x{0331}' .
			'\x{0338}' .
			'\x{0342}' .
			'\x{0345}' .
			'\x{0653}-\x{0655}' .
			'\x{093C}' .
			'\x{09BE}' .
			'\x{09D7}' .
			'\x{0B3E}' .
			'\x{0B56}-\x{0B57}' .
			'\x{0BBE}' .
			'\x{0BD7}' .
			'\x{0C56}' .
			'\x{0CC2}' .
			'\x{0CD5}-\x{0CD6}' .
			'\x{0D3E}' .
			'\x{0D57}' .
			'\x{0DCA}' .
			'\x{0DCF}' .
			'\x{0DDF}' .
			'\x{102E}' .
			'\x{1161}-\x{1175}' .
			'\x{11A8}-\x{11C2}' .
			'\x{1B35}' .
			'\x{3099}-\x{309A}' .
			'\x{110BA}' .
			'\x{11127}' .
			'\x{1133E}' .
			'\x{11357}' .
			'\x{114B0}' .
			'\x{114BA}' .
			'\x{114BD}' .
			'\x{115AF}' .
			'\x{11930}',
		'NFD_QC' =>
			'\x{00C0}-\x{00C5}' .
			'\x{00C7}-\x{00CF}' .
			'\x{00D1}-\x{00D6}' .
			'\x{00D9}-\x{00DD}' .
			'\x{00E0}-\x{00E5}' .
			'\x{00E7}-\x{00EF}' .
			'\x{00F1}-\x{00F6}' .
			'\x{00F9}-\x{00FD}' .
			'\x{00FF}-\x{010F}' .
			'\x{0112}-\x{0125}' .
			'\x{0128}-\x{0130}' .
			'\x{0134}-\x{0137}' .
			'\x{0139}-\x{013E}' .
			'\x{0143}-\x{0148}' .
			'\x{014C}-\x{0151}' .
			'\x{0154}-\x{0165}' .
			'\x{0168}-\x{017E}' .
			'\x{01A0}-\x{01A1}' .
			'\x{01AF}-\x{01B0}' .
			'\x{01CD}-\x{01DC}' .
			'\x{01DE}-\x{01E3}' .
			'\x{01E6}-\x{01F0}' .
			'\x{01F4}-\x{01F5}' .
			'\x{01F8}-\x{021B}' .
			'\x{021E}-\x{021F}' .
			'\x{0226}-\x{0233}' .
			'\x{0340}-\x{0341}' .
			'\x{0343}-\x{0344}' .
			'\x{0374}' .
			'\x{037E}' .
			'\x{0385}-\x{038A}' .
			'\x{038C}' .
			'\x{038E}-\x{0390}' .
			'\x{03AA}-\x{03B0}' .
			'\x{03CA}-\x{03CE}' .
			'\x{03D3}-\x{03D4}' .
			'\x{0400}-\x{0401}' .
			'\x{0403}' .
			'\x{0407}' .
			'\x{040C}-\x{040E}' .
			'\x{0419}' .
			'\x{0439}' .
			'\x{0450}-\x{0451}' .
			'\x{0453}' .
			'\x{0457}' .
			'\x{045C}-\x{045E}' .
			'\x{0476}-\x{0477}' .
			'\x{04C1}-\x{04C2}' .
			'\x{04D0}-\x{04D3}' .
			'\x{04D6}-\x{04D7}' .
			'\x{04DA}-\x{04DF}' .
			'\x{04E2}-\x{04E7}' .
			'\x{04EA}-\x{04F5}' .
			'\x{04F8}-\x{04F9}' .
			'\x{0622}-\x{0626}' .
			'\x{06C0}' .
			'\x{06C2}' .
			'\x{06D3}' .
			'\x{0929}' .
			'\x{0931}' .
			'\x{0934}' .
			'\x{0958}-\x{095F}' .
			'\x{09CB}-\x{09CC}' .
			'\x{09DC}-\x{09DD}' .
			'\x{09DF}' .
			'\x{0A33}' .
			'\x{0A36}' .
			'\x{0A59}-\x{0A5B}' .
			'\x{0A5E}' .
			'\x{0B48}' .
			'\x{0B4B}-\x{0B4C}' .
			'\x{0B5C}-\x{0B5D}' .
			'\x{0B94}' .
			'\x{0BCA}-\x{0BCC}' .
			'\x{0C48}' .
			'\x{0CC0}' .
			'\x{0CC7}-\x{0CC8}' .
			'\x{0CCA}-\x{0CCB}' .
			'\x{0D4A}-\x{0D4C}' .
			'\x{0DDA}' .
			'\x{0DDC}-\x{0DDE}' .
			'\x{0F43}' .
			'\x{0F4D}' .
			'\x{0F52}' .
			'\x{0F57}' .
			'\x{0F5C}' .
			'\x{0F69}' .
			'\x{0F73}' .
			'\x{0F75}-\x{0F76}' .
			'\x{0F78}' .
			'\x{0F81}' .
			'\x{0F93}' .
			'\x{0F9D}' .
			'\x{0FA2}' .
			'\x{0FA7}' .
			'\x{0FAC}' .
			'\x{0FB9}' .
			'\x{1026}' .
			'\x{1B06}' .
			'\x{1B08}' .
			'\x{1B0A}' .
			'\x{1B0C}' .
			'\x{1B0E}' .
			'\x{1B12}' .
			'\x{1B3B}' .
			'\x{1B3D}' .
			'\x{1B40}-\x{1B41}' .
			'\x{1B43}' .
			'\x{1E00}-\x{1E99}' .
			'\x{1E9B}' .
			'\x{1EA0}-\x{1EF9}' .
			'\x{1F00}-\x{1F15}' .
			'\x{1F18}-\x{1F1D}' .
			'\x{1F20}-\x{1F45}' .
			'\x{1F48}-\x{1F4D}' .
			'\x{1F50}-\x{1F57}' .
			'\x{1F59}' .
			'\x{1F5B}' .
			'\x{1F5D}' .
			'\x{1F5F}-\x{1F7D}' .
			'\x{1F80}-\x{1FB4}' .
			'\x{1FB6}-\x{1FBC}' .
			'\x{1FBE}' .
			'\x{1FC1}-\x{1FC4}' .
			'\x{1FC6}-\x{1FD3}' .
			'\x{1FD6}-\x{1FDB}' .
			'\x{1FDD}-\x{1FEF}' .
			'\x{1FF2}-\x{1FF4}' .
			'\x{1FF6}-\x{1FFD}' .
			'\x{2000}-\x{2001}' .
			'\x{2126}' .
			'\x{212A}-\x{212B}' .
			'\x{219A}-\x{219B}' .
			'\x{21AE}' .
			'\x{21CD}-\x{21CF}' .
			'\x{2204}' .
			'\x{2209}' .
			'\x{220C}' .
			'\x{2224}' .
			'\x{2226}' .
			'\x{2241}' .
			'\x{2244}' .
			'\x{2247}' .
			'\x{2249}' .
			'\x{2260}' .
			'\x{2262}' .
			'\x{226D}-\x{2271}' .
			'\x{2274}-\x{2275}' .
			'\x{2278}-\x{2279}' .
			'\x{2280}-\x{2281}' .
			'\x{2284}-\x{2285}' .
			'\x{2288}-\x{2289}' .
			'\x{22AC}-\x{22AF}' .
			'\x{22E0}-\x{22E3}' .
			'\x{22EA}-\x{22ED}' .
			'\x{2329}-\x{232A}' .
			'\x{2ADC}' .
			'\x{304C}' .
			'\x{304E}' .
			'\x{3050}' .
			'\x{3052}' .
			'\x{3054}' .
			'\x{3056}' .
			'\x{3058}' .
			'\x{305A}' .
			'\x{305C}' .
			'\x{305E}' .
			'\x{3060}' .
			'\x{3062}' .
			'\x{3065}' .
			'\x{3067}' .
			'\x{3069}' .
			'\x{3070}-\x{3071}' .
			'\x{3073}-\x{3074}' .
			'\x{3076}-\x{3077}' .
			'\x{3079}-\x{307A}' .
			'\x{307C}-\x{307D}' .
			'\x{3094}' .
			'\x{309E}' .
			'\x{30AC}' .
			'\x{30AE}' .
			'\x{30B0}' .
			'\x{30B2}' .
			'\x{30B4}' .
			'\x{30B6}' .
			'\x{30B8}' .
			'\x{30BA}' .
			'\x{30BC}' .
			'\x{30BE}' .
			'\x{30C0}' .
			'\x{30C2}' .
			'\x{30C5}' .
			'\x{30C7}' .
			'\x{30C9}' .
			'\x{30D0}-\x{30D1}' .
			'\x{30D3}-\x{30D4}' .
			'\x{30D6}-\x{30D7}' .
			'\x{30D9}-\x{30DA}' .
			'\x{30DC}-\x{30DD}' .
			'\x{30F4}' .
			'\x{30F7}-\x{30FA}' .
			'\x{30FE}' .
			'\x{AC00}-\x{D7A3}' .
			'\x{F900}-\x{FA0D}' .
			'\x{FA10}' .
			'\x{FA12}' .
			'\x{FA15}-\x{FA1E}' .
			'\x{FA20}' .
			'\x{FA22}' .
			'\x{FA25}-\x{FA26}' .
			'\x{FA2A}-\x{FA6D}' .
			'\x{FA70}-\x{FAD9}' .
			'\x{FB1D}' .
			'\x{FB1F}' .
			'\x{FB2A}-\x{FB36}' .
			'\x{FB38}-\x{FB3C}' .
			'\x{FB3E}' .
			'\x{FB40}-\x{FB41}' .
			'\x{FB43}-\x{FB44}' .
			'\x{FB46}-\x{FB4E}' .
			'\x{1109A}' .
			'\x{1109C}' .
			'\x{110AB}' .
			'\x{1112E}-\x{1112F}' .
			'\x{1134B}-\x{1134C}' .
			'\x{114BB}-\x{114BC}' .
			'\x{114BE}' .
			'\x{115BA}-\x{115BB}' .
			'\x{11938}' .
			'\x{1D15E}-\x{1D164}' .
			'\x{1D1BB}-\x{1D1C0}' .
			'\x{2F800}-\x{2FA1D}',
		'NFKD_QC' =>
			'\x{00A0}' .
			'\x{00A8}' .
			'\x{00AA}' .
			'\x{00AF}' .
			'\x{00B2}-\x{00B5}' .
			'\x{00B8}-\x{00BA}' .
			'\x{00BC}-\x{00BE}' .
			'\x{00C0}-\x{00C5}' .
			'\x{00C7}-\x{00CF}' .
			'\x{00D1}-\x{00D6}' .
			'\x{00D9}-\x{00DD}' .
			'\x{00E0}-\x{00E5}' .
			'\x{00E7}-\x{00EF}' .
			'\x{00F1}-\x{00F6}' .
			'\x{00F9}-\x{00FD}' .
			'\x{00FF}-\x{010F}' .
			'\x{0112}-\x{0125}' .
			'\x{0128}-\x{0130}' .
			'\x{0132}-\x{0137}' .
			'\x{0139}-\x{0140}' .
			'\x{0143}-\x{0149}' .
			'\x{014C}-\x{0151}' .
			'\x{0154}-\x{0165}' .
			'\x{0168}-\x{017F}' .
			'\x{01A0}-\x{01A1}' .
			'\x{01AF}-\x{01B0}' .
			'\x{01C4}-\x{01DC}' .
			'\x{01DE}-\x{01E3}' .
			'\x{01E6}-\x{01F5}' .
			'\x{01F8}-\x{021B}' .
			'\x{021E}-\x{021F}' .
			'\x{0226}-\x{0233}' .
			'\x{02B0}-\x{02B8}' .
			'\x{02D8}-\x{02DD}' .
			'\x{02E0}-\x{02E4}' .
			'\x{0340}-\x{0341}' .
			'\x{0343}-\x{0344}' .
			'\x{0374}' .
			'\x{037A}' .
			'\x{037E}' .
			'\x{0384}-\x{038A}' .
			'\x{038C}' .
			'\x{038E}-\x{0390}' .
			'\x{03AA}-\x{03B0}' .
			'\x{03CA}-\x{03CE}' .
			'\x{03D0}-\x{03D6}' .
			'\x{03F0}-\x{03F2}' .
			'\x{03F4}-\x{03F5}' .
			'\x{03F9}' .
			'\x{0400}-\x{0401}' .
			'\x{0403}' .
			'\x{0407}' .
			'\x{040C}-\x{040E}' .
			'\x{0419}' .
			'\x{0439}' .
			'\x{0450}-\x{0451}' .
			'\x{0453}' .
			'\x{0457}' .
			'\x{045C}-\x{045E}' .
			'\x{0476}-\x{0477}' .
			'\x{04C1}-\x{04C2}' .
			'\x{04D0}-\x{04D3}' .
			'\x{04D6}-\x{04D7}' .
			'\x{04DA}-\x{04DF}' .
			'\x{04E2}-\x{04E7}' .
			'\x{04EA}-\x{04F5}' .
			'\x{04F8}-\x{04F9}' .
			'\x{0587}' .
			'\x{0622}-\x{0626}' .
			'\x{0675}-\x{0678}' .
			'\x{06C0}' .
			'\x{06C2}' .
			'\x{06D3}' .
			'\x{0929}' .
			'\x{0931}' .
			'\x{0934}' .
			'\x{0958}-\x{095F}' .
			'\x{09CB}-\x{09CC}' .
			'\x{09DC}-\x{09DD}' .
			'\x{09DF}' .
			'\x{0A33}' .
			'\x{0A36}' .
			'\x{0A59}-\x{0A5B}' .
			'\x{0A5E}' .
			'\x{0B48}' .
			'\x{0B4B}-\x{0B4C}' .
			'\x{0B5C}-\x{0B5D}' .
			'\x{0B94}' .
			'\x{0BCA}-\x{0BCC}' .
			'\x{0C48}' .
			'\x{0CC0}' .
			'\x{0CC7}-\x{0CC8}' .
			'\x{0CCA}-\x{0CCB}' .
			'\x{0D4A}-\x{0D4C}' .
			'\x{0DDA}' .
			'\x{0DDC}-\x{0DDE}' .
			'\x{0E33}' .
			'\x{0EB3}' .
			'\x{0EDC}-\x{0EDD}' .
			'\x{0F0C}' .
			'\x{0F43}' .
			'\x{0F4D}' .
			'\x{0F52}' .
			'\x{0F57}' .
			'\x{0F5C}' .
			'\x{0F69}' .
			'\x{0F73}' .
			'\x{0F75}-\x{0F79}' .
			'\x{0F81}' .
			'\x{0F93}' .
			'\x{0F9D}' .
			'\x{0FA2}' .
			'\x{0FA7}' .
			'\x{0FAC}' .
			'\x{0FB9}' .
			'\x{1026}' .
			'\x{10FC}' .
			'\x{1B06}' .
			'\x{1B08}' .
			'\x{1B0A}' .
			'\x{1B0C}' .
			'\x{1B0E}' .
			'\x{1B12}' .
			'\x{1B3B}' .
			'\x{1B3D}' .
			'\x{1B40}-\x{1B41}' .
			'\x{1B43}' .
			'\x{1D2C}-\x{1D2E}' .
			'\x{1D30}-\x{1D3A}' .
			'\x{1D3C}-\x{1D4D}' .
			'\x{1D4F}-\x{1D6A}' .
			'\x{1D78}' .
			'\x{1D9B}-\x{1DBF}' .
			'\x{1E00}-\x{1E9B}' .
			'\x{1EA0}-\x{1EF9}' .
			'\x{1F00}-\x{1F15}' .
			'\x{1F18}-\x{1F1D}' .
			'\x{1F20}-\x{1F45}' .
			'\x{1F48}-\x{1F4D}' .
			'\x{1F50}-\x{1F57}' .
			'\x{1F59}' .
			'\x{1F5B}' .
			'\x{1F5D}' .
			'\x{1F5F}-\x{1F7D}' .
			'\x{1F80}-\x{1FB4}' .
			'\x{1FB6}-\x{1FC4}' .
			'\x{1FC6}-\x{1FD3}' .
			'\x{1FD6}-\x{1FDB}' .
			'\x{1FDD}-\x{1FEF}' .
			'\x{1FF2}-\x{1FF4}' .
			'\x{1FF6}-\x{1FFE}' .
			'\x{2000}-\x{200A}' .
			'\x{2011}' .
			'\x{2017}' .
			'\x{2024}-\x{2026}' .
			'\x{202F}' .
			'\x{2033}-\x{2034}' .
			'\x{2036}-\x{2037}' .
			'\x{203C}' .
			'\x{203E}' .
			'\x{2047}-\x{2049}' .
			'\x{2057}' .
			'\x{205F}' .
			'\x{2070}-\x{2071}' .
			'\x{2074}-\x{208E}' .
			'\x{2090}-\x{209C}' .
			'\x{20A8}' .
			'\x{2100}-\x{2103}' .
			'\x{2105}-\x{2107}' .
			'\x{2109}-\x{2113}' .
			'\x{2115}-\x{2116}' .
			'\x{2119}-\x{211D}' .
			'\x{2120}-\x{2122}' .
			'\x{2124}' .
			'\x{2126}' .
			'\x{2128}' .
			'\x{212A}-\x{212D}' .
			'\x{212F}-\x{2131}' .
			'\x{2133}-\x{2139}' .
			'\x{213B}-\x{2140}' .
			'\x{2145}-\x{2149}' .
			'\x{2150}-\x{217F}' .
			'\x{2189}' .
			'\x{219A}-\x{219B}' .
			'\x{21AE}' .
			'\x{21CD}-\x{21CF}' .
			'\x{2204}' .
			'\x{2209}' .
			'\x{220C}' .
			'\x{2224}' .
			'\x{2226}' .
			'\x{222C}-\x{222D}' .
			'\x{222F}-\x{2230}' .
			'\x{2241}' .
			'\x{2244}' .
			'\x{2247}' .
			'\x{2249}' .
			'\x{2260}' .
			'\x{2262}' .
			'\x{226D}-\x{2271}' .
			'\x{2274}-\x{2275}' .
			'\x{2278}-\x{2279}' .
			'\x{2280}-\x{2281}' .
			'\x{2284}-\x{2285}' .
			'\x{2288}-\x{2289}' .
			'\x{22AC}-\x{22AF}' .
			'\x{22E0}-\x{22E3}' .
			'\x{22EA}-\x{22ED}' .
			'\x{2329}-\x{232A}' .
			'\x{2460}-\x{24EA}' .
			'\x{2A0C}' .
			'\x{2A74}-\x{2A76}' .
			'\x{2ADC}' .
			'\x{2C7C}-\x{2C7D}' .
			'\x{2D6F}' .
			'\x{2E9F}' .
			'\x{2EF3}' .
			'\x{2F00}-\x{2FD5}' .
			'\x{3000}' .
			'\x{3036}' .
			'\x{3038}-\x{303A}' .
			'\x{304C}' .
			'\x{304E}' .
			'\x{3050}' .
			'\x{3052}' .
			'\x{3054}' .
			'\x{3056}' .
			'\x{3058}' .
			'\x{305A}' .
			'\x{305C}' .
			'\x{305E}' .
			'\x{3060}' .
			'\x{3062}' .
			'\x{3065}' .
			'\x{3067}' .
			'\x{3069}' .
			'\x{3070}-\x{3071}' .
			'\x{3073}-\x{3074}' .
			'\x{3076}-\x{3077}' .
			'\x{3079}-\x{307A}' .
			'\x{307C}-\x{307D}' .
			'\x{3094}' .
			'\x{309B}-\x{309C}' .
			'\x{309E}-\x{309F}' .
			'\x{30AC}' .
			'\x{30AE}' .
			'\x{30B0}' .
			'\x{30B2}' .
			'\x{30B4}' .
			'\x{30B6}' .
			'\x{30B8}' .
			'\x{30BA}' .
			'\x{30BC}' .
			'\x{30BE}' .
			'\x{30C0}' .
			'\x{30C2}' .
			'\x{30C5}' .
			'\x{30C7}' .
			'\x{30C9}' .
			'\x{30D0}-\x{30D1}' .
			'\x{30D3}-\x{30D4}' .
			'\x{30D6}-\x{30D7}' .
			'\x{30D9}-\x{30DA}' .
			'\x{30DC}-\x{30DD}' .
			'\x{30F4}' .
			'\x{30F7}-\x{30FA}' .
			'\x{30FE}-\x{30FF}' .
			'\x{3131}-\x{318E}' .
			'\x{3192}-\x{319F}' .
			'\x{3200}-\x{321E}' .
			'\x{3220}-\x{3247}' .
			'\x{3250}-\x{327E}' .
			'\x{3280}-\x{33FF}' .
			'\x{A69C}-\x{A69D}' .
			'\x{A770}' .
			'\x{A7F2}-\x{A7F4}' .
			'\x{A7F8}-\x{A7F9}' .
			'\x{AB5C}-\x{AB5F}' .
			'\x{AB69}' .
			'\x{AC00}-\x{D7A3}' .
			'\x{F900}-\x{FA0D}' .
			'\x{FA10}' .
			'\x{FA12}' .
			'\x{FA15}-\x{FA1E}' .
			'\x{FA20}' .
			'\x{FA22}' .
			'\x{FA25}-\x{FA26}' .
			'\x{FA2A}-\x{FA6D}' .
			'\x{FA70}-\x{FAD9}' .
			'\x{FB00}-\x{FB06}' .
			'\x{FB13}-\x{FB17}' .
			'\x{FB1D}' .
			'\x{FB1F}-\x{FB36}' .
			'\x{FB38}-\x{FB3C}' .
			'\x{FB3E}' .
			'\x{FB40}-\x{FB41}' .
			'\x{FB43}-\x{FB44}' .
			'\x{FB46}-\x{FBB1}' .
			'\x{FBD3}-\x{FD3D}' .
			'\x{FD50}-\x{FD8F}' .
			'\x{FD92}-\x{FDC7}' .
			'\x{FDF0}-\x{FDFC}' .
			'\x{FE10}-\x{FE19}' .
			'\x{FE30}-\x{FE44}' .
			'\x{FE47}-\x{FE52}' .
			'\x{FE54}-\x{FE66}' .
			'\x{FE68}-\x{FE6B}' .
			'\x{FE70}-\x{FE72}' .
			'\x{FE74}' .
			'\x{FE76}-\x{FEFC}' .
			'\x{FF01}-\x{FFBE}' .
			'\x{FFC2}-\x{FFC7}' .
			'\x{FFCA}-\x{FFCF}' .
			'\x{FFD2}-\x{FFD7}' .
			'\x{FFDA}-\x{FFDC}' .
			'\x{FFE0}-\x{FFE6}' .
			'\x{FFE8}-\x{FFEE}' .
			'\x{10781}-\x{10785}' .
			'\x{10787}-\x{107B0}' .
			'\x{107B2}-\x{107BA}' .
			'\x{1109A}' .
			'\x{1109C}' .
			'\x{110AB}' .
			'\x{1112E}-\x{1112F}' .
			'\x{1134B}-\x{1134C}' .
			'\x{114BB}-\x{114BC}' .
			'\x{114BE}' .
			'\x{115BA}-\x{115BB}' .
			'\x{11938}' .
			'\x{1D15E}-\x{1D164}' .
			'\x{1D1BB}-\x{1D1C0}' .
			'\x{1D400}-\x{1D454}' .
			'\x{1D456}-\x{1D49C}' .
			'\x{1D49E}-\x{1D49F}' .
			'\x{1D4A2}' .
			'\x{1D4A5}-\x{1D4A6}' .
			'\x{1D4A9}-\x{1D4AC}' .
			'\x{1D4AE}-\x{1D4B9}' .
			'\x{1D4BB}' .
			'\x{1D4BD}-\x{1D4C3}' .
			'\x{1D4C5}-\x{1D505}' .
			'\x{1D507}-\x{1D50A}' .
			'\x{1D50D}-\x{1D514}' .
			'\x{1D516}-\x{1D51C}' .
			'\x{1D51E}-\x{1D539}' .
			'\x{1D53B}-\x{1D53E}' .
			'\x{1D540}-\x{1D544}' .
			'\x{1D546}' .
			'\x{1D54A}-\x{1D550}' .
			'\x{1D552}-\x{1D6A5}' .
			'\x{1D6A8}-\x{1D7CB}' .
			'\x{1D7CE}-\x{1D7FF}' .
			'\x{1E030}-\x{1E06D}' .
			'\x{1EE00}-\x{1EE03}' .
			'\x{1EE05}-\x{1EE1F}' .
			'\x{1EE21}-\x{1EE22}' .
			'\x{1EE24}' .
			'\x{1EE27}' .
			'\x{1EE29}-\x{1EE32}' .
			'\x{1EE34}-\x{1EE37}' .
			'\x{1EE39}' .
			'\x{1EE3B}' .
			'\x{1EE42}' .
			'\x{1EE47}' .
			'\x{1EE49}' .
			'\x{1EE4B}' .
			'\x{1EE4D}-\x{1EE4F}' .
			'\x{1EE51}-\x{1EE52}' .
			'\x{1EE54}' .
			'\x{1EE57}' .
			'\x{1EE59}' .
			'\x{1EE5B}' .
			'\x{1EE5D}' .
			'\x{1EE5F}' .
			'\x{1EE61}-\x{1EE62}' .
			'\x{1EE64}' .
			'\x{1EE67}-\x{1EE6A}' .
			'\x{1EE6C}-\x{1EE72}' .
			'\x{1EE74}-\x{1EE77}' .
			'\x{1EE79}-\x{1EE7C}' .
			'\x{1EE7E}' .
			'\x{1EE80}-\x{1EE89}' .
			'\x{1EE8B}-\x{1EE9B}' .
			'\x{1EEA1}-\x{1EEA3}' .
			'\x{1EEA5}-\x{1EEA9}' .
			'\x{1EEAB}-\x{1EEBB}' .
			'\x{1F100}-\x{1F10A}' .
			'\x{1F110}-\x{1F12E}' .
			'\x{1F130}-\x{1F14F}' .
			'\x{1F16A}-\x{1F16C}' .
			'\x{1F190}' .
			'\x{1F200}-\x{1F202}' .
			'\x{1F210}-\x{1F23B}' .
			'\x{1F240}-\x{1F248}' .
			'\x{1F250}-\x{1F251}' .
			'\x{1FBF0}-\x{1FBF9}' .
			'\x{2F800}-\x{2FA1D}',
		'Changes_When_NFKC_Casefolded' =>
			'\x{0041}-\x{005A}' .
			'\x{00A0}' .
			'\x{00A8}' .
			'\x{00AA}' .
			'\x{00AD}' .
			'\x{00AF}' .
			'\x{00B2}-\x{00B5}' .
			'\x{00B8}-\x{00BA}' .
			'\x{00BC}-\x{00BE}' .
			'\x{00C0}-\x{00D6}' .
			'\x{00D8}-\x{00DF}' .
			'\x{0100}' .
			'\x{0102}' .
			'\x{0104}' .
			'\x{0106}' .
			'\x{0108}' .
			'\x{010A}' .
			'\x{010C}' .
			'\x{010E}' .
			'\x{0110}' .
			'\x{0112}' .
			'\x{0114}' .
			'\x{0116}' .
			'\x{0118}' .
			'\x{011A}' .
			'\x{011C}' .
			'\x{011E}' .
			'\x{0120}' .
			'\x{0122}' .
			'\x{0124}' .
			'\x{0126}' .
			'\x{0128}' .
			'\x{012A}' .
			'\x{012C}' .
			'\x{012E}' .
			'\x{0130}' .
			'\x{0132}-\x{0134}' .
			'\x{0136}' .
			'\x{0139}' .
			'\x{013B}' .
			'\x{013D}' .
			'\x{013F}-\x{0141}' .
			'\x{0143}' .
			'\x{0145}' .
			'\x{0147}' .
			'\x{0149}-\x{014A}' .
			'\x{014C}' .
			'\x{014E}' .
			'\x{0150}' .
			'\x{0152}' .
			'\x{0154}' .
			'\x{0156}' .
			'\x{0158}' .
			'\x{015A}' .
			'\x{015C}' .
			'\x{015E}' .
			'\x{0160}' .
			'\x{0162}' .
			'\x{0164}' .
			'\x{0166}' .
			'\x{0168}' .
			'\x{016A}' .
			'\x{016C}' .
			'\x{016E}' .
			'\x{0170}' .
			'\x{0172}' .
			'\x{0174}' .
			'\x{0176}' .
			'\x{0178}-\x{0179}' .
			'\x{017B}' .
			'\x{017D}' .
			'\x{017F}' .
			'\x{0181}-\x{0182}' .
			'\x{0184}' .
			'\x{0186}-\x{0187}' .
			'\x{0189}-\x{018B}' .
			'\x{018E}-\x{0191}' .
			'\x{0193}-\x{0194}' .
			'\x{0196}-\x{0198}' .
			'\x{019C}-\x{019D}' .
			'\x{019F}-\x{01A0}' .
			'\x{01A2}' .
			'\x{01A4}' .
			'\x{01A6}-\x{01A7}' .
			'\x{01A9}' .
			'\x{01AC}' .
			'\x{01AE}-\x{01AF}' .
			'\x{01B1}-\x{01B3}' .
			'\x{01B5}' .
			'\x{01B7}-\x{01B8}' .
			'\x{01BC}' .
			'\x{01C4}-\x{01CD}' .
			'\x{01CF}' .
			'\x{01D1}' .
			'\x{01D3}' .
			'\x{01D5}' .
			'\x{01D7}' .
			'\x{01D9}' .
			'\x{01DB}' .
			'\x{01DE}' .
			'\x{01E0}' .
			'\x{01E2}' .
			'\x{01E4}' .
			'\x{01E6}' .
			'\x{01E8}' .
			'\x{01EA}' .
			'\x{01EC}' .
			'\x{01EE}' .
			'\x{01F1}-\x{01F4}' .
			'\x{01F6}-\x{01F8}' .
			'\x{01FA}' .
			'\x{01FC}' .
			'\x{01FE}' .
			'\x{0200}' .
			'\x{0202}' .
			'\x{0204}' .
			'\x{0206}' .
			'\x{0208}' .
			'\x{020A}' .
			'\x{020C}' .
			'\x{020E}' .
			'\x{0210}' .
			'\x{0212}' .
			'\x{0214}' .
			'\x{0216}' .
			'\x{0218}' .
			'\x{021A}' .
			'\x{021C}' .
			'\x{021E}' .
			'\x{0220}' .
			'\x{0222}' .
			'\x{0224}' .
			'\x{0226}' .
			'\x{0228}' .
			'\x{022A}' .
			'\x{022C}' .
			'\x{022E}' .
			'\x{0230}' .
			'\x{0232}' .
			'\x{023A}-\x{023B}' .
			'\x{023D}-\x{023E}' .
			'\x{0241}' .
			'\x{0243}-\x{0246}' .
			'\x{0248}' .
			'\x{024A}' .
			'\x{024C}' .
			'\x{024E}' .
			'\x{02B0}-\x{02B8}' .
			'\x{02D8}-\x{02DD}' .
			'\x{02E0}-\x{02E4}' .
			'\x{0340}-\x{0341}' .
			'\x{0343}-\x{0345}' .
			'\x{034F}' .
			'\x{0370}' .
			'\x{0372}' .
			'\x{0374}' .
			'\x{0376}' .
			'\x{037A}' .
			'\x{037E}-\x{037F}' .
			'\x{0384}-\x{038A}' .
			'\x{038C}' .
			'\x{038E}-\x{038F}' .
			'\x{0391}-\x{03A1}' .
			'\x{03A3}-\x{03AB}' .
			'\x{03C2}' .
			'\x{03CF}-\x{03D6}' .
			'\x{03D8}' .
			'\x{03DA}' .
			'\x{03DC}' .
			'\x{03DE}' .
			'\x{03E0}' .
			'\x{03E2}' .
			'\x{03E4}' .
			'\x{03E6}' .
			'\x{03E8}' .
			'\x{03EA}' .
			'\x{03EC}' .
			'\x{03EE}' .
			'\x{03F0}-\x{03F2}' .
			'\x{03F4}-\x{03F5}' .
			'\x{03F7}' .
			'\x{03F9}-\x{03FA}' .
			'\x{03FD}-\x{042F}' .
			'\x{0460}' .
			'\x{0462}' .
			'\x{0464}' .
			'\x{0466}' .
			'\x{0468}' .
			'\x{046A}' .
			'\x{046C}' .
			'\x{046E}' .
			'\x{0470}' .
			'\x{0472}' .
			'\x{0474}' .
			'\x{0476}' .
			'\x{0478}' .
			'\x{047A}' .
			'\x{047C}' .
			'\x{047E}' .
			'\x{0480}' .
			'\x{048A}' .
			'\x{048C}' .
			'\x{048E}' .
			'\x{0490}' .
			'\x{0492}' .
			'\x{0494}' .
			'\x{0496}' .
			'\x{0498}' .
			'\x{049A}' .
			'\x{049C}' .
			'\x{049E}' .
			'\x{04A0}' .
			'\x{04A2}' .
			'\x{04A4}' .
			'\x{04A6}' .
			'\x{04A8}' .
			'\x{04AA}' .
			'\x{04AC}' .
			'\x{04AE}' .
			'\x{04B0}' .
			'\x{04B2}' .
			'\x{04B4}' .
			'\x{04B6}' .
			'\x{04B8}' .
			'\x{04BA}' .
			'\x{04BC}' .
			'\x{04BE}' .
			'\x{04C0}-\x{04C1}' .
			'\x{04C3}' .
			'\x{04C5}' .
			'\x{04C7}' .
			'\x{04C9}' .
			'\x{04CB}' .
			'\x{04CD}' .
			'\x{04D0}' .
			'\x{04D2}' .
			'\x{04D4}' .
			'\x{04D6}' .
			'\x{04D8}' .
			'\x{04DA}' .
			'\x{04DC}' .
			'\x{04DE}' .
			'\x{04E0}' .
			'\x{04E2}' .
			'\x{04E4}' .
			'\x{04E6}' .
			'\x{04E8}' .
			'\x{04EA}' .
			'\x{04EC}' .
			'\x{04EE}' .
			'\x{04F0}' .
			'\x{04F2}' .
			'\x{04F4}' .
			'\x{04F6}' .
			'\x{04F8}' .
			'\x{04FA}' .
			'\x{04FC}' .
			'\x{04FE}' .
			'\x{0500}' .
			'\x{0502}' .
			'\x{0504}' .
			'\x{0506}' .
			'\x{0508}' .
			'\x{050A}' .
			'\x{050C}' .
			'\x{050E}' .
			'\x{0510}' .
			'\x{0512}' .
			'\x{0514}' .
			'\x{0516}' .
			'\x{0518}' .
			'\x{051A}' .
			'\x{051C}' .
			'\x{051E}' .
			'\x{0520}' .
			'\x{0522}' .
			'\x{0524}' .
			'\x{0526}' .
			'\x{0528}' .
			'\x{052A}' .
			'\x{052C}' .
			'\x{052E}' .
			'\x{0531}-\x{0556}' .
			'\x{0587}' .
			'\x{061C}' .
			'\x{0675}-\x{0678}' .
			'\x{0958}-\x{095F}' .
			'\x{09DC}-\x{09DD}' .
			'\x{09DF}' .
			'\x{0A33}' .
			'\x{0A36}' .
			'\x{0A59}-\x{0A5B}' .
			'\x{0A5E}' .
			'\x{0B5C}-\x{0B5D}' .
			'\x{0E33}' .
			'\x{0EB3}' .
			'\x{0EDC}-\x{0EDD}' .
			'\x{0F0C}' .
			'\x{0F43}' .
			'\x{0F4D}' .
			'\x{0F52}' .
			'\x{0F57}' .
			'\x{0F5C}' .
			'\x{0F69}' .
			'\x{0F73}' .
			'\x{0F75}-\x{0F79}' .
			'\x{0F81}' .
			'\x{0F93}' .
			'\x{0F9D}' .
			'\x{0FA2}' .
			'\x{0FA7}' .
			'\x{0FAC}' .
			'\x{0FB9}' .
			'\x{10A0}-\x{10C5}' .
			'\x{10C7}' .
			'\x{10CD}' .
			'\x{10FC}' .
			'\x{115F}-\x{1160}' .
			'\x{13F8}-\x{13FD}' .
			'\x{17B4}-\x{17B5}' .
			'\x{180B}-\x{180F}' .
			'\x{1C80}-\x{1C88}' .
			'\x{1C90}-\x{1CBA}' .
			'\x{1CBD}-\x{1CBF}' .
			'\x{1D2C}-\x{1D2E}' .
			'\x{1D30}-\x{1D3A}' .
			'\x{1D3C}-\x{1D4D}' .
			'\x{1D4F}-\x{1D6A}' .
			'\x{1D78}' .
			'\x{1D9B}-\x{1DBF}' .
			'\x{1E00}' .
			'\x{1E02}' .
			'\x{1E04}' .
			'\x{1E06}' .
			'\x{1E08}' .
			'\x{1E0A}' .
			'\x{1E0C}' .
			'\x{1E0E}' .
			'\x{1E10}' .
			'\x{1E12}' .
			'\x{1E14}' .
			'\x{1E16}' .
			'\x{1E18}' .
			'\x{1E1A}' .
			'\x{1E1C}' .
			'\x{1E1E}' .
			'\x{1E20}' .
			'\x{1E22}' .
			'\x{1E24}' .
			'\x{1E26}' .
			'\x{1E28}' .
			'\x{1E2A}' .
			'\x{1E2C}' .
			'\x{1E2E}' .
			'\x{1E30}' .
			'\x{1E32}' .
			'\x{1E34}' .
			'\x{1E36}' .
			'\x{1E38}' .
			'\x{1E3A}' .
			'\x{1E3C}' .
			'\x{1E3E}' .
			'\x{1E40}' .
			'\x{1E42}' .
			'\x{1E44}' .
			'\x{1E46}' .
			'\x{1E48}' .
			'\x{1E4A}' .
			'\x{1E4C}' .
			'\x{1E4E}' .
			'\x{1E50}' .
			'\x{1E52}' .
			'\x{1E54}' .
			'\x{1E56}' .
			'\x{1E58}' .
			'\x{1E5A}' .
			'\x{1E5C}' .
			'\x{1E5E}' .
			'\x{1E60}' .
			'\x{1E62}' .
			'\x{1E64}' .
			'\x{1E66}' .
			'\x{1E68}' .
			'\x{1E6A}' .
			'\x{1E6C}' .
			'\x{1E6E}' .
			'\x{1E70}' .
			'\x{1E72}' .
			'\x{1E74}' .
			'\x{1E76}' .
			'\x{1E78}' .
			'\x{1E7A}' .
			'\x{1E7C}' .
			'\x{1E7E}' .
			'\x{1E80}' .
			'\x{1E82}' .
			'\x{1E84}' .
			'\x{1E86}' .
			'\x{1E88}' .
			'\x{1E8A}' .
			'\x{1E8C}' .
			'\x{1E8E}' .
			'\x{1E90}' .
			'\x{1E92}' .
			'\x{1E94}' .
			'\x{1E9A}-\x{1E9B}' .
			'\x{1E9E}' .
			'\x{1EA0}' .
			'\x{1EA2}' .
			'\x{1EA4}' .
			'\x{1EA6}' .
			'\x{1EA8}' .
			'\x{1EAA}' .
			'\x{1EAC}' .
			'\x{1EAE}' .
			'\x{1EB0}' .
			'\x{1EB2}' .
			'\x{1EB4}' .
			'\x{1EB6}' .
			'\x{1EB8}' .
			'\x{1EBA}' .
			'\x{1EBC}' .
			'\x{1EBE}' .
			'\x{1EC0}' .
			'\x{1EC2}' .
			'\x{1EC4}' .
			'\x{1EC6}' .
			'\x{1EC8}' .
			'\x{1ECA}' .
			'\x{1ECC}' .
			'\x{1ECE}' .
			'\x{1ED0}' .
			'\x{1ED2}' .
			'\x{1ED4}' .
			'\x{1ED6}' .
			'\x{1ED8}' .
			'\x{1EDA}' .
			'\x{1EDC}' .
			'\x{1EDE}' .
			'\x{1EE0}' .
			'\x{1EE2}' .
			'\x{1EE4}' .
			'\x{1EE6}' .
			'\x{1EE8}' .
			'\x{1EEA}' .
			'\x{1EEC}' .
			'\x{1EEE}' .
			'\x{1EF0}' .
			'\x{1EF2}' .
			'\x{1EF4}' .
			'\x{1EF6}' .
			'\x{1EF8}' .
			'\x{1EFA}' .
			'\x{1EFC}' .
			'\x{1EFE}' .
			'\x{1F08}-\x{1F0F}' .
			'\x{1F18}-\x{1F1D}' .
			'\x{1F28}-\x{1F2F}' .
			'\x{1F38}-\x{1F3F}' .
			'\x{1F48}-\x{1F4D}' .
			'\x{1F59}' .
			'\x{1F5B}' .
			'\x{1F5D}' .
			'\x{1F5F}' .
			'\x{1F68}-\x{1F6F}' .
			'\x{1F71}' .
			'\x{1F73}' .
			'\x{1F75}' .
			'\x{1F77}' .
			'\x{1F79}' .
			'\x{1F7B}' .
			'\x{1F7D}' .
			'\x{1F80}-\x{1FAF}' .
			'\x{1FB2}-\x{1FB4}' .
			'\x{1FB7}-\x{1FC4}' .
			'\x{1FC7}-\x{1FCF}' .
			'\x{1FD3}' .
			'\x{1FD8}-\x{1FDB}' .
			'\x{1FDD}-\x{1FDF}' .
			'\x{1FE3}' .
			'\x{1FE8}-\x{1FEF}' .
			'\x{1FF2}-\x{1FF4}' .
			'\x{1FF7}-\x{1FFE}' .
			'\x{2000}-\x{200F}' .
			'\x{2011}' .
			'\x{2017}' .
			'\x{2024}-\x{2026}' .
			'\x{202A}-\x{202F}' .
			'\x{2033}-\x{2034}' .
			'\x{2036}-\x{2037}' .
			'\x{203C}' .
			'\x{203E}' .
			'\x{2047}-\x{2049}' .
			'\x{2057}' .
			'\x{205F}-\x{2071}' .
			'\x{2074}-\x{208E}' .
			'\x{2090}-\x{209C}' .
			'\x{20A8}' .
			'\x{2100}-\x{2103}' .
			'\x{2105}-\x{2107}' .
			'\x{2109}-\x{2113}' .
			'\x{2115}-\x{2116}' .
			'\x{2119}-\x{211D}' .
			'\x{2120}-\x{2122}' .
			'\x{2124}' .
			'\x{2126}' .
			'\x{2128}' .
			'\x{212A}-\x{212D}' .
			'\x{212F}-\x{2139}' .
			'\x{213B}-\x{2140}' .
			'\x{2145}-\x{2149}' .
			'\x{2150}-\x{217F}' .
			'\x{2183}' .
			'\x{2189}' .
			'\x{222C}-\x{222D}' .
			'\x{222F}-\x{2230}' .
			'\x{2329}-\x{232A}' .
			'\x{2460}-\x{24EA}' .
			'\x{2A0C}' .
			'\x{2A74}-\x{2A76}' .
			'\x{2ADC}' .
			'\x{2C00}-\x{2C2F}' .
			'\x{2C60}' .
			'\x{2C62}-\x{2C64}' .
			'\x{2C67}' .
			'\x{2C69}' .
			'\x{2C6B}' .
			'\x{2C6D}-\x{2C70}' .
			'\x{2C72}' .
			'\x{2C75}' .
			'\x{2C7C}-\x{2C80}' .
			'\x{2C82}' .
			'\x{2C84}' .
			'\x{2C86}' .
			'\x{2C88}' .
			'\x{2C8A}' .
			'\x{2C8C}' .
			'\x{2C8E}' .
			'\x{2C90}' .
			'\x{2C92}' .
			'\x{2C94}' .
			'\x{2C96}' .
			'\x{2C98}' .
			'\x{2C9A}' .
			'\x{2C9C}' .
			'\x{2C9E}' .
			'\x{2CA0}' .
			'\x{2CA2}' .
			'\x{2CA4}' .
			'\x{2CA6}' .
			'\x{2CA8}' .
			'\x{2CAA}' .
			'\x{2CAC}' .
			'\x{2CAE}' .
			'\x{2CB0}' .
			'\x{2CB2}' .
			'\x{2CB4}' .
			'\x{2CB6}' .
			'\x{2CB8}' .
			'\x{2CBA}' .
			'\x{2CBC}' .
			'\x{2CBE}' .
			'\x{2CC0}' .
			'\x{2CC2}' .
			'\x{2CC4}' .
			'\x{2CC6}' .
			'\x{2CC8}' .
			'\x{2CCA}' .
			'\x{2CCC}' .
			'\x{2CCE}' .
			'\x{2CD0}' .
			'\x{2CD2}' .
			'\x{2CD4}' .
			'\x{2CD6}' .
			'\x{2CD8}' .
			'\x{2CDA}' .
			'\x{2CDC}' .
			'\x{2CDE}' .
			'\x{2CE0}' .
			'\x{2CE2}' .
			'\x{2CEB}' .
			'\x{2CED}' .
			'\x{2CF2}' .
			'\x{2D6F}' .
			'\x{2E9F}' .
			'\x{2EF3}' .
			'\x{2F00}-\x{2FD5}' .
			'\x{3000}' .
			'\x{3036}' .
			'\x{3038}-\x{303A}' .
			'\x{309B}-\x{309C}' .
			'\x{309F}' .
			'\x{30FF}' .
			'\x{3131}-\x{318E}' .
			'\x{3192}-\x{319F}' .
			'\x{3200}-\x{321E}' .
			'\x{3220}-\x{3247}' .
			'\x{3250}-\x{327E}' .
			'\x{3280}-\x{33FF}' .
			'\x{A640}' .
			'\x{A642}' .
			'\x{A644}' .
			'\x{A646}' .
			'\x{A648}' .
			'\x{A64A}' .
			'\x{A64C}' .
			'\x{A64E}' .
			'\x{A650}' .
			'\x{A652}' .
			'\x{A654}' .
			'\x{A656}' .
			'\x{A658}' .
			'\x{A65A}' .
			'\x{A65C}' .
			'\x{A65E}' .
			'\x{A660}' .
			'\x{A662}' .
			'\x{A664}' .
			'\x{A666}' .
			'\x{A668}' .
			'\x{A66A}' .
			'\x{A66C}' .
			'\x{A680}' .
			'\x{A682}' .
			'\x{A684}' .
			'\x{A686}' .
			'\x{A688}' .
			'\x{A68A}' .
			'\x{A68C}' .
			'\x{A68E}' .
			'\x{A690}' .
			'\x{A692}' .
			'\x{A694}' .
			'\x{A696}' .
			'\x{A698}' .
			'\x{A69A}' .
			'\x{A69C}-\x{A69D}' .
			'\x{A722}' .
			'\x{A724}' .
			'\x{A726}' .
			'\x{A728}' .
			'\x{A72A}' .
			'\x{A72C}' .
			'\x{A72E}' .
			'\x{A732}' .
			'\x{A734}' .
			'\x{A736}' .
			'\x{A738}' .
			'\x{A73A}' .
			'\x{A73C}' .
			'\x{A73E}' .
			'\x{A740}' .
			'\x{A742}' .
			'\x{A744}' .
			'\x{A746}' .
			'\x{A748}' .
			'\x{A74A}' .
			'\x{A74C}' .
			'\x{A74E}' .
			'\x{A750}' .
			'\x{A752}' .
			'\x{A754}' .
			'\x{A756}' .
			'\x{A758}' .
			'\x{A75A}' .
			'\x{A75C}' .
			'\x{A75E}' .
			'\x{A760}' .
			'\x{A762}' .
			'\x{A764}' .
			'\x{A766}' .
			'\x{A768}' .
			'\x{A76A}' .
			'\x{A76C}' .
			'\x{A76E}' .
			'\x{A770}' .
			'\x{A779}' .
			'\x{A77B}' .
			'\x{A77D}-\x{A77E}' .
			'\x{A780}' .
			'\x{A782}' .
			'\x{A784}' .
			'\x{A786}' .
			'\x{A78B}' .
			'\x{A78D}' .
			'\x{A790}' .
			'\x{A792}' .
			'\x{A796}' .
			'\x{A798}' .
			'\x{A79A}' .
			'\x{A79C}' .
			'\x{A79E}' .
			'\x{A7A0}' .
			'\x{A7A2}' .
			'\x{A7A4}' .
			'\x{A7A6}' .
			'\x{A7A8}' .
			'\x{A7AA}-\x{A7AE}' .
			'\x{A7B0}-\x{A7B4}' .
			'\x{A7B6}' .
			'\x{A7B8}' .
			'\x{A7BA}' .
			'\x{A7BC}' .
			'\x{A7BE}' .
			'\x{A7C0}' .
			'\x{A7C2}' .
			'\x{A7C4}-\x{A7C7}' .
			'\x{A7C9}' .
			'\x{A7D0}' .
			'\x{A7D6}' .
			'\x{A7D8}' .
			'\x{A7F2}-\x{A7F5}' .
			'\x{A7F8}-\x{A7F9}' .
			'\x{AB5C}-\x{AB5F}' .
			'\x{AB69}' .
			'\x{AB70}-\x{ABBF}' .
			'\x{F900}-\x{FA0D}' .
			'\x{FA10}' .
			'\x{FA12}' .
			'\x{FA15}-\x{FA1E}' .
			'\x{FA20}' .
			'\x{FA22}' .
			'\x{FA25}-\x{FA26}' .
			'\x{FA2A}-\x{FA6D}' .
			'\x{FA70}-\x{FAD9}' .
			'\x{FB00}-\x{FB06}' .
			'\x{FB13}-\x{FB17}' .
			'\x{FB1D}' .
			'\x{FB1F}-\x{FB36}' .
			'\x{FB38}-\x{FB3C}' .
			'\x{FB3E}' .
			'\x{FB40}-\x{FB41}' .
			'\x{FB43}-\x{FB44}' .
			'\x{FB46}-\x{FBB1}' .
			'\x{FBD3}-\x{FD3D}' .
			'\x{FD50}-\x{FD8F}' .
			'\x{FD92}-\x{FDC7}' .
			'\x{FDF0}-\x{FDFC}' .
			'\x{FE00}-\x{FE19}' .
			'\x{FE30}-\x{FE44}' .
			'\x{FE47}-\x{FE52}' .
			'\x{FE54}-\x{FE66}' .
			'\x{FE68}-\x{FE6B}' .
			'\x{FE70}-\x{FE72}' .
			'\x{FE74}' .
			'\x{FE76}-\x{FEFC}' .
			'\x{FEFF}' .
			'\x{FF01}-\x{FFBE}' .
			'\x{FFC2}-\x{FFC7}' .
			'\x{FFCA}-\x{FFCF}' .
			'\x{FFD2}-\x{FFD7}' .
			'\x{FFDA}-\x{FFDC}' .
			'\x{FFE0}-\x{FFE6}' .
			'\x{FFE8}-\x{FFEE}' .
			'\x{FFF0}-\x{FFF8}' .
			'\x{10400}-\x{10427}' .
			'\x{104B0}-\x{104D3}' .
			'\x{10570}-\x{1057A}' .
			'\x{1057C}-\x{1058A}' .
			'\x{1058C}-\x{10592}' .
			'\x{10594}-\x{10595}' .
			'\x{10781}-\x{10785}' .
			'\x{10787}-\x{107B0}' .
			'\x{107B2}-\x{107BA}' .
			'\x{10C80}-\x{10CB2}' .
			'\x{118A0}-\x{118BF}' .
			'\x{16E40}-\x{16E5F}' .
			'\x{1BCA0}-\x{1BCA3}' .
			'\x{1D15E}-\x{1D164}' .
			'\x{1D173}-\x{1D17A}' .
			'\x{1D1BB}-\x{1D1C0}' .
			'\x{1D400}-\x{1D454}' .
			'\x{1D456}-\x{1D49C}' .
			'\x{1D49E}-\x{1D49F}' .
			'\x{1D4A2}' .
			'\x{1D4A5}-\x{1D4A6}' .
			'\x{1D4A9}-\x{1D4AC}' .
			'\x{1D4AE}-\x{1D4B9}' .
			'\x{1D4BB}' .
			'\x{1D4BD}-\x{1D4C3}' .
			'\x{1D4C5}-\x{1D505}' .
			'\x{1D507}-\x{1D50A}' .
			'\x{1D50D}-\x{1D514}' .
			'\x{1D516}-\x{1D51C}' .
			'\x{1D51E}-\x{1D539}' .
			'\x{1D53B}-\x{1D53E}' .
			'\x{1D540}-\x{1D544}' .
			'\x{1D546}' .
			'\x{1D54A}-\x{1D550}' .
			'\x{1D552}-\x{1D6A5}' .
			'\x{1D6A8}-\x{1D7CB}' .
			'\x{1D7CE}-\x{1D7FF}' .
			'\x{1E030}-\x{1E06D}' .
			'\x{1E900}-\x{1E921}' .
			'\x{1EE00}-\x{1EE03}' .
			'\x{1EE05}-\x{1EE1F}' .
			'\x{1EE21}-\x{1EE22}' .
			'\x{1EE24}' .
			'\x{1EE27}' .
			'\x{1EE29}-\x{1EE32}' .
			'\x{1EE34}-\x{1EE37}' .
			'\x{1EE39}' .
			'\x{1EE3B}' .
			'\x{1EE42}' .
			'\x{1EE47}' .
			'\x{1EE49}' .
			'\x{1EE4B}' .
			'\x{1EE4D}-\x{1EE4F}' .
			'\x{1EE51}-\x{1EE52}' .
			'\x{1EE54}' .
			'\x{1EE57}' .
			'\x{1EE59}' .
			'\x{1EE5B}' .
			'\x{1EE5D}' .
			'\x{1EE5F}' .
			'\x{1EE61}-\x{1EE62}' .
			'\x{1EE64}' .
			'\x{1EE67}-\x{1EE6A}' .
			'\x{1EE6C}-\x{1EE72}' .
			'\x{1EE74}-\x{1EE77}' .
			'\x{1EE79}-\x{1EE7C}' .
			'\x{1EE7E}' .
			'\x{1EE80}-\x{1EE89}' .
			'\x{1EE8B}-\x{1EE9B}' .
			'\x{1EEA1}-\x{1EEA3}' .
			'\x{1EEA5}-\x{1EEA9}' .
			'\x{1EEAB}-\x{1EEBB}' .
			'\x{1F100}-\x{1F10A}' .
			'\x{1F110}-\x{1F12E}' .
			'\x{1F130}-\x{1F14F}' .
			'\x{1F16A}-\x{1F16C}' .
			'\x{1F190}' .
			'\x{1F200}-\x{1F202}' .
			'\x{1F210}-\x{1F23B}' .
			'\x{1F240}-\x{1F248}' .
			'\x{1F250}-\x{1F251}' .
			'\x{1FBF0}-\x{1FBF9}' .
			'\x{2F800}-\x{2FA1D}' .
			'\x{E0000}-\x{E0FFF}',
	);
}

?>