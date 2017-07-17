<div class="deneme"> 
<div class="panel panel-default panel-block panel-title-block"> 
<div class="panel-heading"> 	
<div> 			
<i class="icon-edit"></i>
<h1> 	
<span class="page-title">
							<?php echo $_GET['Account']; ?> New Account
</span>
</h1>
<br><br>
<small>
							<?php WhiterzSubMenu($CurrentAccount);?> 
</small>
</h1>
</div>
</div>
</div>
</div>
<div class="deneme">
<?php 
								$lc = whiterz_licence_check( get_option( 'whiterz_licence_key' ) );
							if (!$lc) {} else{ $oAuthServices=array('FacebookProfile','FacebookFanPage','Plurk','Twitter',
								'Linkedin','Tumblr','Scoopit');
								$CurrentAccount=$wpdb->escape($_GET['Account']);
							if(!array_key_exists($CurrentAccount, $Whiterz_Services)) whiterz_error();
									 $args = array(
									 'type'
									 => 'post',
									 'child_of'
									 => 0,
									 'orderby'
									=> 'name',
									 'order'
									=> 'ASC',
									 'hide_empty'
									 => 0,
									 'hierarchical'
									 => 1,
									 'exclude'
									=> '',
									 'include'
									=> '',
									 'number'
									 => '',
									 'taxonomy'
									 => 'category',
									 'pad_counts'
									 => false
									 );
								$CurrentAccount=$Whiterz_Services["{$CurrentAccount}"];
							if(!in_array($CurrentAccount['account_name'], $oAuthServices)){ $WhiterzAddAccount=WhiterzAddAccount($CurrentAccount);
									 $WhiterzForm=new WhiterzForm();
									 $Form=array(
									 'active' => array(
									 'name' => 'active',
									 'type'=>'radio',
									 'option' => array(
									 '1'=>'Get active account.',
									 '0' => 'Get deactive account.'
									 ),
									 'title'=>'Do you get active account?',
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
							if($CurrentAccount['form']){
								 $CForm=$CurrentAccount['form'];
								 $Form=
							array_merge($CForm,$Form);
							 }
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
<div class="box">
 <div class="title">
 <h4>
 Add 
 <span>
								<?php echo $CurrentAccount['title']; ?>
 </span> 
 new account
 </h4>
 </div> <div class="content top">
 <form method='post' action='' class='' role="form">
 <div class="row-fluid">
								 <?php
									$WhiterzForm->output();
								 ?>
 </div>
 </form>
 </div> 
 </div></div> 
								<?php 
									 }else{
									 switch($CurrentAccount['account_name']):
									 case 'FacebookProfile': require_once 'Account.FacebookProfile.php';
									 break;
									 case 'FacebookFanPage': require_once 'Account.FacebookFanPage.php';
									 break;
									 case 'Plurk': require_once 'Account.Plurk.php';
									 break;
									 case 'Twitter': require_once 'Account.Twitter.php';
									 break;
									 case 'Linkedin': require_once 'Account.Linkedin.php';
									 break;
									 case 'Tumblr': require_once 'Account.Tumblr.php';
									 break;
									 case 'Scoopit': require_once 'Account.Scoopit.php';
									 break;
									 endswitch;
									 } }
								?> 