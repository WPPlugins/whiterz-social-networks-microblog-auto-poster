<div class="deneme">
<div class="box color_25">
<div class="title">
<h4>Link Shortener Services</h4>
</div>
<div class='row-fluid'>
<div class="alertxxx alertxxx-info">
<a href="http://support.whiterz.com/?p=82" target="blank"> goog.gl how to get api key?</a>
<br />
<a href="http://support.whiterz.com/?p=85" target="blank"> bc.vc how to get api key?</a><br />
<a href="http://support.whiterz.com/?p=88" target="blank"> adf.ly how to get api key?</a></div>
</div>
<form action='' method='post'>
				<?php
				$WhiterzForm=new WhiterzForm(); $Form=array(
				'whiterz_current_ls' => array(
				'name' => 'whiterz_current_ls',
				'type'=>'radio',
				'option' => array(
				'googl' => 'Use goo.gl service',
				'bcvc'=>'Use bc.vc service ( Recommended )',
				'adfly' => 'Use adf.ly service',
				'none' => 'Do not use any'
				),
				'title'=>'Link Shortener Service',
				'default' => get_option('whiterz_current_ls')
				),
				'whiterz_googl_apikey' => array(
				'name' => 'whiterz_googl_apikey',
				'type'=>'text',
				'title'=>'goo.gl simple api key',
				'default' => stripslashes(get_option('whiterz_googl_apikey')),
				),
				'whiterz_bcvc_uid' => array(
				'name' => 'whiterz_bcvc_uid',
				'type'=>'text',
				'title'=>'bc.vc uid',
				'default' => stripslashes(get_option('whiterz_bcvc_uid')),
				),
				'whiterz_bcvc_apikey' => array(
				'name' => 'whiterz_bcvc_apikey',             'type'=>'text',             'title'=>'bc.vc api key',             'default' => stripslashes(get_option('whiterz_bcvc_apikey')),                ),         'whiterz_adfly_uid' => array(             'name' => 'whiterz_adfly_uid',             'type'=>'text',             'title'=>'adf.ly uid',             'default' => stripslashes(get_option('whiterz_adfly_uid')),                     ),     'whiterz_adfly_apikey' => array(             'name' => 'whiterz_adfly_apikey',             'type'=>'text',             'title'=>'adf.ly api key',             'default' => stripslashes(get_option('whiterz_adfly_apikey')),          ),     
				'updateOption' => array(
				'name' => 'updateOption',
				'type'=>'button',
				'action' =>'submit',
				'btnlabel'=>'Save Settings',
				'title'=> '',
				'class'=> 'button button-primary button-large'
				), ); $CreateForm=array(
				'name' => 'option_change',
				'class' => '',
				'action' => '',
				'id' => '',
				'attr' => '',
				'elements' =>$Form );
				$WhiterzForm->form_variable=$CreateForm;
				$WhiterzForm->build();
				?>   
<div class="content top">
				<?php $WhiterzForm->output(); ?>
</div>
</form>
</div>
</div> 