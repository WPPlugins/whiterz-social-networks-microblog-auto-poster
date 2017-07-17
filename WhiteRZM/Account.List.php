<div class="deneme">
 	<div class="panel panel-default panel-block panel-title-block">
	<div class="panel-heading"> 
	<div> 			
	<i class="icon-edit"></i>  
	<h1> 				
	<span class="page-title">
<?php echo $_GET['Account']; ?> Accounts
	</span></h1><br><br>
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
<?php
			$lc = whiterz_licence_check( get_option( 'whiterz_licence_key' ) );
			if (!$lc) {
			}else{
			$CurrentAccount=$wpdb->escape($_GET['Account']);
			$CurrentAccount=$Whiterz_Services["{$CurrentAccount}"];
			$CurrentAccount=WhiterzArray2Object($CurrentAccount);
			$Accounts=$wpdb->get_results("SELECT * from ". WHITERZ_ACCOUNT_TABLE ."
			where account_name='".$CurrentAccount->account_name."'  order by account_id desc");
			if(!$Accounts){     
			echo '<div class="row-fluid"><p></p><div class="alert alert-danger">
			These services have been added to the account !</div></div>';
			return; } 
?>
	<input type="hidden" name="WhiterzAjaxUrl" value="
<?php 
			echo admin_url( 'admin-ajax.php' ); ?>"/>
<?php
			$count = 1; foreach ( $Accounts as $Account ): 
?>
	<div class="deneme">
 	<div class="row-fluid"> 
	<div class="form-horizontal"> 
	<div class="box color_<?php echo $count ?>
<?php 
			echo $Account->active == 1 ? 'active' : 'deactive'; 
?>
">
	<span class="label label-primary">
	<?php 
			echo ( $Account->active == 1 ) ? '' : 'Deactive'; ?></span> 	
	<div class="content top"> 		
	<div class="row-fluid"> 	
	<div class="row-fluid"> 	
	<div class="row-fluid"> 	
	<h4>
<?php
			echo ucfirst($Account->social_address); 
?>
	</h4>
	<hr> 
	</div> 		
	<div class="row-fluid"> 
	<div class="col-md-13"> 	
	<div class="tab-content"> 
<?php 				
			if ( $Account->last_post != '0' ) { 	
			$array = explode( ',', $Account->last_post ); 	
			$last_post = str_replace( '#', '', $array['0'] ); 
			$last_post_id = str_replace( '#', '', $array['1'] ); 	
			$total_post = str_replace( '#', '', $array['2'] ); 			
			$post_title = get_the_title( $last_post_id ); 				
			$post_link = get_permalink( $last_post_id ); 			
			} else { 							
			$last_post = ''; 					
			$last_post_id = ''; 				
			$total_post = ''; 					
			} 									
?> 						
	Last Post : 
	<b>
<?php 
			echo $last_post 
?>
	</b><br/> 
	Last Posted : 	
	<b>
<?php 
			echo $last_post_id != '' ? '
			<a href="' . $post_link . '" target="_blank">' . $post_title . '</a>' : '-'; 
?>
	</b><br/> 							
	Total Sent : 
	<b>
<?php 
			echo $total_post; 
?>
	</b><br/> 	
	</div> 		
	</div> 		
	</div> 			
	</div> 			
	</div>        
	<div class=" row-fluid">    
	<a href="javascript:void(0)" onclick="alertdelete()"class="whiterz_ajax_button btn btn-danger onclick=alertactive() btn-xs" data-action="WhiterzDeleteAccount" data-id="<?php echo $Account->account_id; ?>"><i class="icon icon-remove"></i> 
	Delete</a>                 
<?php 
			if($Account->active==1){
?>
    <a href="javascript:void(0)" onclick="alertactive()" class="single_account_status btn btn-warning  btn-xs" data-id="<?php echo $Account->account_id; ?>" data-value="0">Deactive</a> 
<?php 
			}else{
?>               
    <a href="javascript:void(0)" onclick="alertdeactive()" class="single_account_status btn btn-success btn-xs" data-id="<?php echo $Account->account_id; ?>" data-value="1">Active</a>    
<?php
			}
?>                 
	<a href="admin.php?page=Whiterz&WhiterzGET=Accounts&Action=Edit&Account=<?php echo $Account->account_name; ?>&AccountID=<?php echo $Account->account_id; ?>" class="btn btn-primary btn-xs">Edit</a>
	<a href="<?php echo $Account->social_address; ?>" target="_blank" class="btn btn-default btn-xs">
	<i class="icon icon-external-link"></i> 
	Get to page</a> 
	</div> 			
	</div> 			
	</div> 		
	</div> 		
	</div> 	
	</div> 
<?php 	
			$count = ($count == 24 ? 1 : $count); 	$count++; endforeach;}
?> 