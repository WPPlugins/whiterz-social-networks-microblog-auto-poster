<?php 
	$lc = whiterz_licence_check( get_option( 'whiterz_licence_key' ));
		if (!$lc) {} else{ switch(@$_GET['Action']){
	case 'New': include 'Account.New.php';
		break;
	case 'List': include 'Account.List.php';
		break;
	case 'Edit': include 'Account.Edit.php';
		break;
	default : include 'Account.Select.php';
		break;
		}
	}
?>