<div class="deneme">
<div class="panel panel-default panel-block panel-title-block">
<div class="panel-heading">
<div>
<i class="icon-edit"></i>
<h1>
<span class="page-title">Application Settings</span></h1><br><br>
</h1>
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
</div>
</div>
</div>
</div>
<div class="deneme">
<form action='' method='post'>
<div class="box color_3">
				<?php
				$WhiterzForm=new WhiterzForm();
				$Form=array(
				'whiterz_facebookAppId' => array(
				'name' => 'whiterz_facebookAppId',
				'type'=>'text',
				'title'=>'Facebook App ID',
				'default' => stripslashes(get_option('whiterz_facebookAppId'))
				),
				'whiterz_facebookAppSecret' => array(
				'name' => 'whiterz_facebookAppSecret',
				'type'=>'text',
				'title'=>'Facebook App Secret',
				'default' => stripslashes(get_option('whiterz_facebookAppSecret'))
				),
				);
				$CreateForm=array(
				'name' => 'option_change',
				'class' => '',
				'action' => '',
				'id' => '',
				'attr' => '',
				'elements' =>$Form );
				$WhiterzForm->form_variable=$CreateForm;
				$WhiterzForm->build();
				?>
<div class="title">
<h4>Facebook Application Settings</h4>
</div>
<div class="content top">
				<?php
				$WhiterzForm->output();
				?>
<div class="alertxxx alertxxx-info">
<a href="http://support.whiterz.com/?p=54" target="blank"> How to create applications Facebook?</a>
</div>
</div>
</div>
<div class="box color_3">
				<?php
				$WhiterzForm=new WhiterzForm();
				$Form=array(
				'whiterz_plurkAppId' => array(
				'name' => 'whiterz_plurkAppId',
				'type'=>'text',
				'title'=>'Plurk Api Key',
				'default' => stripslashes(get_option('whiterz_plurkAppId'))
				),
				'whiterz_plurkAppSecret' => array(
				'name' => 'whiterz_plurkAppSecret',
				'type'=>'text',
				'title'=>'Plurk App Secret',
				'default' => stripslashes(get_option('whiterz_plurkAppSecret')),
				'desc'=> 'You Application Callback URL: <br />
				<pre>'.admin_url('admin-ajax.php?action=WhiterzAuth&Service=Plurk&Return').'</pre>'
				),
				);
				$CreateForm=array(
				'name' => 'option_change',
				'class' => '',
				'action' => '',
				'id' => '',
				'attr' => '',
				'elements' =>$Form );
				$WhiterzForm->form_variable=$CreateForm;
				$WhiterzForm->build(); 
				?>
<div class="title">
<h4>Plurk Application Settings</h4>
</div>
<div class="content top">
				<?php
				$WhiterzForm->output();
				?>
<div class="alertxxx alertxxx-info">
<a href="http://support.whiterz.com/?p=57" target="blank"> How to create applications Plurk?</a>
</div>
</div>
</div>
<div class="box">
				<?php
				$WhiterzForm=new WhiterzForm();
				$Form=array(
				'whiterz_twitterConsumerKey' => array(
				'name' => 'whiterz_twitterConsumerKey',
				'type'=>'text',
				'title'=>'Twitter Consumer Key',
				'default' => stripslashes(get_option('whiterz_twitterConsumerKey'))
				),
				'whiterz_twitterConsumerSecret' => array(
				'name' => 'whiterz_twitterConsumerSecret',
				'type'=>'text',
				'title'=>'Twitter Consumer Secret',
				'default' => stripslashes(get_option('whiterz_twitterConsumerSecret')),
				'desc'=> 'You Application Callback URL: <br />
				<pre>'.admin_url('admin-ajax.php?action=WhiterzAuth&Service=Twitter&Return').'</pre>'
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
				?>
<div class="title">
<h4>Twitter Application Settings</h4>
</div>
<div class="content top">
				<?php
				$WhiterzForm->output();
				?>
<div class="alertxxx alertxxx-info">
<a href="http://support.whiterz.com/?p=60" target="blank"> 
How to create applications Twitter?
</a>
</div>
				<?php
				$WhiterzForm=new WhiterzForm();
				$Form=array(
				'whiterz_linkedinConsumerKey' => array(
				'name' => 'whiterz_linkedinConsumerKey',
				'type'=>'text',
				'title'=>'Linkedin Consumer Key',
				'default' => stripslashes(get_option('whiterz_linkedinConsumerKey'))
				),
				'whiterz_lnkedinConsumerSecret' => array(
				'name' => 'whiterz_lnkedinConsumerSecret',
				'type'=>'text',
				'title'=>'Linkedin Consumer Secret',
				'default' => stripslashes(get_option('whiterz_lnkedinConsumerSecret')),
				'desc'=> 'You Application Callback URL: <br />
				<pre>'.admin_url('admin-ajax.php?action=WhiterzAuth&Service=Linkedin&Return').'</pre>'
				),
				);
				$CreateForm=array(
				'name' => 'option_change',
				'class' => '',
				'action' => '',
				'id' => '',
				'attr' => '',
				'elements' =>$Form );
				$WhiterzForm->form_variable=$CreateForm;
				$WhiterzForm->build(); 
				?>
</div>
</div><div class="box">
<div class="title">
<h4>Linkedin Application Settings</h4>
</div>
<div class="content top">
				<?php
				$WhiterzForm->output();
				?>
<div class="alertxxx alertxxx-info">
<a href="http://support.whiterz.com/?p=64" target="blank"> 
How to create applications Linkedin?
</a>
</div>
				<?php
				$WhiterzForm=new WhiterzForm();
				$Form=array(
				'whiterz_tumblrConsumerKey' => array(
				'name' => 'whiterz_tumblrConsumerKey',
				'type'=>'text',
				'title'=>'Tumblr Consumer Key',
				'default' => stripslashes(get_option('whiterz_tumblrConsumerKey'))
				),
				'whiterz_tumblrConsumerSecret' => array(
				'name' => 'whiterz_tumblrConsumerSecret',
				'type'=>'text',
				'title'=>'Tumblr Consumer Secret',
				'default' => stripslashes(get_option('whiterz_tumblrConsumerSecret')),
				'desc'=> '<p></p>You Application Callback URL:<br />
				<pre>'.admin_url('admin-ajax.php?action=WhiterzAuth&Service=Tumblr&Return').'</pre>'
				),
				);
				$CreateForm=array(
				'name' => 'option_change',
				'class' => '',     'action' => '',
				'id' => '',
				'attr' => '',
				'elements' =>$Form ); $WhiterzForm->form_variable=$CreateForm;
				$WhiterzForm->build();
				?></div>
</div><div class="box">
<div class="title">
<h4>Tumblr Application Settings</h4>
</div>
<div class="content top">
				<?php $WhiterzForm->output(); ?>
<div class="alertxxx alertxxx-info">
<a href="http://support.whiterz.com/?p=67" target="blank"> 
How to create applications Tumblr?
</a>
</div>
</div>
</div>
<div style="margin-left:6%;margin-top:-30px;">

				<?php
				$WhiterzForm=new WhiterzForm(); $Form=array(
				'updateOption' => array(
				'name' => 'updateOption',
				'type'=>'button',
				'action' =>'submit',
				'btnlabel'=>'Save Settings',
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
				'elements' =>$Form );
				$WhiterzForm->form_variable=$CreateForm;
				$WhiterzForm->build();
				?>
				<?php
				$WhiterzForm->output();
				?>
</form></div></div>