<div class="deneme"> 
<div class="panel panel-default panel-block panel-title-block">
<div class="panel-heading">
<div>
<i class="icon-edit"></i>
<h1>
<span class="page-title">
Accounts
</span>
</h1>
<br>
<br>
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
				if (!$lc){
				}else{
				?> 			
<div class="deneme">
<div class="row-fluid">
				<?php 
				$counter=0; 
				$WhiterzServicesList=WhiterzArray2Object($Whiterz_Services);
				foreach($WhiterzServicesList as $Account => $Service):
				$counter++;
				$total_service=$wpdb->get_var("SELECT count(account_id) from 
				".WHITERZ_ACCOUNT_TABLE." where account_name='".$Service->account_name."' ");
				$active_service=$wpdb->get_var("SELECT count(account_id) from ".WHITERZ_ACCOUNT_TABLE."
				where account_name='".$Service->account_name."' and active='1' ");
				$passive_service=$wpdb->get_var("SELECT count(account_id) from ".WHITERZ_ACCOUNT_TABLE."
				where account_name='".$Service->account_name."' and active='0' "); $disabled=false;
				?>
<div class="whiterz_item box color_<?php echo $counter; ?>">
<div class="title">
<h4>
<span>
				<?php
				echo $Service->title; 
				?>
</span>
</div>
<div class="content top ">
<div class="row-fluid">
<div class="bspan whiterz_info col-md-13">
<span class="dny_total">
Total Accounts : 
<b>
				<?php 
				echo $total_service; 
				?>
</b>
</span>
<br/>    

<span class="dny_active">
Active Accounts : 
<b>
				<?php 
				echo $active_service;
				?>
</b>
</span>
<br/>
<span class="dny_passive">
Deactive Accounts : 
<b>
				<?php 
				echo $passive_service; 
				?>
</b>
</span>      
</div>
<div class="bspan whiterz_serv_info col-md-13">
<span class="dny_total">
The effect to site : 
<b>
				<?php
				echo $Service->rank; 
				?>
/10
</b>
</span>
<br/>  
<span class="dny_total">
Service Type : 
<b>
<?php
echo $Service->type;
?>
</b>
</span>
<br/>  

<span class="">
Register Page : 
<b>
<a href="<?php echo $Service->register; ?>" target="_blank">
Click..
</a>
</b>
</span>
</div>
</div>
<div class="whiterz_cl" style="margin-bottom:5px;">
</div>
<div class="whiterz_acc_link">
				<?php
				if(!isset($Service->is_active)){
				?>
<a href="admin.php?page=Whiterz&WhiterzGET=Accounts&Action=New&Account=<?php echo $Service->account_name; ?>"  class='writerzbuttonmavi <?php if($disabled) echo 'btn-disable'; ?>'>
<i class="icon icon-plus"></i>
 Add Account</a>
				<?php
				} 
				?>
<a href="admin.php?page=Whiterz&WhiterzGET=Accounts&Action=List&Account=<?php echo $Service->account_name; ?>" class="writerzbuttonred">
<i class="icon icon-list"></i>
Look service accounts.
</a>
</div>
<div class="whiterz_cl"></div>    
</div>
</div>
				<?php 
				echo $counter%2==0 ? '</div><div class="row-fluid">' : ''; endforeach; }
				?>  
</div>
</div> 