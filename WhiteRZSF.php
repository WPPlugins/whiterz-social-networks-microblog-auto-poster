<?php
class Whiterz {
	var $api_url = null;
	function Whiterz(){
		$this->api_url = 'http://api.whiterz.com/WHT/API.php/1.0/';
		$this->WhiterzLicenceCheck();
	}
	function facebook_p($array){
		if (!$this->ping){return false;}
		global $Account;
		if(!class_exists('Facebook')){
		require_once(WHITERZ_PLUGIN_PATH . 'WhiteRZC/facebook.php');
		}
		$user_token = $Account->user_token;
		$facebook = new Facebook(array('appId' => get_option("whiterz_facebookAppId"), 'secret' => get_option('whiterz_facebookAppSecret')));
		$facebook->setAccessToken($user_token);
		$args = array('access_token' => $user_token, 'message' => $array['title'] . 'Read More -> ' . $array['url'], 'link' => $array['url']);
		$fb_api = $facebook->api('/me/feed', 'post', $args);
		return (array_key_exists('error', $fb_api) ? false : true);
		}
	function facebook_fp($array){
	if (!$this->ping){return false;}
		global $Account;
	if (!class_exists('Facebook')){
		require_once(WHITERZ_PLUGIN_PATH . 'WhiteRZC/facebook.php');
		}
		$user_token = $Account->user_token;
		$facebook = new Facebook(array("appId" => get_option("whiterz_facebookAppId"), "secret" => get_option("whiterz_facebookAppSecret")));
		$facebook->setAccessToken($user_token);
		$args = array('access_token' => $user_token, 'message' => $array['title'] . 'Read More -> ' . $array['url'], 'link' => $array['url']);
		$fb_api = $facebook->api('/' . $Account->custom_fields . '/feed', 'post', $args);
		return (array_key_exists('error', $fb_api) ? false : true);
	} 
	function twitter($array)
	{
	if (!$this->ping){
		return false;
	}
		global $Account;
		if(!class_exists('WhiterzTwitter'))
		{
	require_once(WHITERZ_PLUGIN_PATH . 'WhiteRZC/whiterz.twitter.php');
		} $ConsumerKey = get_option('whiterz_twitterConsumerKey');
		$ConsumerSecret = get_option('whiterz_twitterConsumerSecret');
		$oauth_token = $Account->user_token; $oauth_token_secret = $Account->user_token_secret;
		$message = $array['title'] . '' . $this->prefix . '' . $array['url'];
		$Twitter = new WhiterzTwitter($ConsumerKey, $ConsumerSecret, $oauth_token, $oauth_token_secret);
		$content = $Twitter->get('trends/place', array('id' => '23424977'));
		if ($Account->custom_field == 1){
		foreach($content[0]->trends as $trend)
		{
		$content = $Twitter->post('statuses/update', array('status' => $trend->name . ' ' . $message));
		break;
		}
	}else{
		$content = $Twitter->post('statuses/update', array('status' => $message));
	}
		return (array_key_exists('error', $content) ? false : true);
	}
	function friendfeed($array){
		if (!$this->ping){return false;}
		global $Account;
		global $WhiterzCurl;
		$login = $Account->login;
		$api = $Account->api_key;
		$data = http_build_query(array('body' => $array['title'] . ' : ' . strip_tags($array['content']),
		'link' => $array['url'], 'comment' => $array['title'] . ' -> ' . $array['url']));
		$content = $WhiterzCurl->post('http://friendfeed-api.com/v2/entry', $data, '' . $login . ':' . $api);
		$content = json_decode($content); return (!array_key_exists('body', $content) ? false : true);
	}
	function googleplus($array){
		if (!$this->ping){return false;}
		global $Account;
		global $WhiterzCurl;
		$api_key = $Account->api_key;
		$request = array('gmail' => $Account->login, 'password' => $Account->passwd, 'body' => $array,
		'domain' => $this->domain(), 'action' => 'PostGooglePlus', 'account' => $Account);
		$request['account'] = $Account; $URL = $this->api_url; $rq = http_build_query($request);
		$query = trim($WhiterzCurl->post($URL, $rq));
		if (preg_match('@success@', $query)){return true;}
		return false;
	}
	function youtube($array){
		if (!$this->ping){return false;}
		global $Account;
		global $WhiterzCurl;
		$api_key = $Account->api_key;
		$request = array('gmail' => $Account->login, 'password' => $Account->passwd, 'chUrl' => $Account->social_address,
		'body' => $array, 'domain' => $this->domain(), 'action' => 'PostYouTube');
		$URL = $this->api_url;
		$query = $WhiterzCurl->post($URL, http_build_query($request));
		if(preg_match('@success@', $query))
		{return true;}
		return false;
	}
	function pinterest($array){
		if(!$this->ping){return false;}
		global $WhiterzCurl;
		global $Account;
		$api_key = $Account->api_key;
		$request = array('email' => $Account->login, 'password' => $Account->passwd, 'board_id' => $Account->custom_field,
		'body' => $array, 'domain' => $this->domain(), 'action' => 'PostPin');
		$URL = $this->api_url;
		$query = $WhiterzCurl->post($URL, http_build_query($request));
		if (preg_match('@success@', $query))
		{return true;}
		return false;
	}
	function delicious($array){
		if(!$this->ping){return false;}
		global $Account;
		global $WhiterzCurl;
		$login = $Account->login;
		$pass = $Account->passwd;
		$apiurl = '' . 'https://' . $login . ':' . $pass . '@api.del.icio.us/v1/posts/add';
		$data = http_build_query(array('url' => $array['url'], 'description' => $array['title'],
		'extended' => strip_tags($array['content'] . ' -> ' . $array['url']), 'tags' => $array['tags']));
		$apiurl = $apiurl . '?' . $data; $content = $WhiterzCurl->get($apiurl);
		return true;
	}
	function linkedin($array){
		if(!$this->ping){return false;}
		global $Account;
		if (!class_exists('WhiterzLinkedin'))
		{
		require_once(WHITERZ_PLUGIN_PATH . 'WhiteRZC/whiterz.linkedin.php');
		} $ConsumerKey = get_option('whiterz_linkedinConsumerKey');
		$ConsumerSecret = get_option('whiterz_lnkedinConsumerSecret');
		$oauth_token = $Account->user_token;
		$oauth_token_secret = $Account->user_token_secret;
		$Linkedin = new WhiterzLinkedin($ConsumerKey, $ConsumerSecret);
		$Linkedin->setToken(array('oauth_token' => $oauth_token,
		'oauth_token_secret' => $oauth_token_secret));
		$args = array('message' => $array['title'] . '' . $this->prefix . '' . $array['url'], 'link' => $array['url'],
		'title' => $array['title']); $content = $Linkedin->setStatus($args['message']);
		return true; 
	}
	function tumblr($array){
		if(!$this->ping){return false;}
		global $Account;
		if(!class_exists('WhiterzTumblr')){
		require_once(WHITERZ_PLUGIN_PATH . 'WhiteRZC/whiterz.tumblr.php');
		}
		$ConsumerKey =get_option('whiterz_tumblrConsumerKey');
		$ConsumerSecret = get_option('whiterz_tumblrConsumerSecret');
		$oauth_token = $Account->user_token;
		$oauth_token_secret = $Account->user_token_secret;
		$blogname = $Account->login;
		$args = array('type' => 'link', 'title' => $array['title'],
		'description' => $array['content'], 'url' => $array['url']);
		$Tumblr = new WhiterzTumblr($ConsumerKey, $ConsumerSecret, $oauth_token, $oauth_token_secret);
		$content = $oauth_token = $Tumblr->post('blog/' . $blogname . '.tumblr.com/post', $args);
		return ($content->meta->status == '201' & $content->meta->status == 'Created' ? false : true);
	}
	function wordpress($array){
		if (!$this->ping)
		{return false;}
		global $Account;
		if(!class_exists('IXR_Client')){
		require_once(WHITERZ_PLUGIN_PATH . 'WhiteRZC/whiterz.xmlrpc.php');
		}
		$login = $Account->login; $pass = $Account->passwd;
		$blog = $Account->social_address; $strlen = strlen($blog);
		$blog = (substr($blog, $strlen - 1, 1) != '/' ? $blog . '/' : $blog);
		$XmlRPC = new IXR_Client($blog . 'xmlrpc.php');
		$wp['title'] = $array['title'];
		$wp['categories'] = array('NewCategory', 'Nothing');
		$wp['description'] = (preg_match('@<a @', $array['content']) ? $array['content'] :
		$array['content'] . ' <a href="' . $wp['url'] . '" title="' . $wp['title'] . '"rel="friend">' . $wp['title'] . '</a>');
		$wp['mt_keywords'] = $array['tagsArray'];
		return $XmlRPC->query('metaWeblog.newPost', '', $login, $pass, $wp, true);
	}
	function blogger($array){
		global $Blogger;
		$Blogger = $array;
		if(!$this->ping){return true;}
		global $Account;
		global $WhiterzCurl;
		if (!class_exists('WhiterzBlogger')) {
		require_once(WHITERZ_PLUGIN_PATH . 'WhiteRZC/whiterz.blogger.php');
		}
		$blog = new WhiterzBlogger();
		if ($blog->status){return true;}return true;}
		function filter_utf8($v){return $v;
	}
	function diigo($array){
		if(!$this->ping){return false;}
		global $Account;
		global $WhiterzCurl;
		$login = $Account->login;
		$pass = $Account->passwd;
		$api_key = $Account->api_key;
		$params = http_build_query(array('key' => $api_key,
		'url' => strip_tags($array['url']),'title' => strip_tags($array['title']),
		'shared' => 'yes','tags' => strip_tags($array['tags']),'desc' => strip_tags($array['content'])));
		$content = $WhiterzCurl->post('https://secure.diigo.com/api/v2/bookmarks',
		$params, '' . $login . ':' . $pass);
		$content = json_decode($content);
		return ($content->code == '1' ? true : false);
	}
	function livejournal($array){
		if(!$this->ping){return false;}
		global $Account;if(!class_exists('port'))
		{include_once(WHITERZ_PLUGIN_PATH.'WhiteRZC/xmlrpc.inc.php');}
		$port = new port();
		$port->add('username', $Account->login, 'string');
		$port->add('password', $Account->passwd, 'string');
		$date = time(); $year = date("Y", $date);
		$mon = date("m", $date);
		$day = date("d", $date);
		$hour = date("G", $date);
		$min = date("i", $date);
		$port->add('mon', $mon, 'int');
		$port->add('day', $day, 'int');
		$port->add('year', $year, 'int');
		$port->add('hour', $hour, 'int');
		$port->add('min', $min, 'int');
		$port->add('security', 'public', 'string');
		$port->add('subject', $array['title'], 'string');
		$port->add('lineendings', 'unix', 'string');
		$port->add('event', strip_tags($array['content']) . ' - ' . $array['url'], 'string');
		$port->add('ver', '2', 'int');
		$port->send();
		$content = date('Y', $date);
		return true;
	}
	function twitxr($array){
		if (!$this->ping){return false;}
		global $Account;
		global $WhiterzCurl;
		$login = $Account->login;
		$pass = md5($send->passwd);
		$url = '' . 'http://' . $login . ':' . $pass . '@twitxr.com/api/rest/postUpdate.php';
		$request_data = http_build_query(array('text' => $array['title'] . ' -> ' . $array['url'], 'place' => 'New York,USA'));
		echo $WhiterzCurl->post($url, $request_data);
	}
	function zootool($array){
		if(!$this->ping){return false;}
		global $Account;
		$key = $Account->api_key;
		$secret = $Account->api_secret;
		$login = $Account->login;
		$pass = $Account->passwd;
		if (!class_exists('ZootoolGatePHPAdd')){
		include_once('WhiteRZC/ZootoolGatePHP.php');
		include_once('WhiteRZC/ZootoolGatePHPAdd.php');
		}
		$zoogateAdd = new ZootoolGatePHPAdd();
		$zoogateAdd->setApikey($key);
		$zoogateAdd->setUsername($login);
		$zoogateAdd->setPassword($pass);
		$result = $zoogateAdd->post('add', array('login' => 1,
		'url' => $array['url'], 'title' => $array['title'], 'public' => 'y'));
		$content = json_decode($result);
		return ($content->status == 'success' ? true : false);
	}
	function status($array){
		if (!$this->ping){return false;}
		global $Account;
		global $WhiterzCurl;
		$login = $Account->login;
		$pass = $Account->passwd;
		$params = http_build_query(array('status' => $array['title'] . ' - ' . $array['url']));
		$StatusURL = $Account->social_address; $http_protocol = explode('//', $StatusURL);
		$StatusURL = explode('/', $StatusURL);
		$StatusURL = $http_protocol[0] . '//' . $StatusURL = $StatusURL[2];
		$strlen = strlen($StatusURL);
		$StatusURL = (substr($StatusURL, $strlen - 1, 1) != '/' ? $StatusURL . '/' : $StatusURL);
		$content = $WhiterzCurl->post($StatusURL . 'api/statuses/update.xml', $params, '' . $login . ':' . $pass);
		return true;
	}
	function plerb($array){
		if(!$this->ping){return false;}
		global $Account;
		global $WhiterzCurl;
		$params = http_build_query(array('authuser' => $Account->login,'authpass' => $Account->passwd,
		'status' => $array['title'] . ' - ' . $array['url'], 'api_key' => $Account->api_key));
		$content = $WhiterzCurl->post('http://plerb.com/api/statuses/update/', $params);
		return (preg_match('@ok@', $content) ? true : false);
	}
	function buzzerly($array){
		if (!$this->ping){return false;}
		global $Account;
		global $WhiterzCurl;
		$login = $Account->login;
		$pass = $Account->passwd;
		$params = http_build_query(array('return' => '', 'user' => $login, 'pass' => $pass));
		http_build_query(array('type' => 'post', 'return' => '', 'message' => $array['title'],
		'link' => $array['url'])); $params = $WhiterzCurl->post('http://buzzerly.com/signin', $params);
		$ret = $WhiterzCurl->post('http://buzzerly.com/post', $params);
		return true;
		}
	function linklicious($array){
		if (!$this->ping){return false;}
		global $Account;
		global $WhiterzCurl;
		$api_key = $Account->api_key;
		$per_day = $Account->custom_field;
		$request = array('userId' => $api_key, 'links' => $array['url'],'linksPerDay' => $per_day);
		if ($Account->passwd == 'Whiterz'){
		$request['userId'] = $Account->api_secret;
		$request['action'] = 'linklicious';
		$Request = http_build_query($request);
		$url = $this->api_url . '?' . $Request;
		$query = $WhiterzCurl->get($url); 
		}else{
		$Request = http_build_query($request);
		$url = 'http://linklicious.me/api/addlinks?' . $Request; $query = $WhiterzCurl->get($url);
		} $content = json_decode($query);
		if($content->linksAdded == '1'){return true;} 
		return false;
	}
	function gping($array){
		if(!$this->ping){
		return false;}
		global $WhiterzCurl;
		global $Account;
		$PingURL = 'http://blogsearch.google.com/ping?url=' . urlencode($array['url']) . '&btnG=Submit+Blog&hl=tr';
		$WhiterzCurl->get($PingURL);
		$PingURL = 'http://blogsearch.google.com/ping?url=' . urlencode($Account->social_address) . '&btnG=Submit+Blog&hl=tr';
		$WhiterzCurl->get($PingURL);}
		function plurk_post($array){
		global $Account;
		if (!class_exists('WhiterzPlurk')){
		include_once(WHITERZ_PLUGIN_PATH . '/WhiteRZC/whiterz.plurk.php');
		}
		$token = $Account->user_token;
		$token_secret = $Account->user_token_secret;
		$plurk_api_key = get_option("whiterz_plurkAppId");
		$plurk_api_secret = get_option("whiterz_plurkAppSecret");
		$WHTAuth = new WhiterzPlurk($plurk_api_key, $plurk_api_secret, $token, $token_secret);
		$post_data = array("content" => $array["title"] . "" . $this->prefix . "" . $array["url"], "qualifier" => "shares", "lang" => "tr");
		$content = $WHTAuth->post("Timeline/plurkAdd", $post_data);
		if (array_key_exists("plurk_id", $content)) {return true;} return false;
	}
	function onsugar($array){
		if (!$this->ping) {return false;}
		global $WhiterzCurl;
		global $Account;
		$login = $Account->login;
		$pass = $Account->passwd;
		$blog = $data = http_build_query(array('title' => $array['title'], 'body' => $array['content'],
		'login' => $login, 'password' => $pass, 'callback' => 'json'));
		$strlen = strlen($blog);
		$blog = (substr($blog, $strlen - 1, 1) != '/' ? $blog . '/' : $blog);
		$WhiterzCurl->post($blog . 'api/posts/create', $data);
		$post = $Account->social_address;
		if (preg_match('#id#', $post)){return true;}
		return false;
	}
	function lmd2serial($key){
		$a = strtoupper($key); $b = ''; $b[] = substr($a, 0, 4); $b[] = substr($a, 8, 4);
		$b[] = substr($a, 14, 4); $b[] = substr($a, 20, 4); $b[] = substr($a, 26, 10);
		return implode($b, '-');
	}
	function domain(){
		preg_match('@^(?:http(?:s)?://)?([^/]+)@i', getenv('HTTP_HOST'), $dizi);
		$domain['1'];
		$domain = preg_match('@^(?:www.)?(.*)@i', $dizi[0], $domain);
		return $domain;
	}
		function whiterz_licence_check($key){
			global $WhiterzCurl; $html = $WhiterzCurl->get('http://91.143.87.117/get-licence-key?serial=' . $key);
			if (trim($html) == 'valid'){
			return 'Whiterz PRO';}}
			function WhiterzLicenceCheck(){
			global $wpdb;
			global $WhiterzCurl;
			$this->ping = true;
			$lc = $this->whiterz_licence_check(get_option('whiterz_licence_key'));
		if (!$lc){
			$this->ping = false;
			$this->error[] = 'You do not enter licence key or your licence key has 
			expired.Your account has been temporarily blocked.Please take 
			free licence key from this adress :<a href="http://whiterz.com/
			get-licence-key/" target="_blank" class="label label-info" style
			="font-size:9px">Get Licence Key</a>';
			return null;
		}
	}
}

	function whiterz_licence_check($key){
		global $Whiterz;
		global $WhiterzCurl;
		return $Whiterz->whiterz_licence_check($key);
	}
	function serial2cron(){
		if(whiterz_licence_check(get_option('whiterz_licence_key'))){
			$key = md5(get_option('whiterz_licence_key'));
			$a = strtoupper($key); $b = ''; $b[] = substr($a, 0, 4); $b[] = substr($a, 8, 4);
			$b[] = substr($a, 26, 10);
			return 'CRON-' . implode($b, '');
		}
		return false;
	}
	global $Whiterz;
$Whiterz = new Whiterz();
?>
