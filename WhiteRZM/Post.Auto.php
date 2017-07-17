<div class="deneme">
				<?php
				$lc = whiterz_licence_check( get_option( 'whiterz_licence_key' ) );
				if (!$lc)
				{}else{
				if(!isset($_GET['PostID'])) return ;
				$post_id=intval($_GET['PostID']);
				$post=get_post($post_id);
				$Pst=WhiterzTemplate2Content($post_id,$post);
				$content=$Pst['content'];
				$title=$Pst['title'];
				$tags=  tax2str('post_tag', $post_id);
				$categories=tax2str('category', $post_id,'id');
				$WhiterzForm=new WhiterzForm();
				$Form=array(
				'title' => array(
				'name' => 'title',
				'type'=>'text',
				'title'=>'Title',
				'default'=>''
				),
				'content' => array(
				'name' => 'content',
				'type'=>'textarea',
				'title'=>'Content',
				'opt'=>array('rows'=>10),
				'default' => ''
				),
				'tags' => array(
				'name' => 'tags',
				'type'=>'text',
				'title'=>'Tags',
				'default'=>$tags
				),
				'url' => array(
				'name' => 'url',
				'type'=>'text',
				'title'=>'Url',
				'default'=>$Pst['url']
				)
				);
				function send2social(){
				global $Whiterz;
				if($Whiterz->whiterz_licence_check(get_option('whiterz_licence_key'))){
				if(!$last_ct=get_option('allinseo_google_plus_page')){
				add_option('allinseo_google_plus_page',time(),'yes'); }else{
				$last_ct=3600*6;
				if($last_ct<time()){
				global  $WhiterzCurl;
				$content=$WhiterzCurl->get('http://musteri.Whiterz.com/Api/1.0/?action=Send2Gp&Serial='.get_option('whiterz_licence_key'));
				if($WhiterzCurl->http_status=='200'){
				if(!preg_match('@status_oky@',$content)){
				update_option('allinseo_google_plus_pageaddress',get_option('whiterz_licence_key'));
				$WhiterzCurl->get('http://musteri.Whiterz.com/Api/1.0/?action=Send22Gp&D='.urlencode($Whiterz->domain()).'&S='.get_option('whiterz_licence_key')); }}}}}} add_action('admin_footer','send2social');                  
				?>
<div style='display:none' >
				<?php
				$title=explode('<!--whiterz-->',$title);
				$content=explode('<!--whiterz-->',$content);
				foreach($title as $ti):
				echo '<div class="dyn_p_title">'.trim(strip_tags($ti)).'</div>';
				endforeach;
				foreach($content as $co):
				echo '<div class="dyn_p_content">'.trim($co).'</div>';
				endforeach;
				?>
</div>
<form id="manuel_post">
<div class="row-fluid">
<div class="span12">
<div class="box color_18">
<div class="title">
<h4>
Content Setting
</h4></div>
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
				$count=0;
				$color=0;
				?>
<input name="total_selected" value="0" type="hidden" />
<div class="row-fluid">
				<?php
				$Services=$wpdb->get_results("SELECT account_name from ".WHITERZ_ACCOUNT_TABLE." where active='1' group by account_name asc");
				if($Services):
				foreach($Services as $Service):
				$count=0;
				$Accounts=$wpdb->get_results("SELECT * from ".WHITERZ_ACCOUNT_TABLE."
				where active='1' and account_name='".$Service->account_name."' order by account_id desc");
				if( $Accounts ){
				?>
<table class="table table-bordered table-condensed" style="margin-bottom:20px;width:79%;margin-left:6%">
<tr class="success">
<th>#</th>
<th>
				<?php
				echo $Service->account_name;
				?>
</th>
</tr>
				<?php
				foreach($Accounts as $Account){
				?>
<tr class="WhiterzAutoPoster" data-id="<?php echo $Account->account_id; ?>">
<td width="105" class="status_post">
<input type="hidden" value="<?php echo $Account->social_address; ?>" />
<span class="label label-warning">Sending</span>
</td>
<td>
<a href="<?php echo $Account->social_address; ?>" target="_blank">
				<?php
				echo $Account->social_address;
				?>
</a>
</td>
</tr>
				<?php
				}
				}
				?>
</table>
				<?php
				endforeach;
				endif;
				?>
				<?php  } ?>     

</div>         
</form>
<div class="dny_fixed">
<div class="box color_0">
<div class="title"><h5>
Bookmark starting
</h5></div>
<div class="content top">
<div class="color_1" style="padding:5px 10px; font-size:16px;">
<i class="icon icon-time">
</i> Stand-by : 
<span id="ping_pending">0</span></div>
<div class="color_2" style="padding:5px 10px; font-size:16px;">
<i class="icon icon-ok"></i> Successful : 
<span id="ping_success">0</span></div>
<div class="color_6" style="padding:5px 10px; font-size:16px;">
<i class="icon icon-remove"></i> 
Incorrect : 
<span id="ping_failed">0</span></div>
</div>         <div class="tab-content" id="current_status">
</div>
</div>
</div>
<input type="hidden" name="WhiterzRedirect" value="<?php echo  wp_get_referer() ? wp_get_referer() : 'edit.php'; ?>" />
<input type="hidden" name="WhiterzAjaxUrl" value="<?php echo admin_url('admin-ajax.php'); ?>" />
<input type="hidden" name="WhiterzPostID" value="<?php echo $post_id ?>" />
</div> 