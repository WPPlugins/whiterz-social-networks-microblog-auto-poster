				<?php 
				$tumblrConsumerKey=get_option('whiterz_tumblrConsumerKey');
				$tumblrConsumerSecret=get_option('whiterz_tumblrConsumerSecret');
				if(!$tumblrConsumerKey or $tumblrConsumerKey==''){
				?>
<p>
</p>
<div class="row-fluid">
<div class="box color_6">
<div class="content">
<h3>
Couldn't configure Tumblr 
<a href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=AppSettings">
application settings
</a>
.
</h3>
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
<h4><i class="icon"></i> 
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
				$logged_social=false;
				if(!isset($_COOKIE['TumblrUserToken']) or !isset($_COOKIE['TumblrUserTokenSecret'])){
				?>
<a href='javascript:void(0)' class='btn btn-primary btn-large btn-block' onclick='javascript:WhiterzPopup("<?php echo admin_url('admin-ajax.php?action=WhiterzAuth&Service=Tumblr'); ?>",500)'>
<b>
Connect your Tumblr account to WordPress.
</b></a>
				<?php
				}else{
				$logged_social=true;
				if(!class_exists('WhiterzTumblr')){
				include_once WHITERZ_PLUGIN_PATH.'/WhiteRZC/whiterz.tumblr.php';
				}
				$WhiterzTumblrOauth = new WhiterzTumblr($tumblrConsumerKey, 
				$tumblrConsumerSecret, $_COOKIE['TumblrUserToken'], $_COOKIE['TumblrUserTokenSecret']);
				$userData = $WhiterzTumblrOauth->get('user/info');
				$userData=$userData->response->user;
				?>
<input name="user_token" type="hidden" value="<?php echo $_COOKIE['TumblrUserToken'] ?>"/>
<input name="user_token_secret" type="hidden" value="<?php echo $_COOKIE['TumblrUserTokenSecret'] ?>"/>
<div class="form-group">
				<?php
				foreach($userData->blogs as $key=>$Acct){
				?>
<div class="radio">
<label>
<input type="radio" name="login" value="<?php echo $Acct->name; ?>">
				<?php
				echo $Acct->name;
				?>
<a href="<?php echo $Acct->url; ?>" target="_blank">
Go to Page
</a>
</label>
</div>
				<?php }?>
</div>
<a href='javascript:void(0)' class='btn btn-warning btn-sm' onclick='javascript:WhiterzPopup("<?php echo admin_url('admin-ajax.php?action=WhiterzClearCookie&Service=Tumblr'); ?>",250)'>
<b>
Connect to another Tumblr account.
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
</form>
</div>
</div>
</div>