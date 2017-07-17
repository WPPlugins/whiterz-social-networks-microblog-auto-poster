<div class="deneme">
<div class="panel panel-default panel-block panel-title-block">
<div class="panel-heading">
<div>
<i class="icon-edit"></i>
<h1>
<span class="page-title">Bookmarking Settings</span></h1><br><br>
<small>
				<?php
				$xml = WhiterzXML();
				if ( $xml ) {
				if ( $xml->whiterz_banner ) {
				echo $xml->whiterz_banner->global_banner;
				}
				}
				?>
</small>
</h1>
</div>
</div>
</div>
</div>
<div class="deneme">
<form action="" method="post">
<div class=" color_22">
<div class="content top">
<div class="box">
<div class="title">
<h4>Bookmarking Setting</h4>
</div>
				<?php
				$WhiterzForm=new WhiterzForm();
				$Form=array(
				'whiterz_bookmarking' => array(
				'name' => 'whiterz_bookmarking',
				'type'=>'radio',
				'option' => array(
				'1'=>'Yes, Please :)',
				'0' => 'No !'
				),
				'title'=>'<div class="title"><h5>Do you want to get automatic pligg?</h5></div>',
				'default' => get_option('whiterz_bookmarking')
				),
				'ping_enable' => array(
				'name' => 'ping_enable',
				'type'=>'radio',
				'option' => array(
				'custom'=>'All services get pinged.',
				'custom_account' => 'For the accounts used my special election.',
				'none' => 'Don\'t ping.'
				),

				'title'=>'<div class="title"><h5>Do you want to send ping to Social Services?</h5></div>',
				'default' => get_option('ping_enable')
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
				$WhiterzForm->output();
				?>
</div>
<div class="box">
				<?php
				$WhiterzForm=new WhiterzForm();
				$Form=array(
				'whiterz_msg_more_msg' => array(
				'name' => 'whiterz_msg_more_msg',
				'type'=>'text',
				'title'=>'<div class="title"><h5>Read More</h5></div>',
				'default' => get_option('whiterz_msg_more_msg'),
				'desc'=>''
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
				$WhiterzForm->output();
				?>
<div class="alertxxx alertxxx-info">
<a href="http://support.whiterz.com/?p=107" target="blank"> What is the Read More brackets? Where is it used?</a>
</div>
</div>
<div class="box">
				<?php
				$WhiterzForm=new WhiterzForm();
				$Form=array(
				'dyncron_sleep_active' => array(
				'name' => 'dyncron_sleep_active',
				'type'=>'radio',
				'option' => array(
				'1'=>'Yes, with certain intervals Pligg-in posts.',
				'0' => 'No, timed and old posts get pligg-in.'
				),
				'title'=>'<div class="title"><h5>Do you want get active DryCron?</h5></div>',
				'default' => get_option('dyncron_sleep_active')
				),
				'WHTCron_sleep' => array(
				'name' => 'WHTCron_sleep',
				'type'=>'text',
				'title'=>'<div class="title"><h5>Timeout</h5></div>',
				'desc'=>'',
				'default' => get_option('WHTCron_sleep')
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
				$WhiterzForm->output();
				?>
</div>         
<div class="box">
<div class="form-group">
<p class="submit">
<input type="submit" id="Whiterz_updateOption" class="btn btn-primary btn-large" value="Update Settings."></p></div></div>
</div>
</div>
</form>
<div class="box color_2">
<div class="title">
<h4>WHTCron Create Files</h4>
</div>
<div class="content">
<form action="" method="post">
				<?php
				if(get_option('WHTCronFile')){
				$file_name=get_option('WHTCronFile');
				}else{
				$file_name=MakeWHTCode(16);
				}
				$rnd=$file_name.".php";
				$WHTCronFile = ABSPATH.$rnd;
				if(!file_exists($WHTCronFile)) {
				?>
<button type="submit" class="btn btn-large btn-primary" name="CreateWHTCronFile">Create.</button>
				<?php }else{ ?>
<button type="submit" class="btn btn-large btn-primary" name="WHTCronChange"> Change.</button>
				<?php } ?>
<button type="submit" class="btn btn-large btn-primary" name="WHTCronDownload">Download.</button>
</form>
<p>
To use the WHTcron feature;

<ul>
<li>
WordPress is installed in the directory, should be 
<b>
				<?php
				echo get_option('WHTCronFile');
				?>.php</b> file.
</li>
<li>
From your administration panel to run every minute 
<br /><code>wget -c <?php echo home_url(get_option('WHTCronFile').".php"); ?>
</code><br /> 
You must add the cronjob command.
</li>
</ul>
</p>
</div>
</div>
</div>