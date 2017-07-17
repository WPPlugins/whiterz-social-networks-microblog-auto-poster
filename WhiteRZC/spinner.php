<?php
	class WHTSpinner {
		public static function detect($text, $seedPageName = true, $openingConstruct = '{{', $closingConstruct = '}
}
', $separator = '|') {
	if(preg_match('~'.$openingConstruct.'(?:(?!'.$closingConstruct.').)*'.$openingConstruct.'~s', $text)) {
	 return self::nested($text, $seedPageName, $openingConstruct, $closingConstruct, $separator);
	 }

 else { return self::flat($text, $seedPageName, false, $openingConstruct, $closingConstruct, $separator);
	 }
 }
 public static function flat($text, $seedPageName = true, $calculate = false, $openingConstruct = '{{', $closingConstruct = '}
}
', $separator = '|') { $return = 'text';
	 if($calculate) { $permutations = 1;
	 $return = 'permutations';
	 }
 if(strpos($text, $openingConstruct) === false) { return $$return;
	 }

	if(preg_match_all('!'.$openingConstruct.'(.*?)'.$closingConstruct.'!s', $text, $matches)) { self::checkSeed($seedPageName);
	 $find = array();
	 $replace= array();
	 foreach($matches[0] as $key => $match) { $choices = explode($separator, $matches[1][$key]);
	 if($calculate) { $permutations *= count($choices);
	 }
 else { $find[] = $match;
	 $replace[]= $choices[mt_rand(0, count($choices) - 1)];
	 }
 }
 if(!$calculate) { $text = self::str_replace_first($find, $replace, $text);
	 }
 }
 return $$return;
	 }
 public static function nested($text, $seedPageName = true, $openingConstruct = '{{', $closingConstruct = '}
}
', $separator = '|') { if(strpos($text, $openingConstruct) === false) { return $text;
	 }
 if(preg_match('!'.$openingConstruct.'(.+?)'.$closingConstruct.'!s', $text, $matches)) { self::checkSeed($seedPageName);
	 if(($pos = mb_strrpos($matches[1], $openingConstruct)) !== false) { $matches[1] = mb_substr($matches[1], $pos + mb_strlen($openingConstruct));
	 }
 $parts= explode($separator, $matches[1]);
	 $text = self::str_replace_first($openingConstruct.$matches[1].$closingConstruct, $parts[mt_rand(0, count($parts) - 1)], $text);
	 return self::nested($text, $seedPageName, $openingConstruct, $closingConstruct, $separator);
	 }
 else { return $text;
	 }
 }
 private static function str_replace_first($find, $replace, $string) { if(!is_array($find)) { $find = array($find);
	 }
 if(!is_array($replace)) { $replace = array($replace);
	 }
 foreach($find as $key => $value) { if(($pos = mb_strpos($string, $value)) !== false) { if(!isset($replace[$key])) { $replace[$key] = '';
	 }
 $string = mb_substr($string, 0, $pos).$replace[$key].mb_substr($string, $pos + mb_strlen($value));
	 }
 }
 return $string;
	 }
 private static function checkSeed($seedPageName) { if($seedPageName) { if($seedPageName === true) { mt_srand(crc32($_SERVER['REQUEST_URI']));
	 }
 elseif($seedPageName == 'every second') { mt_srand(crc32($_SERVER['REQUEST_URI'].date('Y-m-d-H-i-s')));
	 }
 elseif($seedPageName == 'every minute') { mt_srand(crc32($_SERVER['REQUEST_URI'].date('Y-m-d-H-i')));
	 }
 elseif($seedPageName == 'hourly' OR $seedPageName == 'every hour') { mt_srand(crc32($_SERVER['REQUEST_URI'].date('Y-m-d-H')));
	 }
 elseif($seedPageName == 'daily' OR $seedPageName == 'every day') { mt_srand(crc32($_SERVER['REQUEST_URI'].date('Y-m-d')));
	 }
 elseif($seedPageName == 'weekly' OR $seedPageName == 'every week') { mt_srand(crc32($_SERVER['REQUEST_URI'].date('Y-W')));
	 }
 elseif($seedPageName == 'monthly' OR $seedPageName == 'every month') { mt_srand(crc32($_SERVER['REQUEST_URI'].date('Y-m')));
	 }
 elseif($seedPageName == 'annually' OR $seedPageName == 'every year') { mt_srand(crc32($_SERVER['REQUEST_URI'].date('Y')));
	 }
 elseif(preg_match('!every ([0-9.]+) seconds!', $seedPageName, $matches)) { mt_srand(crc32($_SERVER['REQUEST_URI'].floor(time() / $matches[1])));
	 }
 elseif(preg_match('!every ([0-9.]+) minutes!', $seedPageName, $matches)) { mt_srand(crc32($_SERVER['REQUEST_URI'].floor(time() / ($matches[1] * 60))));
	 }
 elseif(preg_match('!every ([0-9.]+) hours!', $seedPageName, $matches)) { mt_srand(crc32($_SERVER['REQUEST_URI'].floor(time() / ($matches[1] * 3600))));
	 }
 elseif(preg_match('!every ([0-9.]+) days!', $seedPageName, $matches)) { mt_srand(crc32($_SERVER['REQUEST_URI'].floor(time() / ($matches[1] * 86400))));
	 }
 elseif(preg_match('!every ([0-9.]+) weeks!', $seedPageName, $matches)) { mt_srand(crc32($_SERVER['REQUEST_URI'].floor(time() / ($matches[1] * 604800))));
	 }
 elseif(preg_match('!every ([0-9.]+) months!', $seedPageName, $matches)) { mt_srand(crc32($_SERVER['REQUEST_URI'].floor(time() / ($matches[1] * 2620800))));
	 }
 elseif(preg_match('!every ([0-9.]+) years!', $seedPageName, $matches)) { mt_srand(crc32($_SERVER['REQUEST_URI'].floor(time() / ($matches[1] * 31449600))));
	 }
 else { }
 }
 }
 }

?>