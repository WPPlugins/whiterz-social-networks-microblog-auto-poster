<div class="deneme">
<div class="panel panel-default panel-block panel-title-block">
<div class="panel-heading">
<div>
<i class="icon-edit"></i>
<h1>
<span class="page-title">Licence</span></h1><br><br>
<small>
				<?php
				$xml = WhiterzXML();
				if( $xml ){
				if( $xml->whiterz_banner ){
				echo $xml->whiterz_banner->global_banner;
				}
				}?>
</small>
</h1>
</div>
</div>
</div>
</div>
				<?php 
				if($_POST){
				update_option('whiterz_licence_key',str_Replace(' ',
				'',$_POST['whiterz_licence_key'])); 
				}
				$whiterz_key=get_option('whiterz_licence_key');
				$licence=whiterz_licence_check($whiterz_key);
				?>
<div> <div class="box">
<div class="title">
<h4>
Licence Information
</h4>
</div>
<div class="content top">
<form class="form-horizontal" method="post" action="">
<label class="">
Your Licence Key:
</label>
<div class=" row-fluid">
<div class="col-md-13">
<input name="whiterz_licence_key" class="form-control" type="text" value="<?php echo $whiterz_key ?>"/>
</div> <div class="whiterz_acc_link">
<button class="writerzbuttonmavi "><i class=""></i>
Update
</button>
<a href="http://whiterz.com/" class="writerzbuttonred" rel="_ablank"><i class=""></i>
Get to Licence Key
</a>
</div>
<div class="clearfix"></div>
</div>
</form>
<div class="tab-content">
<div class="row-fluid">
<div class="span1"></div>
<div class="span11">
				<?php 
				echo !$licence ? '<div class="alertxxx alert-danger">License was not accepted :\'
				(<br> Please re-enter.</div>' : '<div class="alertxxx alert-success">Your license on Active Status :)
				</div>' ; 
				?>
				<?php
				if($licence){
				?>
<p></p>
				<?php } ?>
</div>
</div>
</div>
</div>
</div>
</div>