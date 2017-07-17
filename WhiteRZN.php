<div class="deneme">
	<div class="panel panel-default panel-block panel-title-block">
		<div class="panel-heading"> <div> <i class="icon-edit"></i>
			<h1>
				<span class="page-title">News</span>
			</h1>
	<br><br>
<small>
<?php
$xml=WhiterzXML();
	if($xml){ if($xml->whiterz_banner){
		if($c_licence=='Whiterz PRO'){
			echo $xml->whiterz_banner->pro_licence;
				}elseif($c_licence=='Whiterz BASIC'){
					echo $xml->whiterz_banner->basic_licence;
				}elseif($c_licence=='Whiterz FREE'){
			echo $xml->whiterz_banner->free_licence;
		}else{
	echo $xml->whiterz_banner->no_licence;
		}
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
<div class="col-md-6 col-lg-8">
<?php 
		$version= plugin_get_version();
			$xml=WhiterzXML(); 
	if($xml){
		if($xml->whiterz_news){
			foreach($xml->whiterz_news->item as $b){
?>
<div class="panel panel-default panel-block preface">
	<div class="list-group">
		<div class="list-group-item button-demo">
			<img src="<?php echo WHITERZ_PLUGIN_DIR; ?>/WhiteRZIA/whiterz_icon.png" style="width: 20px;height: 20px;position: absolute;margin-right: 20px;">
			<h4 class="section-title preface-title" style=" margin-right: 20px; margin-left: 20px; ">
		<?php echo $b->title; ?>
			</h4>
			<p>
			<?php echo $b->content; ?>
			</p>
		</div>
	</div>
</div>
<?php
			}
		}
	} 
?>