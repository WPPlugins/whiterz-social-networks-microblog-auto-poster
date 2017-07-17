<div class="deneme">
 	<div class="panel panel-default panel-block panel-title-block"> 		<div class="panel-heading">
		<div>
			<i class="icon-edit"></i>
		<h1>
			<span class="page-title"><?php echo $_GET['Account']; ?> 
		Edit Account
			</span>
		</h1>
		<br><br>
					<small>
					<?php WhiterzSubMenu(); ?>
					</small>
		</h1>
		</div>
 		</div>
		</div>
		</div>
			<div class="deneme">
				<?php $lc = whiterz_licence_check(get_option( 'whiterz_licence_key'));
	if (!$lc){
	}else{
			$WhiterzEditAccount=WhiterzEditAccount($CurrentAccount);
			$CurrentAcct=$wpdb->get_row("SELECT * from ". WHITERZ_ACCOUNT_TABLE . " where account_id='".intval($_GET['AccountID'])."'");
	if(!$CurrentAcct)
	whiterz_error();
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
				 'default' => $CurrentAcct->active
				 ),
				 'ping_enable' => array(
				 'name' => 'ping_enable',
				 'type'=>'radio',
				 'option' => array(
				 '1'=>'Yes, Please send.',
				 '0' => 'No, don\'t send.'
				 ),
				 'title'=>'Do you want to send ping to Social Services?',
				 'default' => $CurrentAcct->ping_enable
				 ),
				 'updateOption' => array(
				 'name' => 'updateOption',
				 'type'=>'button',
				 'action' =>'submit',
				 'btnlabel'=>'Edit Account',
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
			echo $WhiterzEditAccount;
 }?>
<form method='post' action='' class=''>
	<div class="box color_21">
		<div class="title">
			<h4>
				<i class="icon icon-edit"></i> 
					Edit Account
			</h4>
</div>
	<div class="content top">
		<?php $WhiterzForm->output(); ?>
	</div>
</div>
</form>
</div>
</div>