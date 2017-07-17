<?php
function array_to_obj($array, &$obj){
    foreach ($array as $key => $value){
        if (is_array($value)){
            $obj->$key = new stdClass();
            array_to_obj($value, $obj->$key);
        }else{
            $obj->$key = $value;
        }
    }
    return $obj;
}
function WhiterzArray2Object($array){
    if(class_exists('stdClass')){
        $object= new stdClass();
        return array_to_obj($array,$object);
    }else{
        return json_decode(json_encode($array));
    }
}
function whiterz_error(){
    echo '<div class="row-fluid"><div class="box color_6"><div class="content">';
    echo '<h3>Unauthorized access!</h3><p>To view this area are not sufficient authority.</p>';
    echo '</div></div></div>';
    exit;
}
function WhiterzEditAccount($CurrentAccount){
    global $wpdb;
    if(!$_POST) return;
    global $WhiterzCurl;
    global $wpdb;
    if(isset($_POST['filter_cat_in'])){
        $filter_cat_ins="#".implode('#',$_POST['filter_cat_in'])."#";
    }else{
       $filter_cat_ins='';
    }
    if(isset($_POST['filter_cat_out'])){
        $filter_cat_outs="#".implode('#',$_POST['filter_cat_out'])."#";
    }else{
        $filter_cat_outs='';
    }
        foreach($_POST as $key => $value):
        $$key=$wpdb->escape($value);
    endforeach;
    $update=$wpdb->query("UPDATE ". WHITERZ_ACCOUNT_TABLE ." set category_filter_in='$filter_cat_ins' , category_filter_out='$filter_cat_outs', ping_enable='$ping_enable',active='$active' where account_id='".$_GET['AccountID']."'") or $error=mysql_error();
    if($update){
        return '<div class="alert alert-success">'.$CurrentAccount['title'].' Account successfully updated!</div>';
    }else{
         return '<div class="whiterz_error"> Error ! ('.$error.')</div>';
    }
}
function WhiterzAddAccount($CurrentAccount){
    if(!$_POST) return;
    global $WhiterzCurl;
    global $wpdb;
        foreach($_POST as $key => $value):
        if($key!='filter_cat_in' and $key!='filter_cat_out' and $key!='whiterz_social_url'){
                $keys[$key]=$key;
				$val[$key]=$wpdb->escape($value);
        }
        $$key=$wpdb->escape($value);
    endforeach;
    if(isset($_POST['filter_cat_in'])){
        $filter_cat_in="#".implode('#',$_POST['filter_cat_in'])."#";
    }
    if(isset($_POST['filter_cat_out'])){
        $filter_cat_out="#".implode('#',$_POST['filter_cat_out'])."#";
    }
    if($_GET['Account']=='FacebookFanPage'){
        $user_token=explode('#WHTRZ#',$user_token);
        $keys['custom_field']='custom_field';
        $val['custom_field']=$user_token[1];
        $graph_urls = "https://graph.facebook.com/{$val['custom_field']}?fields=access_token&access_token=" .$_COOKIE['FacebookProfileAccessToken'];
        $data=$WhiterzCurl->get($graph_urls);
        $data=json_decode($data);
        $val['user_token']=$data->access_token;
        $whiterz_social_url='https://www.facebook.com/pages/WHITERZ/'.$val['custom_field'];
    }
        $AddressBlock=$CurrentAccount['address_block'];
    $AddressBlock = preg_match('@%LOGIN%@',$AddressBlock) ? str_replace('%LOGIN%',$login,$AddressBlock) : $AddressBlock;
    $AddressBlock = preg_match('@%SOCIAL_URL%@',$AddressBlock) ? str_replace('%SOCIAL_URL%',$whiterz_social_url,$AddressBlock) : $AddressBlock;
    $Sql="INSERT INTO ". WHITERZ_ACCOUNT_TABLE ."
        (account_name,".implode($keys,',').",social_address,category_filter_out,category_filter_in)
        values ('".$_GET['Account']."','".implode($val,"','")."','$AddressBlock','$filter_cat_out','$filter_cat_in')";
		$accountAdd=$wpdb->query($Sql) or $error=mysql_error();
		if($accountAdd){
        return '<div class="alert alert-success">'.$CurrentAccount['title'].' Account Successfully Added</div>';
    }else{
        return '<div class="alertxxx alertxxx-danger"> ERROR ! ('.$error.')</div>';
    }
}
function WhiterzSubMenu($CurrentAccount){
?>
<ol class="breadcrumb">
        <li><a href="admin.php?page=Whiterz&WhiterzGET=Accounts">All Accounts</a></li>
        <li><a href="admin.php?page=Whiterz&WhiterzGET=Accounts&Action=List&Account=<?php echo $_GET['Account'];
?>">
		<?php echo $_GET['Account'];
?> Accounts</a></li>
        <?php         if($CurrentAccount['apiurl']):         ?>
        <li><a href="<?php echo $CurrentAccount['apiurl'];
?>" target="_blank"><?php echo $CurrentAccount['title'];
?> API Page</a></li>
		<?php endif;
?>
        <?php	if($CurrentAccount['register']):	?>
        <li><a href="<?php echo $CurrentAccount['register'];
?>" target="_blank"><?php echo $CurrentAccount['title'];
?> Sign up</a></li>
        <?php endif;
?>
    </ol>
<?php }
function WhiterzCategoryList(){
    ?>
<div class="whiterz_right_content span4">
        <div class="row-fluid tab-content">
        <span>These categories bookmarking</span>
                <ul class="" id="categorychecklist" data-wp-lists="list:category">
<?php                  
		$categories=  get_categories('hide_empty=0');
            $checkbox = '<li class="popular-category">
				<label class="selectit "><input value="all" type="checkbox" name="filter_cat_in[]">';
					$checkbox .= 'All Categories';
					$checkbox .= '</label></li>';
						echo $checkbox;
							foreach ($categories as $category){
								$checkbox = '<li class="popular-category">
									<label class="selectit"><input value="'.$category->term_id.'" type="checkbox" name="filter_cat_in[]">';
								$checkbox .= $category->cat_name;
							$checkbox .= '</label></li>';
						echo $checkbox;
					}
?>
                </ul>
        </div>
        <div class="row-fluid tab-content">
        <span>These categories DON'T bookmarking</span>
        <ul class="categorychecklist form-no-clear" id="categorychecklist" data-wp-lists="list:category">
        <?php
        $checkbox = '<li class="popular-category">
					<label class="selectit"><input value="all" type="checkbox" name="filter_cat_out[]">';
					$checkbox .= 'None';
					$checkbox .= '</label></li>';
					echo $checkbox;
					foreach ($categories as $category){
					$checkbox = '<li class="popular-category">
                    <label class="selectit"><input value="'.$category->term_id.'" type="checkbox" name="filter_cat_out[]">';
					$checkbox .= $category->cat_name;
					$checkbox .= '</label></li>';
					echo $checkbox;
					}
        ?>
</ul>
    </div>
		</div>
<?php }
function WhiterzUpdateOption(){
	if(isset($_POST['whiterz_cron_post'])){
        global $Whiterz;
             global $WhiterzCurl;
             if(strlen(get_option('whiterz_twp_api_key'))==16 and strlen(get_option('whiterz_twp_api_secret'))==10){
                 $data=  http_build_query(array(
                    'set'=>$_POST['whiterz_cron_post'],
                    'api_key'=>get_option('whiterz_twp_api_key'),
                    'api_secret'=>get_option('whiterz_twp_api_secret'),
                    'action'=>'setcron',
                    'target'=>admin_url("admin-ajax.php?action=WhiterzApiv10&WhiterzDo=Autoping&api_key=".get_option('whiterz_twp_api_key')."&api_secret=".get_option('whiterz_twp_api_secret')),
                    'timeout'=>intval($_POST['whiterz_sleep'])));
			ob_start();
                $content=$WhiterzCurl->post($Whiterz->api_url,$data);
                $cnt=json_decode($content);
                if($cnt->status=='success'){
                $cron_ch=true;
                }
                ob_end_clean();
            }
        }
    foreach($_POST as $key=>$val){
        if($key=='whiterz_cron_post'){
            if($cron_ch) update_option($key,$val);
        }else{
            if(!is_array($key)){
                update_option($key,$val);
                            }
			}
		}
	echo '<div class="alert alert-success">Settings updated successfully!</div>';
}
function WhiterzError(){
    global $Whiterz;
    if(isset($Whiterz->error)){
        foreach($Whiterz->error as $message){
            ?>
<div class="alertxxx alertxxx-danger">
	<?php echo $message ?></div>
<?php
        }
    }
        if(isset($Whiterz->warning)){
        foreach($Whiterz->warning as $message){
            ?>
        <div class="alert alert-warning">
<?php echo $message ?>
</div>
<?php
		}
    }
}
function WhiterzModal(){
    ?>
<div class="" id="WhiterzPopup"  >   <div class="twp_modal">
                                <div class="twp_box">
                    <h2> Preparing Bookmarking..</h2>
                    <div class="updateds">Do not close this screen.</div>
                    <div class="context">Active Service : <span id="ACCOUNT_COUNT">0</span></div>
                    <div class="context">Stand-by : <span class="green" id="PENDING_ACCOUNT">0</span></div>
                    <div class="context">Sent : <span class="orange" id="POSTED_ACCOUNT">0</span></div>
                    <div class="context">Unsent : <span class="orange" style="color:red" id="ERROR_ACCOUNT">0</span></div>
                    <div class="pinging">
                    <div class="infoBox">
                <span class="animator" style="float:left"><img src="<?php echo WHITERZ_PLUGIN_DIR;
?>/WhiteRZI/82.gif" />
			</span> %<span id="complate">0</span>
        </div>
		<br>
        <div class="bar">
        <div id="percent">
		</div>
        </div>
        </div>
        <div class="statues">
		</div>
        </div>
            </div>
</div>
<div class="avgrund-cover"></div>
<?php 
		}
function WhiterzSubSTR($content,$limit){
    $des=strip_tags($content,'<img>,<a>');
    if ((strlen($des) > $limit) && (strlen($des) > 1)) {
            $whitespaceposition = strpos($des," ",$limit);
    if($whitespaceposition){
    $d = substr($des, 0, $whitespaceposition).'...';
    }else{
        $d=$des;
    }
    }else{
        return $des;
    }
    if(strlen($des)>$limit){
    }
    return $d;
}
function tax2str($taxy,$post_id,$id=false){
    $terms = wp_get_post_terms($post_id,$taxy);
    $count = count($terms);
     if ( $count > 0 ){
        foreach ( $terms as $term ) {
        $brk[$taxy][]= $id ? $term->term_id : $term->name;
        }
        return  !$id ? @implode($brk[$taxy],' , ') : $brk[$taxy];
    }else{
        return false;
    }
}
function WhiterzCT2ARRAY($val){
    $filter_cat_in=explode('#',$val);
    if(is_array($filter_cat_in)){
        foreach($filter_cat_in as $b){
            $fci[]=str_replace('#','',$b);
        }
    }
return $fci;
}
function WhiterzPostPingFilter($post_id){
    if(get_option('whiterz_bookmarking')==1){
        return true;
    }else{
        return false;
    }
}
function WhiterzCustomCt($category,$cat_in,$cat_out){
    $cat_filter=get_option('whiterz_ct_filter');
        if($cat_filter=='custom' or $cat_filter=='none'){
        return true;
        }
        if($cat_filter=='custom_account'){
            if($cat_out=='#all#'or in_array('#all#',$cat_out)){
                return false;
            }
            if($cat_in=='#all#' or in_array('#all#',$cat_in)){
                return true;
            }
            foreach($category as $b){
                if(in_array($b,$cat_out) or in_array('all',$cat_out)){
                    return false;
                }
            }
            foreach($category as $b){
                if($b=='all'){
                    return true;
                }
                if(in_array($b,$cat_in) or in_array('all',$cat_in)){
                     return true;
                }
            }
        }
}
function WhiterzXML(){
    if(function_exists('simplexml_load_file')){
        @$plg=simplexml_load_file("http://91.143.87.117/whiterz.xml");
        if($plg){
            $Whiterz_xml=$plg;
        }else{
            $Whiterz_xml=false;
        }
      }else{
        $Whiterz_xml=false;
    }
    return $Whiterz_xml;
}
  function WHTShorten($url){
    ob_start();
    global $WhiterzCurl;
    $dlinkshorten=get_option('whiterz_current_ls');
    switch($dlinkshorten):
        case 'bcvc':
            $APIURL='http://bc.vc/api.php?key='.get_option('whiterz_bcvc_apikey').'&uid='.get_option('whiterz_bcvc_uid').'&url='.urlencode($url);
            $l=$WhiterzCurl->get($APIURL);
            $p_url= $l!='' ? $l : $url;
            break;
        case 'adfly':
            $APIURL='http://api.adf.ly/api.php?key='.get_option('whiterz_adfly_apikey').'&uid='.get_option('whiterz_adfly_uid').'&advert_type=int&domain=adf.ly&url='.urlencode($url);
            $l=$WhiterzCurl->get($APIURL);
            $p_url= $l!='' ? $l : $url;
            break;
        case 'googl':
            require WHITERZ_PLUGIN_PATH. 'WhiteRZC/google.php';
            $googl = new WHTGoogl(get_option('whiterz_googl_apikey'));
            $p_url= $googl->shortenUrl($url);
            break;
        default:
            $p_url= $url;
            break;
    endswitch;
    ob_end_clean();
    return $p_url;
}
  function WhiterzTemplate2Content($post_id,$post){
        $title=get_the_title($post_id);
    $title=html_entity_decode($title, ENT_COMPAT, 'UTF-8');
    $categories=tax2str('category',$post_id);
    $tags=tax2str('post_tag',$post_id);
    $post_Uri=get_permalink($post_id);
    $PostLink=WHTShorten($post_Uri);
    $catch=array('%CONTENT%','%SUMMARY%','%THUMB%','%LINK%','%TITLE%','%CATEGORIES%','%TAGS%','%DATE%','%HOUR%','%THUMB_URL%');
    $replace=array($post->post_content,
        $post->post_excerpt,
        get_the_post_thumbnail($post_id, 'thumbnail'),
        $PostLink,
        $title,
        $categories,
        $tags,
        date('d/m/Y'),
        date('H:i'),wp_get_attachment_url(get_post_thumbnail_id($post_id)),);
        $c['content']=$icerik=str_replace($catch,$replace,stripslashes(get_option('whiterz_content')));
		$c['title']=str_replace($catch,$replace,stripslashes(get_option('whiterz_ping_title')));
        preg_match_all("|\%SUMMARYOFCONTENT\['(.*?)'\]\%|",$icerik,$st3);
		for($i=0;$i<count($st3[1]);$i++){
        $c['content']=str_replace($st3[0][$i],WhiterzSubSTR( strip_tags($post->post_content),$st3[1][$i]),$c['content']);
        $c['title']=str_replace($st3[0][$i],WhiterzSubSTR( strip_tags($post->post_content),$st3[1][$i]),$c['title']);
		}
        preg_match_all("|\%TAX\['(.*?)'\]\%|",$c['content'],$s);
		for($i=0;$i<count($s[1]);$i++){
        $c['content']=str_replace($s[0][$i],tax2str($s[1][$i],$post_id),$c['content']);
		}
        preg_match_all("|\%TAX\['(.*?)'\]\%|",$c['title'],$s);
		for($i=0;$i<count($s[1]);$i++){
        $c['title']=str_replace($s[0][$i],tax2str($s[1][$i],$post_id),$c['title']);
		}
        preg_match_all("|\%COSTUMFIELD\['(.*?)'\]\%|",$c['content'],$st);
		for($i=0;$i<count($st[1]);$i++){
        $c['content']=str_replace($st[0][$i],get_post_meta($post_id,$st[1][$i],true),$c['content']);
		}
		preg_match_all("|\%COSTUMFIELD\['(.*?)'\]\%|",$c['title'],$st);
		for($i=0;$i<count($st[1]);$i++){
        $c['title']=str_replace($st[0][$i],get_post_meta($post_id,$st[1][$i],true),$c['title']);
		}
        preg_match_all("|\%DELETE\['(.*?)'\]\%|",$c['content'],$st);
		for($i=0;$i<count($st[1]);$i++){
        $c['content']=str_replace($st[0][$i],str_replace($st[1][$i],''),$c['content']);
		}
		preg_match_all("|\%DELETE\['(.*?)'\]\%|",$c['title'],$st);
		for($i=0;$i<count($st[1]);$i++){
        $c['title']=str_replace($st[0][$i],str_replace($st[1][$i],''),$c['title']);
		}
		preg_match_all("|\%SHORTURL\['(.*?)'\]\%|",$c['content'],$st);
		for($i=0;$i<count($st[1]);$i++){
        $c['title']=str_replace($st[0][$i],WHTShorten($st[0][$i]),$c['content']);
		}
		preg_match_all("|\%SHORT\[{(.*?)},'(.*?)'\]\%|",$c['content'],$st);
		for($i=0;$i<count($st[1]);$i++){
        $c['content']=str_replace($st[0][$i],WhiterzSubSTR($st[1][$i],$st[2][$i]),$c['content']);
		}
		preg_match_all("|\%SHORT\[{(.*?)},'(.*?)'\]\%|",$c['title'],$st);
		for($i=0;$i<count($st[1]);$i++){
        $c['title']=str_replace($st[0][$i],WhiterzSubSTR($st[1][$i],$st[2][$i]),$c['title']);
		}
		preg_match_all("|\%FIRSTIMAGE\[(.*?),(.*?)]\%|",$c['content'],$st);
		if(preg_match('/<img.+src=[\'"](?P<src>.+)[\'"].*>/i', $texthtml, $image))     {
		for($i=0;$i<count($st[1]);$i++){
        $c['content']=str_replace($st[0][$i],'<img src="'.$image['src'].'" width="'.$st[1][$i].'" height="'.$st[2][$i].'" />',$c['content']);
		}
	}
		$c['content'] = html_entity_decode($c['content'],ENT_COMPAT, 'UTF-8');
		$c['title'] = html_entity_decode($c['title'],ENT_COMPAT, 'UTF-8');
		$c['url'] = $PostLink;
		return $c;
}
function CreateWHTCronFile(){
    $file_content='<?php
include "wp-load.php";
$post_type=explode(",",get_option("WHTPostType"));
$args = array(\'posts_per_page\'  => 1,\'orderby\'=> \'post_date\',\'order\'=> \'DESC\',\'meta_query\' => array(array(\'key\' => \'Whiterz-Ping\',\'value\' =>\'\' ,\'compare\' => \'NOT EXISTS\')),\'post_type\'=> $post_type,\'post_status\'=> \'publish\',);
$current_user = wp_get_current_user();
$query = new WP_Query( $args );
if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
                $query->the_post();
                $p_id= get_the_ID();
        }
        $hd=admin_url(\'admin-ajax.php?action=WHTCron&post_id=\'.$p_id);
        header("Location:".$hd);
        exit();
}else{
    $args = array(\'posts_per_page\'  => 1,\'orderby\'=> \'post_date\',\'order\'=> \'DESC\',\'meta_query\' => array(array(\'key\' => \'Whiterz-Ping\',\'value\' =>\'0\',\'compare\' => \'=\')),\'post_type\'=> \'post\',\'post_status\'=> \'publish\',);
$current_user = wp_get_current_user();
$query = new WP_Query( $args );
if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
                $query->the_post();
                $p_id= get_the_ID();
        }
        $hd=admin_url(\'admin-ajax.php?action=WHTCron&post_id=\'.$p_id);
        header("Location:".$hd);
        exit();
}
 }
?>';
    if(isset($_POST['WHTCronChange'])){
        $file_name=MakeWHTCode(16);
        update_option('WHTCronFile',$file_name);
    }elseif(isset($_POST['CreateWHTCronFile'])){
        if(get_option('WHTCronFile')){
		$file_name=get_option('WHTCronFile');
        }else{
		$file_name=MakeWHTCode(16);
		update_option('WHTCronFile',$file_name);
        }
    }elseif(isset($_POST['WHTCronDownload'])){
        if(get_option('WHTCronFile')){
		$file_name=get_option('WHTCronFile');
        }else{
		$file_name=MakeWHTCode(16);
		update_option('WHTCronFile',$file_name);
        }
        header('Content-type: application/php');
        header('Content-Disposition: attachment;filename="'.$file_name.'.php"');
        echo $file_content;
        exit;
    }
		$rnd=$file_name.".php";
		$WHTCronFile = ABSPATH.$rnd;
		if (!file_exists($WHTCronFile)) {
			$cron_url=admin_url('admin-ajax.php?action=cj&LC='.get_option('Twp_GE_Licence_Key').' ');
            $dosya_adi = "../".str_replace('-','',get_option('Twp_GE_Licence_Key')).".php";
            $WHTOpen = @fopen ($WHTCronFile , 'w');	             @fwrite ( $WHTOpen , $file_content ) ;
            @fclose ($WHTOpen);
        }
    if (file_exists($WHTCronFile)) {
		}
	}
	if(isset($_POST['CreateWHTCronFile']) or isset($_POST['WHTCronChange']) or isset($_POST['WHTCronDownload'])){
    CreateWHTCronFile();
	}
	function MakeWHTCode($length=6,$level=2){
    list($usec, $sec) = explode(' ', microtime());
	srand((float) $sec + ((float) $usec * 100000));
	$validchars[1] = "0123456789abcdfghjkmnpqrstvwxyz";
	$validchars[2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$validchars[3] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$code  = "";
	$counter   = 0;
	while ($counter < $length) {
	$actChar = substr($validchars[$level], rand(0, strlen($validchars[$level])-1), 1);
	if (!strstr($code, $actChar)) {
		$code .= $actChar;
			$counter++;
	}
}
   return $code;
}
?>
