<div class="deneme">
<div class="panel panel-default panel-block panel-title-block">
<div class="panel-heading">
<div>
<i class="icon-edit"></i>
<h1>
<span class="page-title">Authority Settings</span></h1><br><br>
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
<div class="deneme"><?php if($_POST){     if(isset($_POST['WHTPermision'])){         update_option('WHTPermision',implode(',',$_POST['WHTPermision']));         $wp_roles = get_editable_roles();         if($wp_roles):             foreach($wp_roles as $key=>$role):                 $role = get_role( $key );                 $role->remove_cap( 'WHTMakePost' );             endforeach;         endif;         foreach($_POST['WHTPermision'] as $role){             $role = get_role($role);             $role->add_cap('WHTMakePost');         }         $role = get_role('administrator');         $role->add_cap('WHTMakePost');     }else{         update_option('WHTPermision','');     } } ?>  <form action='' method='post'>   <div class="box color_3">  <div class="title">
<h4>POST Type and Authory Setting</h4>     </div>
<div class="form-row control-group row-fluid ">
<label class="control-label span3">Bookmarking</label>
<div class="controls span7">
<?php
$permision=get_option('WHTPermision');
$permision=explode(',',$permision);
$wp_roles = get_editable_roles();
if($wp_roles):
foreach($wp_roles as $key=>$role):
?>
<label class="checkbox">
<input type="checkbox" value="<?php echo $key; ?>" <?php
if(in_array($key,$permision)) echo 'checked';
?> name="WHTPermision[]">
<?php echo $role['name']; ?>
</label>
				<?php
				endforeach;
				endif;
				?>
</div>
</div>
</div>
<div class="box">
<div class="form-row control-group row-fluid ">
<label class="control-label span3">Post Type </label>
<div class="controls span7">
				<?php
				$WHTPostType=get_option('WHTPostType');
				?>
<input type="text" class="form-control" value="<?php echo $WHTPostType; ?>" name="WHTPostType">
<p></p>
<div class="alertxxx alertxxx-info">
<a href="http://support.whiterz.com/what-is-the-post-type-how-is-it/" target="blank"> What is the Post Type ? How is it ?</a>
</div>
</div>
</div>
<div class="form-row control-group row-fluid ">
<label class="control-label span3"></label>
<div class="controls span7">
<button class="btn btn-large btn-primary" name="option_change"><i class='icon icon-check'></i> 
Save</button>
</div>
</div>       
</div>
</form>
</div>