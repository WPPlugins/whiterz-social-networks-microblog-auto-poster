<?php 
			$facebook_appId=get_option('whiterz_facebookAppId');
			$facebook_appSecret=get_option('whiterz_facebookAppSecret');
	if(!$facebook_appId or $facebook_appId==''){
?>
	<p>
	</p>
	<div class="alert alert-danger">
	<strong>
	Facebook application settings are not configured!
	</strong>
	<p>
	Please complete your 
	<a class="label label-danger" href="admin.php?page=Whiterz&WhiterzGET=Settings&Action=AppSettings" target="_blank">
	settings</a>
	from menu.
	</p>
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
				'btnlabel'=>'Add account.',
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
			<i class="icon icon-facebook">
			</i>
			Add New 
			<span><?php echo $CurrentAccount['title'];
?>
			</span>
			Account</h4>
			</div>
			<div class="content top">
	<div class="row-fluid">
		<form method='post' action='' class='row-fluid'>
			<div class="span7">
<?php
			if(!isset($_COOKIE['FacebookProfileAccessToken'])){
				$logged_social=false;
?>
		<a href='javascript:void(0)' class='btn btn-primary btn-large btn-block' onclick='javascript:WhiterzPopup("<?php echo admin_url('admin-ajax.php?action=WhiterzAuth&Service=Facebook'); ?>",250)'>
			<b>
		Connect your Facebook account to WordPress.
			</b>
		</a>
<?php
	}else{
				$logged_social=true;
				$token=$_COOKIE['FacebookProfileAccessToken'];
				$graph_url = "https://graph.facebook.com/me/accounts?access_token=" .$token ;
				$FacebookAccounts=$WhiterzCurl->get($graph_url);
				$FacebookAccounts=json_decode($FacebookAccounts);
?>
<?php
	foreach($FacebookAccounts->data as $key=>$Acct){
?>
	<div class="radio">
	<label>
	<input name="user_token" type="radio" value="<?php echo $Acct->access_token;?>#WHTRZ#<?php echo $Acct->id;?>"/>
	<?php echo $Acct->name;?>
	<a href="https://www.facebook.com/pages/WHITERZ/<?php echo $Acct->id;?>" target="_blank" class='label label-info'>Go to page</a>
	</label>
	</div>
<?php }?>
	<p></p>
	<a href='javascript:void(0)' class='btn btn-warning btn-sm' onclick='javascript:WhiterzPopup("
	<?php echo admin_url('admin-ajax.php?action=WhiterzClearCookie&Service=Facebook');	?>",250)'>
	<b>
	Connect to another Facebook account.
	</b>
	</a>
	<p>
	</p>
	<div class="alert alert-warning">Before click this button, first please login the account you want to connect.</div>
	<p>
	</p>
<?php
	$WhiterzForm->output();}
?>
				</div>
			</form>
		</div>
	</div>
</div>