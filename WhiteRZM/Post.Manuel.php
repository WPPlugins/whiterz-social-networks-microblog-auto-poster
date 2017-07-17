				<?php
				$lc = whiterz_licence_check( get_option( 'whiterz_licence_key' ) );
				if (!$lc)
				{}else{
				$WhiterzForm=new WhiterzForm();
				$Form=array(
				'title' => array(
				'name' => 'title',
				'type'=>'text',
				'title'=>'Title',
				'default'=>'Whiterz Social Auto Poster - Pligger '
				),
				'content' => array(
				'name' => 'content',
				'type'=>'textarea',
				'title'=>'Content',
				'opt'=>array('rows'=>10),
				'default' => 'Wordpress Pligger, This is legend :)'
				),     'tags' => array(
				'name' => 'tags',
				'type'=>'text',
				'title'=>'Tags',
				'default'=>'wordpress pligg, wordpress social auto poster, wordpress bookmarking'
				),
				'url' => array(
				'name' => 'url',
				'type'=>'text',
				'title'=>'Url',
				'default'=>'http://whiterz.com'
				) ); 
				?>
<div class="deneme">
<div class="panel panel-default panel-block panel-title-block">
<div class="panel-heading">
<div>
<i class="icon-edit"></i>
<h1>
<span class="page-title">
Manuel Post
</span>
</h1>
<br>
<br>
</h1>
<small>
				<?php
				$xml = WhiterzXML();
				if ( $xml ) {
				if ( $xml->whiterz_banner ) {
				echo $xml->whiterz_banner->global_banner;
				}
				}?>
</small>
</div>
</div>
</div>
</div>
<div class="deneme">
<form id="manuel_post" action='post'>
<div class="row-fluid">
<div class="span12">
<div class="box color_18">
<div class="title"><h4>
Content Settings
</h4>
</div>
<div class="content top">
				<?php
				$CreateForm=array(
				'name' => 'option_change',
				'class' => '',
				'action' => '',
				'id' => '',
				'attr' => '',
				'elements' =>$Form,
				'element_size'=>12,
				);
				$WhiterzForm->form_variable=$CreateForm;
				$WhiterzForm->build();
				$WhiterzForm->output();
				?>
</div>
</div>
</div>
</div>
				<?php
				$WhiterzServicesList=WhiterzArray2Object($Whiterz_Services);
				?>
<p>
</p>
<input name="total_selected" value="0" type="hidden" />
<div>
				<?php
				foreach($WhiterzServicesList as $Account => $Service):$count=0;
				$acc_cnt=$wpdb->get_results("SELECT * from ". WHITERZ_ACCOUNT_TABLE ." where account_name='".$Service->account_name."'");
				if( $acc_cnt ){
				?>
<table class="table table-bordered table-condensed" style="margin-bottom: 20px; width: 79%; margin-left: 6%; ">
<tr class="success">
<th width="30">#</th>
<th>
				<?php
				echo $Service->account_name;
				?>
<a href="javascript:void(0)" class="slct_all" style="font-size:11px;">( All Select )</a></th>
</tr>
				<?php
				foreach($acc_cnt as $acc){
				?>
<tr>
<td><input type='checkbox' class="account_chbx"   name='Account[]' value='<?php echo $acc->account_id; ?>' /></td>
<td>
				<?php 
				echo $acc->social_address; 
				?>
</td>
</tr>
				<?php
				}
				}
				?>
</table>
				<?php
				endforeach;
				?>
</div>
<div class="row-fluid">
<div class="span12">
<div class="box color_4">
<button type="button" id="WhiterzPingManuel"  class="btn btn-block btn-large btn-primary"><i class="icon icon-flag"></i> 
START
</button>
</div>
</div>
</div>
</form>
<div class="manuel_post_status">
				<?php
				WhiterzModal();
				?>
</div>
<input type="hidden" name="WhiterzAjaxUrl" value="<?php echo admin_url('admin-ajax.php'); ?>" />
				<?php  } ?>



