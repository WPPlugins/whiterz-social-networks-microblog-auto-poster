				<?php
				$twitterConsumerKey=get_option('whiterz_twitterConsumerKey');
				$twitterConsumerSecret=get_option('whiterz_twitterConsumerSecret');
				if(!$twitterConsumerKey or $twitterConsumerKey==''){
				echo '<div class="row-fluid">
				<div class="box color_6"><div class="content">';
				echo '<h3>Couldn\'t configure Twitter 
				<a href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=AppSettings">application settings</a>.</h3>';
				echo '<h4>Please complete your 
				<a href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=AppSettings">settings</a> 
				from menu.</h4>';
				echo '</div></div></div>';
				return;
				}
				$WhiterzAddAccount=WhiterzAddAccount($CurrentAccount);
				$WhiterzForm=new WhiterzForm();
				$Form=array(
				'custom_field' => array(
				'name' => 'custom_field',
				'type'=>'radio',
				'option' => array(
				'1'=>'Use Trending Topic Hastag.',
				'0' => 'Use\'nt Trending Topic Hastag.'
				),
				'title'=>'',
				'default' => 1
				),         'active' => array(
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
<i class="icon icon-twitter"></i> 
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
				if(!isset($_COOKIE['TwitterUserToken']) or !isset($_COOKIE['TwitterUserTokenSecret'])){
				?>
<a href='javascript:void(0)' class='btn btn-primary btn-large btn-block' onclick='javascript:WhiterzPopup("<?php echo admin_url('admin-ajax.php?action=WhiterzAuth&Service=Twitter'); ?>",250)'>
<b>
Connect your Twitter account to WordPress.
</b>
</a>
				<?php
				$logged_social=false; }else{ $logged_social=true;
				if(!class_exists('WhiterzTwitter')){
				include_once WHITERZ_PLUGIN_PATH.'/WhiteRZC/whiterz.twitter.php';
				}
				$WhiterzTwitterOauth = new WhiterzTwitter($twitterConsumerKey,
				$twitterConsumerSecret, $_COOKIE['TwitterUserToken'], $_COOKIE['TwitterUserTokenSecret']);
				$userData = $WhiterzTwitterOauth->get('account/verify_credentials');
				?>
<input name="user_token" type="hidden" value="<?php echo $_COOKIE['TwitterUserToken'] ?>"/>
<input name="user_token_secret" type="hidden" value="<?php echo $_COOKIE['TwitterUserTokenSecret'] ?>"/>
<table class="Whiterz_table_small">
<tr valign="top">
<td colspan='2'>
<input name="whiterz_social_url" type="hidden" value="https://twitter.com/<?php echo $userData->screen_name; ?>"/>
<div class="alert alert-info"><p>
Login the Account 
<span class="label label-info">
				<?php
				echo $userData->screen_name;
				?>
</span>
<a href="https://twitter.com/<?php echo $userData->screen_name; ?>" target="_blank">
Go to Page
</a>
</p>
</div>
</td>
</tr>
<tr valign="top">
<td colspan='2'>
<a href='javascript:void(0)' class='btn btn-warning btn-sm' onclick='javascript:WhiterzPopup("<?php echo admin_url('admin-ajax.php?action=WhiterzClearCookie&Service=Twitter'); ?>",250)'><b>
Connect to another Twitter account.
</b>
</a>
<p>
</p>
<div class="alert alert-warning">
Before click this button, first please login the account you want to connect.
</div>
</td>
</tr>
</table>
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