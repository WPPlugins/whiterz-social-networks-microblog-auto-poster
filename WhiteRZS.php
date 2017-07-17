<?php
$Whiterz_Services=array(
    'GooglePlus'=>array(
	'title' => 'Google +',
	'account_name'=> 'GooglePlus',
	'type'=> 'Social Network',
	'rank'=> '10',
	'form' =>array(
	'login' => array(
	'name' => 'login',
	'type'=>'text',
	'title'=> 'Gmail Address',
	'desc'=> 'Example : whiterz@gmail.com'),
	'passwd' => array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Gmail Password',
	'desc'=> ''
	),
	'whiterz_social_url' => array(
	'name' => 'api_key',
	'type'=>'text',
	'title'=> 'Google Profile URL',
    'desc'=> ''
	)
	),
	'default'=>'', 'apiurl' => false,
	'register'=>'http://google.com/',
	'function'=> 'googleplus',
	'address_block'=>'%SOCIAL_URL%',
	),
	'GooglePage'=>array(
	'title' => 'Google + Page',
	'account_name'=> 'GooglePage',
	'type'=> 'Social Network',
	'rank'=> '10',
	'form' =>array(
	'login' => array(
	'name' => 'login',
	'type'=>'text',
	'title'=> 'Gmail Address',
	'desc'=> 'Example : whiterz@gmail.com'
	),
	'passwd' => array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Gmail Password',
	'desc'=> ''
	),	
	'custom_field' => array(
	'name' => 'custom_field',
	'type'=>'text',
	'title'=> 'Google Page ID',
	'desc'=> 'Digit of page id <a href="http://support.whiterz.com/?p=103" target="_blank">Page ID detection</a>'
	),
    'whiterz_social_url' => array(
	'name' => 'api_key',
	'type'=>'text',
	'title'=> 'Google Profile URL',
	'desc'=> ''
	)
	),
	'default'=>'',
	'apiurl' => false,
	'register'=>'http://google.com/',
	'function'=> 'googleplus',
	'address_block'=>'%SOCIAL_URL%',
	),
	'GoogleCommunity'=>array(
	'title' => 'GooglePlus Community',
	'account_name'=> 'GoogleCommunity',
	'type'=> 'Social Network',
	'rank'=> '10',
	'form' =>array(
	'login' => array(
	'name' => 'login',
	'type'=>'text', 
	'title'=> 'Gmail Address',
    'desc'=> 'Example : whiterz@gmail.com'
	),
	'passwd' => array(
	'name' => 'passwd',
    'type'=>'password',
	'title'=> 'Gmail Password',
	'desc'=> ''
	),   	
	'custom_field' => array(
	'name' => 'custom_field',
	'type'=>'text',
	'title'=> 'Google Comunity ID',
    'desc'=> 'Digit of community id <a href="http://support.whiterz.com/?p=100" target="_blank">Community ID detection</a>'
	),
	'whiterz_social_url' => array(
	'name' => 'api_key',
	'type'=>'text',
	'title'=> 'Google Community URL',
	'desc'=> ''
	)
	),
	'default'=>'',
	'apiurl' => false,
	'register'=>'http://google.com/',
	'function'=> 'googleplus',
	'address_block'=>'%SOCIAL_URL%',
	),
	'YouTube'=>array(
	'title' => 'YouTube',
	'account_name'=> 'YouTube',
	'type'=> 'Video Network',
	'rank'=> '9',
	'form' =>array(
    'login' => array( 
	'name' => 'login',
	'type'=>'text', 
	'title'=> 'Gmail Address',
	'desc'=> 'Example : whiterz@gmail.com'
	), 
	'passwd' => array(  
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Gmail Password',
	'desc'=> ''
	),     	
	'whiterz_social_url' => array(
	'name' => 'api_key',
	'type'=>'text',
	'title'=> 'YouTube Channel URL',
	'desc'=> ''
	)
	),
	'default'=>'',
	'apiurl' => false,
	'register'=>'http://youtube.com/', 
	'function'=> 'youtube',
	'address_block'=>'%SOCIAL_URL%',
	),     'Pinterest'=>array(
	'title' => 'Pinterest',
	'account_name'=> 'Pinterest',
	'type'=> 'Social Network',
	'rank'=> '9',
	'form' =>array(
	'login' => array(
	'name' => 'login', 
	'type'=>'text',  
	'title'=> 'E-Mail Address', 
	'desc'=> 'Example : whiterz@gmail.com' 
	),
	'passwd' => array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Password',
	'desc'=> ''
	),
	'custom_field' => array(
	'name' => 'custom_field',
	'type'=>'text',
	'title'=> 'Pinterest Board ID',
	'desc'=> '<a href="http://support.whiterz.com/?p=94" target="_blank">Get Pinterest Board ID</a>'
	),
	'whiterz_social_url' => array(
	'name' => 'api_key',
	'type'=>'text',
	'title'=> 'Pinterest Page URL',
	'desc'=> ''
	),
	),
	'default'=>'', false,
	'register'=>'https://pinterest.com/join/register/email/',
	'function'=> 
	'pinterest',
	'address_block'=>'%SOCIAL_URL%',
	'is_pro'=>true,
	),
	'FacebookProfile'=>array(
	'title' => 'Facebook Profile',
	'account_name'=> 'FacebookProfile',
	'type'=> 'Social Media',
	'rank'=> '7',
	'form' => false,
	'default'=>'', 'apiurl' => false,
	'register'=>false,
	'function'=> 'facebook_p',
	'address_block'=>'%SOCIAL_URL%'     
	),
	'FacebookFanPage'=>array(
	'title' => 'Facebook Page',
	'account_name'=> 'FacebookFanPage',
	'type'=> 'Social Media',
	'rank'=> '7',
	'form' => false,
	'default'=>'', 'apiurl' => false,
	'register'=>false,
	'function'=> 'facebook_fp',
	'address_block'=>'%SOCIAL_URL%'     ),     'Twitter'=>array(
	'title' => 'Twitter',
	'account_name'=> 'Twitter',
	'type'=> 'Micro Blog',
	'rank'=> '8',
	'form' => false,
	'default'=>'', 'apiurl' => 'http://dev.twitter.com/',
	'register'=>'http://twitter.com/',
	'function'=> 'twitter',
	'address_block'=>'%SOCIAL_URL%'),
	'Plurk'=>array(
	'title' => 'Plurk',
	'account_name'=> 'Plurk',
	'type'=> 'Social Media',
	'rank'=> '7',
	'form' => false,
	'default'=>'',
	'apiurl' => false,
	'register'=>false,
	'function'=> 'plurk_post',
	'address_block'=>'%SOCIAL_URL%',
	),     
	'Linkedin'=>
	array(
	'title' => 'Linkedin',
	'account_name'=> 'Linkedin',
	'type'=> 'Social Media',
	'rank'=> '9',
	'form' => false,
	'default'=>'', 'apiurl' => 'https://www.linkedin.com/secure/developer',
	'register'=>'https://www.linkedin.com/reg/join?trk=hb_join',
	'function'=> 'linkedin',
	'address_block'=>'%SOCIAL_URL%',
	'api_url'=>'http://www.tumblr.com/oauth/register',
	),    
	'Tumblr'=>array(
	'title' => 'Tumblr',
	'account_name'=> 'Tumblr',
	'type'=> 'Blog',
	'rank'=> '9',
	'form' => false,
	'notice' => false,
	'register'=>'https://www.tumblr.com/',
	'api_url'=>'http://www.tumblr.com/oauth/register',
	'function'=> 'tumblr',
	'address_block'=>'http://%LOGIN%.tumblr.com'     ),
	'Linklicious'=>
	array(
	'title' => 'Linklicious',
	'account_name'=> 'Linklicious',
	'type'=> 'Ping Service',
	'rank'=> '10',
	'form' =>array(
	'passwd' => array(
	'name' => 'passwd',
	'type'=>'radio',
	'title'=> 'Api Functions',
	'option' => array(
	'whiterzWHT'=>'Whiterz API (<a href="http://support.whiterz.com/?p=97" target="_blank">Activated on 04.07.2014</a>)',
	'Linklicious' => 'Linklicious API'
	),
	'desc'=> ''
	),
	'api_key' => array(
	'name' => 'api_key',
	'type'=>'text',
	'title'=> 
	'Linklicious Api Key',
	'desc'=> '',
	),
	'api_secret' => array(
	'name' => 'api_secret',
	'type'=>'text',
	'is_active'=>false,
	'title'=> 'Whiterz Api Key',
	'desc'=> 'Whiterz API Private Key'
	),
	'custom_field' => array(
	'name' => 'custom_field',
	'type'=>'text',
	'title'=> 'How many times you\'re thrown ping Links',
	'desc'=> ''
	),
	),
	'default'=>'', 'apiurl' => 'http://www.linklicious.me/Account/api',
	'register'=>'http://www.linklicious.me/Home/Chart',
	'function'=> 'linklicious',
	'address_block'=>'http://www.linklicious.me/Account/Links?filter=all'
	),     
	'Friendfeed'=>array(
	'title' => 'Friendfeed',
	'account_name'=> 'Friendfeed',
	'type'=> 'Bookmarking',
	'rank'=> '9',
	'form' =>array(
	'login' => array(
	'name' => 'login',
	'type'=>'text',
	'title'=> 'Username',
	'desc'=> false
	),
	'api_key' => array(
	'name' => 'api_key',
	'type'=>'text',
	'title'=> 'Api Key',
	'desc'=> 'FriendFeed is the api key areas.Do not enter password.'
	),
	),
	'default'=>'', 'apiurl' => 'http://friendfeed.com/account/api',
	'register'=>'http://friendfeed.com/account/create',
	'function'=> 'friendfeed',
	'address_block'=>'http://friendfeed.com/%LOGIN%'
	),
	'Delicious'=>array(
	'title' => 'Del.icio.us',
	'account_name'=> 'Delicious',
	'type'=> 'Bookmarking',
	'rank'=> '9',
	'form' =>array(
	'login' => array(
	'name' => 
	'login',
	'type'=>'text',
	'title'=> 'Username',
	'desc'=> false
	),
	'passwd' => 
	array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Password',
	'desc'=> ''
	),
	),
	'default'=>'',
	'apiurl' => false,
	'register'=>'https://delicious.com/join/create',
	'function'=> 'delicious',
	'address_block'=>'http://delicious.com/%LOGIN%'
	),     
	'Diigo'=>array(
	'title' => 'Diigo',
	'account_name'=> 	'Diigo',
	'type'=> 'Social Blog',
	'rank'=> '9',
	'form' =>array(
	'login' => array(
	'name' => 
	'login',
	'type'=>'text',
	'title'=> 'Username',
	'desc'=> false
	),
	'passwd' => 
	array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Password',
	'desc'=> ''
	),
	'api_key' => array(
	'name' => 'api_key',
	'type'=>'text',
	'title'=> 'Api Key',
	'desc'=> 'Diigo is the api key areas.Do not enter password.'
	),
	),
	'default'=>'', 'apiurl' => 'http://www.diigo.com/api_keys/new/',
	'register'=>'https://www.diigo.com/sign-up?referInfo=https%3A%2F%2Fwww.diigo.com',
	'function'=>'diigo',
	'address_block'=>'http://www.diigo.com/user/%LOGIN%'     ),     'Wordpress'=>array(
	'title' => 'Wordpress Blog',
	'account_name'=> 'Wordpress',
	'type'=> 'Blog',
	'rank'=> '8',
	'form' =>array(
	'login' => array(
	'name' => 'login',
	'type'=>'text',
	'title'=> 'Wp Admin Login',
	'desc'=> false
	),
	'passwd' => array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Wp Admin Password',
	'desc'=> ''
	),
	'whiterz_social_url' => array(
	'name' => 'whiterz_social_url',
	'type'=>'text',
	'title'=> 'Blog Url',
	'desc'=> 'Example : http://whiterz.wordpress.com/<br/> Example 2: http://whiterz.com/ <br /> Wordpress\'s xmlrpc property attention to be turned on.'
	),
	),
	'default'=>'',
	'apiurl' => false,
	'register'=>false,
	'function'=> 'wordpress',
	'address_block'=>'%SOCIAL_URL%'     ),
	'Onsugar'=>array(
	'title' => 'OnSugar',
	'account_name'=> 'Onsugar',
	'type'=> 'Blog',
	'rank'=> '9',
	'form' => array(
	'login' => array(
	'name' => 'login',
	'type'=>'text',
	'title'=> 'Username',
	'desc'=> false
	),
	'passwd' => array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Password',
	'desc'=> ''
	),
	'whiterz_social_url' => array(
	'name' => 'whiterz_social_url',
	'type'=>'text',
	'title'=> 'Blog Url',
	'desc'=> 'Example : http://whiterz.onsugar.com/'
	),
	),
	'default'=>'',
	'apiurl' => false,
	'register'=>'https://secure.onsugar.com',
	'function'=> 'onsugar',
	'address_block'=>'%SOCIAL_URL%'     ),     'Blogcom'=>array(
	'title' => 'Blog.com',
	'account_name'=> 'Blogcom',
	'type'=> 'Blog',
	'rank'=> '7',
	'form' =>array(
	'login' => array(
	'name' => 'login',
	'type'=>'text',
	'title'=> 'Login',
	'desc'=> ''
	),
	'passwd' => array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Password',
	'desc'=> ''
	),
	'whiterz_social_url' => array(
	'name' => 'whiterz_social_url',
	'type'=>'text',
	'title'=> 'Blog Url',
	'desc'=> 'Example : http://whiterz.blog.com/<br /> '
	),
	),
	'default'=>'', 'apiurl' => false,
	'register'=>'http://www.blog.com',
	'function'=> 'wordpress',
	'address_block'=>'%SOCIAL_URL%'     ),     'Livejournal'=>array(
	'title' => 'Live Journal',
	'account_name'=> 'Livejournal',
	'type'=> 'Social Blog',
	'rank'=> '8',
	'form' =>array(
	'login' => array(
	'name' => 'login',
	'type'=>'text',
	'title'=> 'Username',
	'desc'=> 'E-mail for your account to be sure of the activation occurs.'
	),
	'passwd' => array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Password',
	'desc'=> ''
	),
	),
	'default'=>'', 'apiurl' => false,
	'register'=>'https://www.livejournal.com/create',
	'function'=> 'livejournal',
	'address_block'=>'http://%LOGIN%.livejournal.com'),
	'Blogger'=>array(
	'title' => 'Blogger',
	'account_name'=> 'Blogger',
	'type'=> 'Blog',
	'rank'=> '8',
	'form' =>array(
	'login' => array(
	'name' => 'login',
	'type'=>'text',
	'title'=> 'Google E-Mail',
	'desc'=> 'Example: whiterz@gmail.com , support@whiterz.com'
	),
	'passwd' => array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Password',
	'desc'=> ''
	),
	'custom_field' => array(
	'name' => 'custom_field',
	'type'=>'text',
	'title'=> 'Blogger ID',
	'desc'=> '<a href="http://support.whiterz.com/?p=105" target="_blank">Get Blogger ID</a>'
	),
	'whiterz_social_url' => array(
	'name' => 'whiterz_social_url',
	'type'=>'text',
	'title'=> 'Blogger Url',
	'desc'=> 'Example : http://whiterz.blogger.com/'
	),
	),
	'default'=>'', 'apiurl' => false,
	'register'=>'http://blogger.com',
	'function'=> 'blogger',
	'address_block'=>'%SOCIAL_URL%'
     ),     
	 'Zootool'=>array(
	'title' => 'Zootool (Deactive)',
	'account_name'=> 'Zootool',
	'type'=> 'Bookmarking',
	'rank'=> '8',
	'form' =>array(
	'login' => array(
	'name' => 'login',
	'type'=>'text',
	'title'=> 'Username',
	'desc'=> false
	),
	'passwd' => array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Password',
	'desc'=> ''
	),
	'api_key' => array(
	'name' => 'api_key',
	'type'=>'text',
	'title'=> 'Api Key',
	'desc'=> 'Please read the help file.'
	),
	'api_secret' => array(
	'name' => 'api_secret',
	'type'=>'text',
	'title'=> 'Api Secret',
	'desc'=> ''
	),
	),
	'default'=>'', 'apiurl' => 'http://zootool.com/api/keys',
	'register'=>'http://zootool.com/',
	'function'=> 'zootool',
	'address_block'=>'http://zootool.com/user/%LOGIN%/',
	'is_active'=>false,
	),
	'Status'=>array(
	'title' => 'Status Network',
	'account_name'=> 'Status',
	'type'=> 'Micro Blog',
	'rank'=> '6',
	'form' =>array(
	'login' => array(
	'name' => 'login',
	'type'=>'text',
	'title'=> 'Username',
	'desc'=> 'E-mail for your account to be sure of the activation occurs.'
	),
	'passwd' => array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Password',
	'desc'=> ''
	),
	'whiterz_social_url' => array(
	'name' => 'whiterz_social_url',
	'type'=>'text',
	'title'=> 'Site Url',
	'desc'=> ''
	),
	),
	'default'=>'', 'apiurl' => false,
	'register'=>false,
	'function'=> 'status',
	'address_block'=>'%SOCIAL_URL%/%LOGIN%/'     ),     'Plerb'=>array(
	'title' => 'Plerb (Deactive)',
	'account_name'=> 'Plerb',
	'type'=> 'Micro Blog',
	'rank'=> '6',
	'form' =>array(
	'login' => array(
	'name' => 'login',
	'type'=>'text',
	'title'=> 'Username',
	'desc'=> 'E-mail for your account to be sure of the activation occurs.'
	),
	'passwd' => array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Password',
	'desc'=> ''
	),
	'api_key' => array(
	'name' => 'api_key',
	'type'=>'text',
	'title'=> 'Api Key',
	'desc'=> ''
	),
	),
	'default'=>'', 
	'apiurl' => 'http://plerb.com/api/keys/',
	'register'=>false,
	'function'=> 'plerb',
	'address_block'=>'http://plerb.com/%LOGIN%',
	'is_active'=>false,
	),
	'Buzzerly'=>array(
	'title' => 'Buzzerly',
	'account_name'=> 'Buzzerly',
	'type'=> 'Micro Blog',
	'rank'=> '6',
	'form' =>array(
	'login' => array(
	'name' => 'login',
	'type'=>'text',
	'title'=> 'Username',
	'desc'=> 'E-mail for your account to be sure of the activation occurs.'
	),
	'passwd' => array(
	'name' => 'passwd',
	'type'=>'password',
	'title'=> 'Password',
	'desc'=> ''
	),
	),
	'default'=>'', 'apiurl' => false,
	'register'=>'http://buzzerly.com/signup',
	'function'=> 'buzzerly',
	'address_block'=>'http://buzzerly.com/%LOGIN%'     ),     
	 );
?>