<?php
		if(!is_admin())
				exit();  
			add_action('wp_ajax_WhiterzAuth','WhiterzAuthFunction'); 
			add_action('wp_ajax_WhiterzClearCookie','WhiterzClearCookie'); 
	function WhiterzTopRefresh(){    
			echo '<script type="text/javascript">  
			window.resizeTo(500, 200);   
			window.opener.location.reload(); 
			window.close();     
			</script>'; 
	}
	function WhiterzClearCookie(){  	
			setcookie('FacebookProfileAccessToken','',time()-5);  
			setcookie('TwitterUserToken','',time()-5);   
			setcookie('TwitterUserTokenSecret','',time()-5);   
			setcookie('LinkedinUserToken','',time()-5);     
			setcookie('LinkedinUserTokenSecret','',time()-5);    
			setcookie('TumblrUserToken','',time()-5); 
			setcookie('TumblrUserTokenSecret','',time()-5);    
			setcookie('ScoopUserToken','',time()-5);   
			setcookie('ScoopUserTokenSecret','',time()-5);  
			header("Location:".admin_url('admin-ajax.php?action=WhiterzAuth&Service='.$_GET['Service']));  
				exit();                   
	}
	function WhiterzAuthFunction(){  
				global $WhiterzCurl;   
		if(!class_exists('WhiterzCurl')){     
			include_once WHITERZ_PLUGIN_PATH.'/WhiteRZC/whiterz.curl.php';   
				$WhiterzCurl=new WhiterzCurl();      
	}   
		if($_GET['Service']=='Facebook'){     
					$facebook_appId=get_option('whiterz_facebookAppId'); 
					$facebook_appSecret=get_option('whiterz_facebookAppSecret');     
					$current_page=admin_url('admin-ajax.php?action=WhiterzAuth&Service=Facebook&Return');   
					$code = @$_REQUEST["code"];           
		if(!isset($_GET['code'])) {    
					$dialog_url = "https://www.facebook.com/dialog/oauth?client_id=".$facebook_appId."&redirect_uri=".urlencode($current_page)."&display=popup&scope=manage_pages,publish_stream,offline_access,read_stream"; 
					header("Location:" . $dialog_url); 
		}else{          
					$token_url = "https://graph.facebook.com/oauth/access_token?client_id=". $facebook_appId
					. "&redirect_uri=" . urlencode($current_page) . "&client_secret="    
					. $facebook_appSecret . "&code=" . $code;
					$source=$WhiterzCurl->get($token_url,'');
					$tokenCode=explode('access_token=',$source);
					$tokenCode=explode('&expi',$tokenCode[1]); 
					$token=$tokenCode[0];            
					setcookie('FacebookProfileAccessToken',$token,time()+24*3600);  
					WhiterzTopRefresh();                 
		}     
	}elseif($_GET['Service']=='Twitter'){  
		if(!class_exists('WhiterzTwitter')){     
			include_once WHITERZ_PLUGIN_PATH.'/WhiteRZC/whiterz.twitter.php';  
	}      
	session_start();     
				$twitterConsumerKey=get_option('whiterz_twitterConsumerKey');   
				$twitterConsumerSecret=get_option('whiterz_twitterConsumerSecret');    
				$current_page=admin_url('admin-ajax.php?action=WhiterzAuth&Service=Twitter&Return');   
		if(!isset($_GET['oauth_verifier'])){                     
				$WhiterzTwitterOauth = new WhiterzTwitter($twitterConsumerKey, $twitterConsumerSecret);     
				$request_token = $WhiterzTwitterOauth->getRequestToken($current_page);                 
				$_SESSION['oauth_token'] = $request_token['oauth_token'];       
				$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];       
		if ($WhiterzTwitterOauth->http_code == 200) {       
				$url = $WhiterzTwitterOauth->getAuthorizeURL($request_token['oauth_token']);           
				header('Location: ' . $url);            
		exit();        
	}else{     
	exit('Error !');    
	}    
	}    
		if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {   
				$WhiterzTwitterOauth = new WhiterzTwitter($twitterConsumerKey,
				$twitterConsumerSecret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
				$access_token = $WhiterzTwitterOauth->getAccessToken($_GET['oauth_verifier']);   
				$_SESSION['access_token'] = $access_token;                      
				$user = $WhiterzTwitterOauth->get('account/verify_credentials');          
		if (!array_key_exists('errors',$user)) {          
				setcookie('TwitterUserToken',$_SESSION['access_token']['oauth_token'],time()+24*3600);   
				setcookie('TwitterUserTokenSecret',$_SESSION['access_token']['oauth_token_secret'],time()+24*3600);     
				WhiterzTopRefresh();          
	exit;         
    }else{      
	exit('Error!');  
	}      
	}   
	}elseif($_GET['Service']=='Tumblr'){ 
		if(!class_exists('WhiterzTumblr')){  
			include_once WHITERZ_PLUGIN_PATH.'/WhiteRZC/whiterz.tumblr.php';  
	}    
	session_start(); 
				$tumblrConsumerKey=get_option('whiterz_tumblrConsumerKey');  
				$tumblrConsumerSecret=get_option('whiterz_tumblrConsumerSecret');    
				$current_page=admin_url('admin-ajax.php?action=WhiterzAuth&Service=Tumblr&Return');   
		if(!isset($_GET['oauth_verifier'])) {                 
				$WhiterzTumblrOauth = new WhiterzTumblr($tumblrConsumerKey, $tumblrConsumerSecret);         
				$request_token = $WhiterzTumblrOauth->getRequestToken($current_page);             
				$_SESSION['oauth_token'] = $request_token['oauth_token'];       
				$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];  
		if ($WhiterzTumblrOauth->http_code == 200) {          
				$url = $WhiterzTumblrOauth->getAuthorizeURL($request_token['oauth_token']);     
				header('Location: ' . $url);          
				exit();       
	}else{          
	exit('Error !');        
	}     
    }     
    if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {      
				$WhiterzTumblrOauth = new WhiterzTumblr($tumblrConsumerKey,
				$tumblrConsumerSecret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
				$access_token = $WhiterzTumblrOauth->getAccessToken($_GET['oauth_verifier']);  
				$_SESSION['access_token'] = $access_token;                  
				$WhiterzTumblrOauth = new WhiterzTumblr($tumblrConsumerKey,
				$tumblrConsumerSecret, $access_token['oauth_token'], $access_token['oauth_token_secret']);
				$user = $WhiterzTumblrOauth->get('user/info');                
		if ($WhiterzTumblrOauth->http_code == 200) {      
				setcookie('TumblrUserToken',$_SESSION['access_token']['oauth_token'],time()+24*3600);   
				setcookie('TumblrUserTokenSecret',$_SESSION['access_token']['oauth_token_secret'],time()+24*3600);  
				WhiterzTopRefresh();          
	exit;         
    } else {         
	exit('Error!');    
	}  
	}   
	}elseif($_GET['Service']=='Linkedin'){     
    if(!class_exists('WhiterzLinkedin')){        
			include_once WHITERZ_PLUGIN_PATH.'/WhiteRZC/whiterz.linkedin.php';    
	}       
	session_start();              
				$ConsumerKey=get_option('whiterz_linkedinConsumerKey');  
				$ConsumerSecret=get_option('whiterz_lnkedinConsumerSecret');    
				$current_page=admin_url('admin-ajax.php?action=WhiterzAuth&Service=Linkedin&Return');   
				$WhiterzOauth = new WhiterzLinkedin($ConsumerKey, $ConsumerSecret, $current_page );     
    if (isset($_REQUEST['oauth_verifier'])){        
				$_SESSION['oauth_verifier']     = $_REQUEST['oauth_verifier'];      
				$WhiterzOauth->request_token    =   unserialize($_SESSION['requestToken']);  
				$WhiterzOauth->oauth_verifier   =   $_SESSION['oauth_verifier'];   
				$WhiterzOauth->getAccessToken($_REQUEST['oauth_verifier']);     
				$_SESSION['oauth_access_token'] = serialize($WhiterzOauth->access_token);  
				$_SESSION['twp_user_token']=$WhiterzOauth->access_token;         }   
	else{           
				$WhiterzOauth->request_token    =   unserialize($_SESSION['requestToken']);  
				$WhiterzOauth->oauth_verifier   =   $_SESSION['oauth_verifier'];      
				$WhiterzOauth->access_token     =   unserialize($_SESSION['oauth_access_token']);   
				$WhiterzOauth->getRequestToken();          
				$_SESSION['requestToken'] = serialize($WhiterzOauth->request_token);    
				header("Location: " . $WhiterzOauth->generateAuthorizeUrl());   
	}    
		if (isset($_SESSION['requestToken']) && isset($_SESSION['oauth_verifier']) && isset($_SESSION['oauth_access_token'])){   
				$xml_response = $WhiterzOauth->getProfile("~:(id,first-name,last-name,headline,picture-url,public-profile-url,email-address)"); 
				$user=json_decode(json_encode(simplexml_load_string($xml_response)));                        
		if ($user) {        
				$oauth_info=$_SESSION['twp_user_token'];        
				setcookie('LinkedinUserToken',$oauth_info->key,time()+24*3600);   
				setcookie('LinkedinUserTokenSecret',$oauth_info->secret,time()+24*3600);   
				WhiterzTopRefresh();                 
	exit;     
	} else {   
	exit('Error!');        
	}      
	}; 
    }elseif($_GET['Service']=='Plurk'){    
		if(!class_exists('WhiterzPlurk')){     
			include_once WHITERZ_PLUGIN_PATH.'/WhiteRZC/whiterz.plurk.php';     
    }         session_start();               
				$ConsumerKey=get_option('whiterz_plurkAppId');  
				$ConsumerSecret=get_option('whiterz_plurkAppSecret');     
				$current_page=admin_url('admin-ajax.php?action=WhiterzAuth&Service=Plurk&Return');           
		if(!isset($_GET['oauth_verifier'])) {   
				$WHTAuth = new WhiterzPlurk($ConsumerKey, $ConsumerSecret);    
				$request_token = $WHTAuth->getRequestToken($current_page);      
				$_SESSION['oauth_token'] = $request_token['oauth_token'];        
				$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];  
				$WHTAuth->http_code;             if ($WHTAuth->http_code == 200) {        
				$url = $WHTAuth->getAuthorizeURL($request_token['oauth_token']);       
				header('Location: ' . $url);           
				exit();       
	}else{           
	exit('Error !');      
	}    
	}  
		if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) { 
				$WHTAuth = new WhiterzPlurk(    
				$ConsumerKey,              
				$ConsumerSecret,        
				$_SESSION['oauth_token'],       
				$_SESSION['oauth_token_secret']);      
				$access_token = $WHTAuth->getAccessToken($_GET['oauth_verifier']);       
				$_SESSION['access_token'] = $access_token;     
				$user = $WHTAuth->get('Users/me');       
		if (array_key_exists('id',$user)) {       
				setcookie('PlurkUserToken',$_SESSION['access_token']['oauth_token'],time()+24*3600);   
				setcookie('PlurkUserTokenSecret',$_SESSION['access_token']['oauth_token_secret'],time()+24*3600);       
				WhiterzTopRefresh();       
			exit;     
		} else {        
		exit('Error!');        
		}     
    } 
  }
 exit;
}?> 
