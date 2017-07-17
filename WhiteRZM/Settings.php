<?php
	$lc = whiterz_licence_check( get_option( 'whiterz_licence_key' ) );
		if (!$lc) {}
		else{ if($_POST){
		WhiterzUpdateOption();
		}
		switch(@$_GET['Action']){
		case 'ContentSettings': include 'Settings.Content.php';
			break;
		case 'AppSettings' : include 'Settings.Account.php';
			break;
		case 'BookmarkingSettings' : include 'Settings.Bookmarking.php';
			break;
		case 'PostType/Editor' : include 'Settings.PostType.php';
			break;
		case 'LinkShorten' : include 'Settings.LinkShorten.php';
			break;
		default : include 'Settings.Content.php';
			break;
		}
	}
?>