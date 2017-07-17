<?php 
		$plurk_api_key=get_option('whiterz_plurkAppId'); 
		$plurk_api_secret=get_option('whiterz_plurkAppSecret'); 
		if(!$plurk_api_key or $plurk_api_secret==''){  
?> 
<p>
</p>
<div class="row-fluid">
<div class="box color_6">
<div class="content">
<h3>
Couldn't configure Plurk 
<a href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=AppSettings">
application settings
</a>.
</h3>
<h4>
Please complete your 
<a href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=AppSettings">
settings 
</a>
from menu.
</h4> 
</div>
</div>
</div>
<?php
	return;
	}
			$WhiterzAddAccount=WhiterzAddAccount($CurrentAccount);
			$WhiterzForm=new WhiterzForm(); 
			$Form=array(       
			'active' => array(       
			'name' => 'active',        
			'type'=>'radio',           
			'option' => array(            
			'1'=>'Get active account.',   
			'0' => 'Get deactive account.' 
			),          
			'title'=>'Do you get active account ?',   
			'default' => 1        
			),     
			'ping_enable' => array(    
			'name' => 'ping_enable',    
			'type'=>'radio',           
			'option' => array(              
			'1'=>'Yes, Please send.',     
			'0' => 'No, don\'t send.'       
			),           
			'title'=>'Do you want to send ping to Social Services?',  
			'default' => 1         
			),      
			'updateOption' => array(      
			'name' => 'updateOption',     
            'type'=>'button',            
			'action' =>'submit',         
			'btnlabel'=>'Add Account',   
			'title'=> '',            
			'class'=> 'button button-primary button-large'    
			),   
			);   
			$CreateForm=array(   
			'name' => 'option_change',    
			'class' => '',      
			'action' => '',      
			'id' => '',     
			'attr' => '',      
			'elements' =>$Form   
			);   
			$WhiterzForm->form_variable=$CreateForm;
			$WhiterzForm->build();   
			echo $WhiterzAddAccount;  
			?> 
<div class="box color_3">  
<div class="title">
<h4> 
Add New 
<span>
			<?php 
			echo $CurrentAccount['title']; 
			?>
</span> 
Account
</h4> 
</div> 
<div class="content top"> 
<div class="row-fluid"> 
<form method='post' action='' class='row-fluid'> 
<div class="span7">        
			<?php     
			if(!isset($_COOKIE['PlurkUserToken'])){      
			?>    
<a href='javascript:void(0)' class='btn btn-primary btn-large btn-block' onclick='javascript:WhiterzPopup("<?php echo admin_url('admin-ajax.php?action=WhiterzAuth&Service=Plurk'); ?>",250)'><b>
Connect your Plurk account to WordPress.
</b></a>      
            <?php
			$logged_social=false; }  
			else{      
			if(!class_exists('WhiterzPlurk')){  
			include_once WHITERZ_PLUGIN_PATH.'/WhiteRZC/whiterz.plurk.php';     
			}        
			$token=$_COOKIE['PlurkUserToken'];   
			$token_secret=$_COOKIE['PlurkUserTokenSecret'];      
			$WHTAuth = new WhiterzPlurk($plurk_api_key, $plurk_api_secret,$token,$token_secret);   
			$userData = $WHTAuth->get('Users/me');         
			?>        
<input type='hidden' name='user_token' value='<?php echo $token ?>' />    
<input type='hidden' name='user_token_secret' value='<?php echo $token_secret?>' />    
<input type='hidden' name='whiterz_social_url' value='http://www.plurk.com/<?php echo $userData->nick_name; ?>' />  
<div class="alert alert-info">
<p>
Login the Account: 
<span class="label label-info">
			<?php 
			echo $userData->full_name; 
			?>
</span>
<a href="http://www.plurk.com/<?php echo $userData->nick_name; ?>" target="_blank">
Go to Profile</a>
</p>
</div>
<a href='javascript:void(0)' class='btn btn-warning btn-sm' onclick='javascript:WhiterzPopup("<?php echo admin_url('admin-ajax.php?action=WhiterzClearCookie&Service=Plurk'); ?>",250)'>
<b>
Connect to another Plurk account.
</b>
</a>    
<p>
</p>
<div class="alert alert-warning">
Before click this button, first please login the account you want to connect.
</div>       
<p>
</p>
			<?php
			$WhiterzForm->output();
			}
			?>
</div>
</div>
</form>
</div>
</div>

			