<?php
ob_start();
	session_start();
	define ('WHITERZ_COOKIE' , ABSPATH. 'whiterz_cookie.txt' );
	class WhiterzCurl { var $headers;
	var $user_agent;
	var $compression;
	var $cookie_file;
	var $proxy;
		function WhiterzCurl($cookies=TRUE,$cookie=WHITERZ_COOKIE,$compression='gzip',$proxy='') { $this->headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
				$this->headers[] = 'Connection: Keep-Alive';
				$this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
				$this->user_agent = 'Mozilla/4.0 (compatible;	MSIE 7.0;	Windows NT 5.1;	.NET CLR 1.0.3705;	.NET CLR 1.1.4322;	Media Center PC 4.0)';
				$this->compression=$compression;
				$this->proxy=$proxy;
				$this->cookies=$cookies;
				$this->cookie( $cookie );
	}	function cookie($cookie_file){
		if (@file_exists($cookie_file)){
			$this->cookie_file=$cookie_file;
	}else{
	@fopen($cookie_file,'w');
			$this->cookie_file=$cookie_file;
	}
		}
		function get($url) { $process = curl_init($url);
			curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
			curl_setopt($process, CURLOPT_HEADER, FALSE);
			curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
			curl_setopt($process, CURLOPT_TIMEOUT, 30);
			curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($process, CURLOPT_FOLLOWLOCATION, 0);
			$return = curl_exec($process);
			$this->http_status=curl_getinfo($process, CURLINFO_HTTP_CODE);
			curl_close($process);
	return $return;
	}
		function post($url,$data,$usp=false,$hd='',$ref=false,$safe=false) { if(is_array($hd)){ foreach($hd as $key){ $this->headers[]=$key;
	}
	}
		if(!$ref){ $ref='http://www.blogger.com/';
	}
				$cookies=true;
				$process = curl_init($url);
					curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
					curl_setopt($process, CURLOPT_HEADER, 0);
					curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
					curl_setopt($process, CURLOPT_REFERER, $ref);
					curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
					curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
					curl_setopt($process, CURLOPT_TIMEOUT, 30);
		if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy);
					curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt($process, CURLOPT_POSTFIELDS, $data);
					curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		if($safe)curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($process, CURLOPT_COOKIE, $cookies);
					curl_setopt($process, CURLOPT_POST, 1);
		if($usp)	curl_setopt($process, CURLOPT_USERPWD,$usp);
		$return = curl_exec($process);
					curl_error($process);
					curl_close($process);
	return $return;
	}
}
?>