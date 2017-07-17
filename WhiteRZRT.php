<?php
if(!function_exists('Whiterz_Wp_Head')){
		add_action('admin_head', 'Whiterz_Wp_Head');
    function Whiterz_Wp_Head(){
		if(@$_GET['page']!='Whiterz') return;
			echo '<link rel="stylesheet" href="'.WHITERZ_PLUGIN_DIR.'WhiteRZIA/bootstrap.css">';
			echo '<link rel="stylesheet" media="screen" href="'.WHITERZ_PLUGIN_DIR.'WhiteRZIA/admin.css'.'" />';
?> 
			<link rel="stylesheet" href="<?php echo WHITERZ_PLUGIN_DIR; ?>WhiteRZES/d6220a84.bootstrap.css">
			<link rel="stylesheet" href="<?php echo WHITERZ_PLUGIN_DIR; ?>WhiteRZES/vendor/jquery.pnotify.default.css">
			<link rel="stylesheet" href="<?php echo WHITERZ_PLUGIN_DIR; ?>WhiteRZES/vendor/select2/select2.css">
			<link rel="stylesheet" href="<?php echo WHITERZ_PLUGIN_DIR; ?>WhiteRZES/1b2c4b33.proton.css">
			<link rel="stylesheet" href="<?php echo WHITERZ_PLUGIN_DIR; ?>WhiteRZES/vendor/animate.css">
			<link rel="stylesheet" href="<?php echo WHITERZ_PLUGIN_DIR; ?>WhiteRZES/9a41946e.font-awesome.css" type="text/css" />
			<link rel="stylesheet" href="<?php echo WHITERZ_PLUGIN_DIR; ?>WhiteRZES/4d9a7458.font-titillium.css" type="text/css" />
			<script>function ac1(){document.getElementById('acilacak_div1').style.display = 'block';}function kapat1(){document.getElementById('acilacak_div1').style.display = 'none';} function ac2(){document.getElementById('acilacak_div2').style.display = 'block';}function kapat2(){document.getElementById('acilacak_div2').style.display = 'none';} function ac3(){document.getElementById('acilacak_div3').style.display = 'block';}function kapat3(){document.getElementById('acilacak_div3').style.display = 'none';} function ac4(){document.getElementById('acilacak_div4').style.display = 'block';}function kapat4(){document.getElementById('acilacak_div4').style.display = 'none';} function ac5(){document.getElementById('acilacak_div5').style.display = 'block';}function kapat5(){document.getElementById('acilacak_div5').style.display = 'none';} function ac6(){document.getElementById('acilacak_div6').style.display = 'block';}function kapat6(){document.getElementById('acilacak_div6').style.display = 'none';} function ac7(){document.getElementById('acilacak_div7').style.display = 'block';}function kapat7(){document.getElementById('acilacak_div7').style.display = 'none';} function ac8(){document.getElementById('acilacak_div8').style.display = 'block';}function kapat8(){document.getElementById('acilacak_div8').style.display = 'none';} function ac9(){document.getElementById('acilacak_div9').style.display = 'block';}function kapat9(){document.getElementById('acilacak_div9').style.display = 'none';} function ac10(){document.getElementById('acilacak_div10').style.display = 'block';}function kapat10(){document.getElementById('acilacak_div10').style.display = 'none';}</script>
			<style type="text/css" id="vakata-stylesheet">#vakata-dragged { display:block; margin:0 0 0 0; padding:4px 4px 4px 24px; position:absolute; top:-2000px; line-height:16px; z-index:10000; } #vakata-contextmenu { display:block; visibility:show; left:0; top:-200px; position:absolute; margin:0; padding:0; min-width:180px; background:#ebebeb; border:1px solid silver; z-index:10000; *width:180px; } #vakata-contextmenu ul { min-width:180px; *width:180px; } #vakata-contextmenu ul, #vakata-contextmenu li { margin:0; padding:0; list-style-type:none; display:block; } #vakata-contextmenu li { line-height:20px; min-height:20px; position:relative; padding:0px; } #vakata-contextmenu li a { padding:1px 6px; line-height:17px; display:block; text-decoration:none; margin:1px 1px 0 1px; } #vakata-contextmenu li ins { float:left; width:16px; height:16px; text-decoration:none; margin-right:2px; } #vakata-contextmenu li a:hover, #vakata-contextmenu li.vakata-hover > a { background:gray; color:white; } #vakata-contextmenu li ul { display:none; position:absolute; top:-2px; left:100%; background:#ebebeb; border:1px solid gray; } #vakata-contextmenu .right { right:100%; left:auto; } #vakata-contextmenu .bottom { bottom:-1px; top:auto; } #vakata-contextmenu li.vakata-separator { min-height:0; height:1px; line-height:1px; font-size:1px; overflow:show; margin:0 2px; background:silver; /* border-top:1px solid #fefefe; */ padding:0; } </style>
			<style type="text/css" id="jstree-stylesheet">.jstree ul, .jstree li { display:block; margin:0 0 0 0; padding:0 0 0 0; list-style-type:none; } .jstree li { display:block; min-height:18px; line-height:18px; white-space:nowrap; margin-left:18px; min-width:18px; } .jstree-rtl li { margin-left:0; margin-right:18px; } .jstree > ul > li { margin-left:0px; } .jstree-rtl > ul > li { margin-right:0px; } .jstree ins { display:inline-block; text-decoration:none; width:18px; height:18px; margin:0 0 0 0; padding:0; } .jstree a { display:inline-block; line-height:16px; height:16px; color:black; white-space:nowrap; text-decoration:none; padding:1px 2px; margin:0; } .jstree a:focus { outline: none; } .jstree a > ins { height:16px; width:16px; } .jstree a > .jstree-icon { margin-right:3px; } .jstree-rtl a > .jstree-icon { margin-left:3px; margin-right:0; } li.jstree-open > ul { display:block; } li.jstree-closed > ul { display:none; } #vakata-dragged ins { display:block; text-decoration:none; width:16px; height:16px; margin:0 0 0 0; padding:0; position:absolute; top:4px; left:4px;  -moz-border-radius:4px; border-radius:4px; -webkit-border-radius:4px; } #vakata-dragged .jstree-ok { background:green; } #vakata-dragged .jstree-invalid { background:red; } #jstree-marker { padding:0; margin:0; font-size:12px; overflow:show; height:12px; width:8px; position:absolute; top:-30px; z-index:10001; background-repeat:no-repeat; display:none; background-color:transparent; text-shadow:1px 1px 1px white; color:black; line-height:10px; } #jstree-marker-line { padding:0; margin:0; line-height:0%; font-size:1px; overflow:show; height:1px; width:100px; position:absolute; top:-30px; z-index:10000; background-repeat:no-repeat; display:none; background-color:#456c43;  cursor:pointer; border:1px solid #eeeeee; border-left:0; -moz-box-shadow: 0px 0px 2px #666; -webkit-box-shadow: 0px 0px 2px #666; box-shadow: 0px 0px 2px #666;  -moz-border-radius:1px; border-radius:1px; -webkit-border-radius:1px; }.jstree .jstree-real-checkbox { display:none; } .jstree-themeroller .ui-icon { overflow:visible; } .jstree-themeroller a { padding:0 2px; } .jstree-themeroller .jstree-no-icon { display:none; }.jstree .jstree-wholerow-real { position:relative; z-index:1; } .jstree .jstree-wholerow-real li { cursor:pointer; } .jstree .jstree-wholerow-real a { border-left-color:transparent !important; border-right-color:transparent !important; } .jstree .jstree-wholerow { position:relative; z-index:0; height:0; } .jstree .jstree-wholerow ul, .jstree .jstree-wholerow li { width:100%; } .jstree .jstree-wholerow, .jstree .jstree-wholerow ul, .jstree .jstree-wholerow li, .jstree .jstree-wholerow a { margin:0 !important; padding:0 !important; } .jstree .jstree-wholerow, .jstree .jstree-wholerow ul, .jstree .jstree-wholerow li { background:transparent !important; }.jstree .jstree-wholerow ins, .jstree .jstree-wholerow span, .jstree .jstree-wholerow input { display:none !important; }.jstree .jstree-wholerow a, .jstree .jstree-wholerow a:hover { text-indent:-9999px; !important; width:100%; padding:0 !important; border-right-width:0px !important; border-left-width:0px !important; } .jstree .jstree-wholerow-span { position:absolute; left:0; margin:0px; padding:0; height:18px; border-width:0; padding:0; z-index:0;}}</style>         <script language="javascript" type="text/javascript" src="<?php echo WHITERZ_PLUGIN_DIR; ?>WhiteRZIA/admin.js"></script>
			<nav class="main-menu">
			<ul>
			<li>
			<a href="admin.php?page=Whiterz" onMouseOver="ac1()" onMouseout="kapat1()">
			<i class="icon-home nav-icon"></i>
			<span class="nav-text">
			News
			</span>
			</a>
			</li>
			<li class="has-subnav">
			<a href="admin.php?page=Whiterz&WhiterzGET=Accounts" onMouseOver="ac2()" onMouseout="kapat2()">
			<i class="icon-laptop nav-icon"></i>
			<span class="nav-text">
			Accounts
			</span>
			<i class="icon-angle-right"></i>
			</a>
			</li>
			<li class="has-subnav">
			<a href="admin.php?page=Whiterz&WhiterzGET=Manuel" onMouseOver="ac3()" onMouseout="kapat3()">
            <i class="icon-list nav-icon">
			</i>
            <span class="nav-text">
            Manuel Pligger
			</span>
            <i class="icon-angle-right"></i>
			</a>
			<li>
			<a href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=ContentSettings" onMouseOver="ac10()" onMouseout="kapat10()">
			<i class="icon-font nav-icon"></i>
			<span class="nav-text">
			Content Settins
			</span>
			</a>
			</li>
			<li>
			<a class="subnav-text" href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=AppSettings" onMouseOver="ac4()" onMouseout="kapat4()">
			<i class="icon-warning-sign nav-icon"></i>
			App Settings
			</a>
			</li>
			<li>
			<a class="subnav-text" href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=BookmarkingSettings" onMouseOver="ac5()" onMouseout="kapat5()">
			<i class="icon-table nav-icon"></i>
			Bookmarking Settings
			</a> 
			</li>     
			</li>     
            <li class="has-subnav">        
			<a href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=LinkShorten" onMouseOver="ac6()" onMouseout="kapat6()">           
			<i class="icon-folder-open nav-icon"></i>               
			<span class="nav-text">                         
			Link Shorten                  
			</span>                     
			<i class="icon-angle-right"></i>             
			</a>              
			</li>            
			<li>                 
			<a href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=PostType/Editor" onMouseOver="ac7()" onMouseout="kapat7()">   
			<i class="icon-bar-chart nav-icon"></i>  
			<span class="nav-text">                  
			Post/Type & Editor                
			</span>           
			</a>     
            </li>        
			<li>            
			<a href="admin.php?page=Whiterz&WhiterzGET=Licence" onMouseOver="ac8()" onMouseout="kapat8()">            
			<i class="icon-info-sign nav-icon"></i>      
			<span class="nav-text">             
			Licence                      
			</span>           
			</a>  
			</li> 				
			<div style="float: right;top: 30px;right: -10px;margin-right: 70px;position: absolute;"> 	
			<div id="acilacak_div1" style="display:none;"> 		
			<img width="46px" height="444px" src="<?php echo WHITERZ_PLUGIN_DIR; ?>/WhiteRZI/homepage.png"> 		
			</div> 						
			<div id="acilacak_div2" style="display:none;"> 	
			<img width="46px" height="444px" src="<?php echo WHITERZ_PLUGIN_DIR; ?>/WhiteRZI/accounts.png"> 
			</div> 				
			<div id="acilacak_div3" style="display:none;"> 	
			<img width="46px" height="444px" src="<?php echo WHITERZ_PLUGIN_DIR; ?>/WhiteRZI/manuel.png"> 
			</div> 				
			<div id="acilacak_div10" style="display:none;"> 	
			<img width="46px" height="444px" src="<?php echo WHITERZ_PLUGIN_DIR; ?>/WhiteRZI/contentsettings.png"> 		
			</div> 					
			<div id="acilacak_div4" style="display:none;"> 			
			<img width="46px" height="444px" src="<?php echo WHITERZ_PLUGIN_DIR; ?>/WhiteRZI/application.png"> 			
			</div> 		
			<div id="acilacak_div5" style="display:none;">
			<img width="46px" height="444px" src="<?php echo WHITERZ_PLUGIN_DIR; ?>/WhiteRZI/bookmarking.png"> 
			</div> 					
			<div id="acilacak_div6" style="display:none;"> 		
			<img width="46px" height="444px" src="<?php echo WHITERZ_PLUGIN_DIR; ?>/WhiteRZI/linkshorten.png"> 			
			</div> 			
			<div id="acilacak_div7" style="display:none;"> 		
			<img width="46px" height="444px" src="<?php echo WHITERZ_PLUGIN_DIR; ?>/WhiteRZI/posttype.png"> 	
			</div> 	
			<div id="acilacak_div8" style="display:none;"> 	
			<img width="46px" height="444px" src="<?php echo WHITERZ_PLUGIN_DIR; ?>/WhiteRZI/licence.png"> 		
			</div> 
			</div>      
			</ul>        
			<ul class="logout">    
			<li>            
			<a href="http://whiterz.com" onMouseOver="ac9()" onMouseout="kapat9()">   
			<i class="icon-map-marker nav-icon"></i>     
			<span class="nav-text">                 
            Whiterz Inc               
			</span>             
			</a>           
			</li>  
            </ul>     
			</nav>
			<?php  
			}
			}
			function Whiterz_Admin(){ 
			global $Whiterz_Services;   
			global $wpdb;  
			global $WhiterzCurl;  
			if(!class_exists('WhiterzForm')){
			require_once 'WhiteRZFB.php'; 
			}
			if(!class_exists('WhiterzCurl')){   
			include_once WHITERZ_PLUGIN_PATH.'/WhiteRZC/whiterz.curl.php';  
			$WhiterzCurl=new WhiterzCurl();  
			} 
			Whiterz_Admin_Header();     
			require_once 'WhiteRZS.php'; 
			switch(@$_GET['WhiterzGET']){    
			case 'Accounts':          
			if(!current_user_can('administrator')){  
			whiterz_error();
			break;    
			}    
			require 'WhiteRZM/Accounts.php';  
			break;      
			case 'Manuel':    
			if(!current_user_can('administrator')){  
			whiterz_error(); break;         
			}         
			require 'WhiteRZM/Post.Manuel.php';
			break;   
			case 'Settings' :     
			if(!current_user_can('administrator')){      
			whiterz_error(); break;     
			}    
			include 'WhiteRZM/Settings.php';  
			break;         case 'Licence' :    
			if(!current_user_can('administrator')){ 
			whiterz_error(); break;       
			}        
			include 'WhiteRZM/Licence.php';
			break;      
			case 'PostAuto' :    
			include 'WhiteRZM/Post.Auto.php';   
			break;    
			default :    		
			if(!current_user_can('administrator')){   
			whiterz_error(); 
			break;         
			}   
			include "WhiteRZN.php";  
			break;   
			}  
			Whiterz_Admin_Footer(); 
			} 
			function Whiterz_Admin_Header(){ 
			global $c_licence   
			?>    
			<div class='banners'>  
			</div> <div class="whiterz_content">
			<div> 
			<?php   
			WhiterzError(); 
			}
			function Whiterz_Admin_Footer(){ 
			?>    
			</div>  
			</div>     
			<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js">
			</script>
			<script language="javascript" type="text/javascript" src="<?php echo WHITERZ_PLUGIN_DIR; ?>WhiteRZIA/avgrund.js"></script>
			<?php 
			}  
			function WhiterzPingColumn( $column, $post_id )
			{    
			global $wpdb;  
			global $post;  
			if($column=='twpdyn'){      
			if(get_post_meta($post_id,'Whiterz-Ping',true)=='1' ){     
			echo '<img src="'. WHITERZ_PLUGIN_DIR .'WhiteRZIA/imle_ok.png" />';  
			}else{        
			if($post->post_status=='publish'){     
			$RDR=  urldecode('http://'. $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] .'#post-'.$post_id);   
			echo '<a href="admin.php?page=Whiterz&WhiterzGET=PostAuto&PostID='.$post_id.'&Redirect='.$RDR.'">
			<img src="'. WHITERZ_PLUGIN_DIR .'WhiteRZIA/imle_pend.png" /></a>';
			}else{      
			}           
			}         
			}
			}
			function WhiterzPingColumnSticky($columns){ 
			$columns['twpdyn']="Whiterz"; 
			return $columns; }  
			add_action("wp_ajax_dismiss_tooltip_dyn","dismiss_tooltip_dyn"); 
			function dismiss_tooltip_dyn(){  
			$current_user = wp_get_current_user();  
			add_user_meta( $current_user->ID, 'dismiss_tooltip_dyn', '1', true );
			exit; 
			}
?>