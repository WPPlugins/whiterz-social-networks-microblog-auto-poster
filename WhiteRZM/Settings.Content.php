<div class="deneme">
<div class="panel panel-default panel-block panel-title-block">
<div class="panel-heading">
<div>
<i class="icon-edit"></i>
<h1>
<span class="page-title">Content Settings</span></h1><br><br>
<small>
				<?php
				$xml = WhiterzXML();
				if ( $xml ) {
				if ( $xml->whiterz_banner ) {
				echo $xml->whiterz_banner->global_banner;
				}
				}?>
</small>
</h1>
</div>
</div>
</div>
</div>
<div class="deneme">
<div class="row-fluid">
<div class="box color_23">
<div class="title">
<h4>
</h4>
</div>
<div class="alertxxx alertxxx-info">
<a href="http://support.whiterz.com/?p=70" target="blank"> How to use Spinn systems?</a>
<br />
<a href="http://support.whiterz.com/?p=73" target="blank"> How should I fill this space?</a><br />
<a href="http://support.whiterz.com/?p=76" target="blank"> Sample content and spinn use</a>
</div>
<div class="content top">
<form action="" method="post" class="form-horizontal">
<table class="Whiterz_table_small table table-striped">
<tr>
<th class='top' width='150'>Title</th>
<td class="dynamit_full">
<textarea rows="5" class="form-control" name='whiterz_ping_title'><?php echo stripslashes(get_option('whiterz_ping_title')); ?></textarea>
</td>
</tr>
<tr>
<th class='top'>Bookmarking</th>
<td class="dynamit_full">
<textarea class="form-control" rows="10" name='whiterz_content'><?php echo stripslashes(get_option('whiterz_content')); ?></textarea>
</td>
</tr>
<tr>
<td></td>
<td class="dynamit_full">
<button type='submit' class='btn btn-primary'><i class='icon icon-check'></i> Save Settings</button>
</td>
</tr>
</table>
</form>
</div>
</div>
</div>
</div>          