<?php
			$ConsumerKey=get_option('whiterz_linkedinConsumerKey');
			$ConsumerSecret=get_option('whiterz_lnkedinConsumerSecret');
		if(!$ConsumerKey or $ConsumerKey==''){?>
		<p>
		</p>
		<div class="row-fluid">
		<div class="box color_6">
		<div class="content">
		<h3>
		Couldn't configure Linkedin 
		<a href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=AppSettings">
		application settings</a>.</h3>
		<h4>Please complete your 
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
			'title'=>'Do you want to send ping to Social Services?',    
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
	<i class="icon icon-linkedin">
	</i> 
	Add New 
	<span>
	<?php echo $CurrentAccount['title']; ?>
	</span> 
	Account
	</h4> 
    </div>
	<div class="content top"> 
    <div class="row-fluid">
	<form method='post' action='' class='row-fluid'>
	<div class="span7">
<?php         
			$logged_social=false;
			if(!isset($_COOKIE['LinkedinUserToken']) or !isset($_COOKIE['LinkedinUserTokenSecret'])){
?>     
			<a href='javascript:void(0)' class='btn btn-primary btn-large btn-block' onclick='javascript:WhiterzPopup("
			<?php echo admin_url('admin-ajax.php?action=WhiterzAuth&Service=Linkedin'); ?>",250)'><b>
			Connect your Linkedin account to WordPress.
			</b></a>      
<?php 
		}else{ 
            $logged_social=true;     
			if(!class_exists('WhiterzLinkedin')){
			include_once WHITERZ_PLUGIN_PATH.'/WhiteRZC/whiterz.linkedin.php';        
			}      
			$linkedin=new WhiterzLinkedin($ConsumerKey,$ConsumerSecret,$CurrentPage); 
            $linkedin->setToken(array(            
			'oauth_token' => $_COOKIE['LinkedinUserToken'], 
			'oauth_token_secret' => $_COOKIE['LinkedinUserTokenSecret']  
			));                  
			$xml_response = $linkedin->getProfile("~:(id,first-name,last-name,headline,picture-url,public-profile-url,email-address)");     
			$userData=json_decode(json_encode(simplexml_load_string($xml_response)));      
			?>                    
			<input name="user_token" type="hidden" value="<?php echo $_COOKIE['LinkedinUserToken'] ?>"/>   
			<input name="user_token_secret" type="hidden" value="<?php echo $_COOKIE['LinkedinUserTokenSecret'] ?>"/>
			<div class="alert alert-info">       
			<p>        
			Login the Account: <span class="label label-info"><?php echo $userData->{'first-name'};?></span>     
			<a href="<?php echo $userData->{'public-profile-url'}; ?>" target="_blank">
			Go to Profile
			</a>    
			</p>       
			</div>         
			<a href='javascript:void(0)' class='btn btn-warning btn-sm' onclick='javascript:WhiterzPopup("
			<?php echo admin_url('admin-ajax.php?action=WhiterzClearCookie&Service=Linkedin'); ?>
			",250)'><b>
			Connect to another Linkedin account.
			</b></a>     
			<p></p><div class="alert alert-warning">
			Before click this button, first please login the account you want to connect.
			</div>       
			<p>
			</p>      
		<?php          
		$WhiterzForm->output();   
		} 
		?>                  
		</div> 
	</form>     
 </div>   
</div> 
</div>
			