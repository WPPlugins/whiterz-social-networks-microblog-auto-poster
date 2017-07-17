<?php
	$facebook_appId=get_option('whiterz_facebookAppId');
	$facebook_appSecret=get_option('whiterz_facebookAppSecret');
	if(!$facebook_appId or $facebook_appId==''){
?>
 <p>
 </p>
 <div class="row-fluid"><div class="box color_6"><div class="content">
 <h3>
 Facebook
 <a href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=AppSettings">
 application settings
 </a>
 are not configured!
 </h3>
 <h4>
 Please complete your 
 <a href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=AppSettings">
 settings
 </a> from menu.</h4> </div></div></div>
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
		<i class="icon icon-facebook"></i> 
		Add New 
		<span>
		<?php echo $CurrentAccount['title']; ?>
		</span> 
		Account
		</h4>
	</div>
		<div class="content top">
			<div class="row-fluid"> <form method='post' action='' class='row-fluid'>
		<div class="span7">
	<?php if(!isset($_COOKIE['FacebookProfileAccessToken'])){	?>
	<a href='javascript:void(0)' class='btn btn-primary btn-large btn-block' onclick='javascript:WhiterzPopup("<?php echo admin_url('admin-ajax.php?action=WhiterzAuth&Service=Facebook');?>",250)'><b>
 Connect your Facebook account to WordPress.
	</b>
	</a>
<?php $logged_social=false;
	}else{
			 $token=$_COOKIE['FacebookProfileAccessToken'];
			 $graph_url = "https://graph.facebook.com/me?access_token=" . $token;
			 $userData=$WhiterzCurl->get($graph_url);
			 $userData=json_decode($userData);
?>
			 <input type='hidden' name='user_token' value='<?php echo $token ?>' />
			 <input type='hidden' name='custom_field' value='<?php echo $userData->id ?>' />
			 <input type='hidden' name='whiterz_social_url' value='<?php echo $userData->link; ?>' />
			<div class="alert alert-info">
	<p>
	Login the account : 
	<span class="label label-info"><?php echo $userData->name;?></span>
	<a href="<?php echo $userData->link;?>" target="_blank">
	Go to profile
	</a>
	</p>
	</div>
	<a href='javascript:void(0)' class='btn btn-warning btn-sm' onclick='javascript:WhiterzPopup("<?php echo admin_url('admin-ajax.php?action=WhiterzClearCookie&Service=Facebook');?>",250)'><b>Connect to another Facebook account.</b></a>
	<p></p><div class="alert alert-warning">Before click this button, first please login the account you want to connect.</div>
	<p></p>
<?php	$WhiterzForm->output();	} ?>
	</div>
</div> </form> </div> </div></div>