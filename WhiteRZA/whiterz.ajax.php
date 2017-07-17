<?php
function AccountStatusChange(){
		global $wpdb;
			$status=intval($_GET['Status']);
			$account=intval($_GET['accountID']);
			$update=$wpdb->query("UPDATE ". WHITERZ_ACCOUNT_TABLE ." set active='{$status}' where account_id='{$account}' ");
		if($update){ 
			$data['status']='Success'; 
		}else{	
			$data['status']='Fail';   
	}   
	exit(json_encode($data));
	} 
	function WhiterzAccountDelete(){  
		global $wpdb;   
			$account=intval($_GET['accountID']);  
			$delete=$wpdb->query("DELETE from ". WHITERZ_ACCOUNT_TABLE ." where account_id='{$account}' ");  
		if($delete){	  
			$data['status']='Success';  
		}else{	 
			$data['status']='Fail';  
		}   
	exit(json_encode($data)); 
	}  
	function WhiterzGetAccount(){   
		global $wpdb;   
			$account=$wpdb->escape($_REQUEST['accountNAME']);    
			$accounts=$delete=$wpdb->get_results("SELECT * from ". WHITERZ_ACCOUNT_TABLE ." where account_id='{$account}' "); 
	exit(json_encode($accounts));
	} 
	function WhiterzPing(){ 
		global $wpdb;    
		global $Account;   
		global $PingData;   
			require_once WHITERZ_PLUGIN_PATH. 'WhiteRZC/spinner.php';  
		if(isset($_GET['AccountID'])){ 
			$Account=$wpdb->get_row("SELECT * from ". WHITERZ_ACCOUNT_TABLE ."  where account_id='".intval($_REQUEST['AccountID'])."' "); 
		}   
		global $Whiterz_Services;   
			$AccountInfo=$Whiterz_Services[$Account->account_name]; 
			$AccountFunction=$AccountInfo['function'];  
		if(isset($_GET['PostID'])){	 
			$PingData['title']=stripslashes($_REQUEST['title']);   
			$PingData['content']=stripslashes($_REQUEST['content']);  
			$PingData['tags']=stripslashes($_REQUEST['tags']);	 
			$PingData['tagsArray']=explode(',',$PingData['tags']);  
			$PingData['url']=stripslashes($_REQUEST['url']);	  
			$PingData['post_id']=isset($_REQUEST['PostID']) ? $_REQUEST['PostID'] : false;   
		}else	
		if(isset($_POST['title'])){	 
			$PingData=$_POST; 
	}	  
			$PingData['title']=WHTSpinner::detect(stripslashes($PingData['title']),false);  
			$PingData['content']=WHTSpinner::detect(stripslashes($PingData['content']),false);	
		global $Whiterz; 
			ob_start(); 
		if(is_string($AccountFunction)){	
			$Ping=$Whiterz->$AccountFunction($PingData); 
		}else{    
			$Ping=false; 
		}
			ob_end_clean(); 
			$Pinged['url']=$Account->social_address;   
		if($Ping){			  
			$XMLRPCping=false;	 
			$Pinged['status']='success';		 
			$ping_enable=get_option('ping_enable');	
		if($ping_enable=='custom'){		 
			$XMLRPCping=true;	
		}else
		if($ping_enable='custom_account' and $Account->ping_enable==1){
			$XMLRPCping=true;	
	}	 
		if($XMLRPCping){   
			ob_start();	 
			$RPCping=WhiterzXMLRPC($Pinged['url'],'weblogUpdates.ping'); 
			$RPCping=WhiterzXMLRPC($Pinged['url'],'weblogUpdates.extendedPing');	    
			$Whiterz->gping($PingData);	 
			$Pinged['XMLrpc']=$RPCping? 'success' : 'fail'; 
			ob_end_clean();   
	}    
			$last_postt=explode(',',$Account->last_post); 
		foreach($last_postt as $b){
			$last_post[]=  str_replace('#','', $b);
		}
			if(count($last_post)==3){
				$last_posts['date']=date('d/m/Y H:i');
				$last_posts['post_id']= $PingData['post_id'] ? $PingData['post_id'] : $last_post['1'];
				$last_posts['count']=$last_post['2']+1;
			}else{
			
				$last_posts['date']=date('d/m/Y H:i');
				$last_posts['post_id']= $PingData['post_id'] ? $PingData['post_id'] : '';
				$last_posts['count']=1;
			}	 
				$last_post='#'.implode('#,#',$last_posts).'#';	 
				$wpdb->query("UPDATE ". WHITERZ_ACCOUNT_TABLE ." set last_post='$last_post' where account_id='{$Account->account_id}'");
		}else{	
			if($Account->account_name=='Wordpress'){	
				$Pinged['status']='success';	 
			}else{		 
				$Pinged['status']='fail';	  
			}		
		}	
				if(isset($_GET['AccountID'])){
			exit(json_encode($Pinged));	
		}else{	 
			return $Pinged['status'];
		}
	}
	function whiterzXMLRPCencode($yontem, $iki){    
			$cikti .= '<?xml version="1.0"?>';  
			$cikti .= '<methodCall>';
			$cikti .= '<methodName>'.$yontem.'</methodName>'; 
			$cikti .= '<params>';    
			$cikti .= '<param><value><string>'.$iki[0].'</string></value></param>'; 
			$cikti .= '<param><value><string>'.$iki[1].'</string></value></param>'; 
			$cikti .= '</params></methodCall>';  
		return $cikti;
	}
	function WhiterzXMLRPC($url,$type) { 
			$sourceURI = $url;	
			$targetURI = $url;	
			$service = 'http://blogsearch.google.com/ping/RPC2'; 
			$xmlrpc = whiterzXMLRPCencode($type,array($targetURI, $sourceURI)); 
			preg_match('@^(?:http://)?([^/]+)@i', $service, $cikti);
			$pinghost = $cikti[1];	$headers[] = "Host: ".$pinghost;   
			$headers[] = "Content-type: text/xml";    
			$headers[] = "User-Agent: LPS";  
			$headers[] = "Content-length: ".strlen($xmlrpc) . "\r\n";  
			$headers[] = $xmlrpc;	$chi = curl_init();  
		curl_setopt($chi,CURLOPT_URL,$pingurl);    
		curl_setopt($chi,CURLOPT_RETURNTRANSFER,1); 
		curl_setopt($chi, CURLOPT_CONNECTTIMEOUT, 4); 
		curl_setopt($chi,CURLOPT_HTTPHEADER,$headers);  
		curl_setopt($chi,CURLOPT_CUSTOMREQUEST,'POST');   
			$html = curl_exec( $chi );    
			$sonuc = curl_getinfo($chi); 
		curl_close($chi); 
		unset($headers);   
		return true;
	} 
	function WhiterzSetAccountPinged(){ 
			update_post_meta($_REQUEST['PostID'],'Whiterz-Ping','1'); 
	}
	function WhiterzAccountTest(){ 
		global $Whiterz_Services;   
		global $wpdb;   
		global $Account;	
			$Account=$wpdb->get_row("SELECT * from ".WHITERZ_ACCOUNT_TABLE." where account_id='".intval( $_GET['accountID'])."'");  
			$Accountx=$Whiterz_Services[$Account->account_name];  
			$AccountFunction=$Accountx['function'];
			$PingData['title']='Whiterz: Social Networks & Microblog Auto-Poster';  
			$PingData['content']='<a href="http://whiterz.com" title="Social Networks & Microblog Auto-Poster">Whiterz: Social Networks & Microblog Auto-Poster</a>'; 
			$PingData['tags']='Social, Networks, Microblog, Auto-Poster, social networks auto poster, auto poster, wordpress pligger, imleme, eklenti'; 
			$PingData['tagsArray']=explode(',',$tags);  
			$PingData['url']='http://whiterz.com';    
		ob_start();  
		global $Whiterz;
			$Ping=$Whiterz->$AccountFunction($PingData);	
			ob_end_clean();    
			$data['status']='Success';  
		if($Ping):	
			$data['message']='We sent a test message to your existing account, please check.';  
		else:   
			$data['message']='Unable to send test message. Please check your account information.';  
			endif;   
	exit(json_encode($data)); 
	} 
	function WHTCron(){ 
		ob_start();    
		if(!get_option('WHTCronLastRun')){
			update_option('WHTCronLastRun',0);    
		}  
			global $Account,$Whiterz,$PingData,$wpdb; 
			$WHTDelay=get_option('WHTCron_sleep')*60;  
			$post_aydi=$_GET['post_id'];  
		if(get_post_meta($post_aydi,'Whiterz-Ping',true)==1) exit;    
	$post=get_post($post_aydi);  
	$post_link=get_permalink($post_aydi); 
	$Pst=WhiterzTemplate2Content($post_aydi,$post);  
		if(get_option('WHTCronLastRun')+$WHTDelay>time()){   
	exit;  
	}   
	$content=$Pst['content'];    
	$title=$Pst['title']; 
	$tags=  tax2str('post_tag', $post_aydi);
	$categories=tax2str('category', $post_aydi,'id');  
	$title=explode('<!--whiterz-->',$title);  
	$content=explode('<!--whiterz-->',$content); 
	$loc=admin_url("admin-ajax.php?action=WHTCron&post_id=".$post_aydi); 
		if(isset($_GET['DPaging'])){	 
	$DyPage=$_GET['DPaging'];   
	}else{  
	$DyPage=0;   
	}   
	$DyPerPage=5;  
	$start=$DyPage*$DyPerPage;  
	$TotalAccount=$wpdb->get_var("SELECT count(*) from whiterz_account where active='1'");    
	$NextExists= $start+$DyPerPage > $TotalAccount ? false : $DyPage+1 ; 
	$ActiveAccount=$wpdb->get_results("SELECT * from whiterz_account where active='1'"); 
		if($ActiveAccount){	  
	update_option('WHTCronLastRun',time());	
	update_post_meta($post_aydi,'Whiterz-Ping',1);   
	@set_time_limit(0);		    
		foreach($ActiveAccount as $Acc){	  
	$PingData['title']=$title[array_rand($title)];	 
	$PingData['content']=$content[array_rand($content)]; 
	$PingData['tags']=$tags;    
	$PingData['tagsArray']=explode(',',$tags);	 
	$PingData['url']=$Pst['url'];	  
	$PingData['post_id']=$post_aydi;	
	$Account=$Acc;		    
	WhiterzPing();  
	}    
	}   
	ob_end_clean(); 
	exit; 
}
?>
