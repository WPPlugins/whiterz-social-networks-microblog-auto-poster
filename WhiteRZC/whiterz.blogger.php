<?php
	header("Content-Type: text/html;
		charset=UTF-8");
			class WhiterzBlogger{ function WhiterzBlogger(){
			global $Account;
			global $Blogger;
			$this->user($Account->login);
			$this->pass($Account->passwd);
			$this->no($Account->custom_field);
			$this->dil(1);
			$as=$this->yaz($Blogger['title'],$Blogger['tags'],$Blogger['content']);
			$this->status=$as;
	}
	function cevir($gel){
		return $gel;
	}
	function olustur($ad,$etiket,$icerik){ $ad=$this->cevir($ad);
			$icerik=$this->cevir($icerik);
			$xml="<entry xmlns='http://www.w3.org/2005/Atom'>
			<title type='text'>$ad</title> <content type='html'> <![CDATA[". $icerik ."]]> </content>";
	foreach(explode(',',$etiket) as $liz0){ $liz0=$this->cevir($liz0);
			$xml.='<category scheme="http://www.blogger.com/atom/ns#" term="'.$liz0.'" />';
	}
		$xml.="</entry>";
	return $xml;
	}
	function user($a){ return $this->kullanici=$a;
	}
	function pass($a){ return $this->sifre=$a;
	}
	function no($a){ return $this->id=$a;
	}
	function dil($a){ return $this->dil=$a;
	}
	function tokenal(){ $ch3 = curl_init();
	curl_setopt($ch3, CURLOPT_URL, 'https://www.google.com/accounts/ClientLogin');
	curl_setopt($ch3, CURLOPT_POSTFIELDS,"Email=$this->kullanici&Passwd=$this->sifre&accountType=GOOGLE&service=blogger&source=curlbaglan");
	curl_setopt($ch3, CURLOPT_POST, 1);
	curl_setopt($ch3, CURLOPT_HEADER, 0);
	@curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch3, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows;
	U;
	Windows NT 5.1;
	en-US;
	rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
	curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
	$finish = curl_exec($ch3);
	$a=explode("Auth=",$finish);
	$x=trim($a[1]);
	return $this->token=$x;
	}
	function token(){ $this->tokenal();
	return $this->token;
	}
	function yaz($konu,$etiket,$icerik){ $this->token();
			$xml=$this->olustur($konu,$etiket,$icerik);
			$s=strlen($xml);
			$header[]="Content-Type: application/atom+xml";
			$header[]="Content-length: $s";
			$header[]="Authorization: GoogleLogin auth=$this->token";
			$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://www.blogger.com/feeds/'.$this->id.'/posts/default');
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, false);
	@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows;	U;	Windows NT 5.1;	en-US;	rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$sonuc = curl_exec($ch);
		return true;
		}
	}
?>
