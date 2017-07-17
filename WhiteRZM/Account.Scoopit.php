<div class="deneme">
					<?php 
					$ConsumerSecret=get_option('whiterz_scoopitConsumerSecret'); 
					$ConsumerKey=get_option('whiterz_scoopitConsumerKey'); 
					if(!$ConsumerKey or $ConsumerKey==''){   
					echo '<h3>
					Couldn\'t configure Scoopit 
					<a href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=AppSettings">application settings</a>.</h3>'; 
					echo '<h4>Please complete your <a href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=AppSettings">
					settings
					</a> 
					from menu.
					</h4>'; 
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
					'btnlabel'=>'Add Account.',        
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
<div class="span8">           
					<?php     
					$logged_social=false;    
					if(!isset($_COOKIE['ScoopitUserToken']) or !isset($_COOKIE['ScoopitUserTokenSecret'])){   
					?>       
<a href='javascript:void(0)' class='btn btn-primary btn-large btn-block' onclick='javascript:WhiterzPopup("<?php echo admin_url('admin-ajax.php?action=WhiterzAuth&Service=Scoopit'); ?>",250)'>
<b>
Connect your Scoop.it account to WordPress.
</b></a>        
					<?php }else{     
					$logged_social=true;  
					if(!class_exists('WhiterzScoopit')){   
					include_once WHITERZ_PLUGIN_PATH.'/WhiteRZC/whiterz.scoopit.php';    
					}          
					$Scoopit=new WhiterzScoopit($ConsumerKey,$ConsumerSecret,$_COOKIE['ScoopitUserToken'],$_COOKIE['ScoopitUserTokenSecret']);  
					$user=$Scoopit->get('/api/1/profile');       
					$user=json_decode($user);    
					$user=$user->user;         
					$link=$user->url;                     
					?>             
<input name="user_token" type="hidden" value="<?php echo $_COOKIE['ScoopitUserToken'] ?>"/>  
<input name="user_token_secret" type="hidden" value="<?php echo $_COOKIE['ScoopitUserTokenSecret'] ?>"/>  
<input name="social_address" type="hidden" value="<?php echo $link; ?>"/>   
<table class="whiterz_table_small">        
<tr valign="top">    
<th scope="row">Login To Profile :</th>      
<td> 
				<?php 
				echo $user->name;
				?>
<a href="<?php echo $link; ?>" target="_blank">
Get to Page
</a>
</td> 
</tr>    
<tr valign="top">        
<td colspan='2'>
<a href='javascript:void(0)' class='btn btn-primary btn-large btn-block' onclick='javascript:WhiterzPopup("<?php echo admin_url('admin-ajax.php?action=WhiterzClearCookie&Service=Scoopit'); ?>",250)'>
<b>
Connect to another Scoop.it account.
</b></a>
<br/>
<span id='bottom'>
Before click this button, first please login the account you want to connect.
</span>
</td>     
</tr>       
</table>      
				<?php         
				$WhiterzForm->output();
				} ?>                     
</div>    
				<?php 
				if($logged_social) WhiterzCategoryList(); 
				?>   
</form>   
</div>  
</div> 
</div>
</div>