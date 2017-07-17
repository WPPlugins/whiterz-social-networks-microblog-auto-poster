<?php
if(!class_exists('OAuthConsumer')){
require_once('OAuth.php');
}
  class WhiterzLinkedin {
  public $base_url = "http://api.linkedin.com";
  public $secure_base_url = "https://api.linkedin.com";
  public $oauth_callback = "oob";
  public $consumer;
  public $request_token;
  public $access_token;
  public $oauth_verifier;
  public $signature_method;
  public $request_token_path;
  public $access_token_path;
  public $authorize_path;
  public $debug = false;
  
  function __construct($consumer_key, $consumer_secret, $oauth_callback = NULL) {
    
    if($oauth_callback) {
      $this->oauth_callback = $oauth_callback;
    }
    
    $this->consumer = new OAuthConsumer($consumer_key, $consumer_secret, $this->oauth_callback);
    $this->signature_method = new OAuthSignatureMethod_HMAC_SHA1();
    $this->request_token_path = $this->secure_base_url . "/uas/oauth/requestToken";
    $this->access_token_path = $this->secure_base_url . "/uas/oauth/accessToken";
    $this->authorize_path = $this->secure_base_url . "/uas/oauth/authorize";
    
  }

  function getRequestToken() {
    $consumer = $this->consumer;
    $request = OAuthRequest::from_consumer_and_token($consumer, NULL, "GET", $this->request_token_path);
    $request->set_parameter("oauth_callback", $this->oauth_callback);
    $request->sign_request($this->signature_method, $consumer, NULL);
    $headers = Array();
    $url = $request->to_url();
    $response = $this->httpRequest($url, $headers, "GET");
    parse_str($response, $response_params);
    $this->request_token = new OAuthConsumer($response_params['oauth_token'], $response_params['oauth_token_secret'], 1);
  }

  function generateAuthorizeUrl() {
    $consumer = $this->consumer;
    $request_token = $this->request_token;
    return $this->authorize_path . "?oauth_token=" . $request_token->key;
  }

  function getAccessToken($oauth_verifier) {
    $request = OAuthRequest::from_consumer_and_token($this->consumer, $this->request_token, "GET", $this->access_token_path);
    $request->set_parameter("oauth_verifier", $oauth_verifier);
    $request->sign_request($this->signature_method, $this->consumer, $this->request_token);
    $headers = Array();
    $url = $request->to_url();
    $response = $this->httpRequest($url, $headers, "GET");
    parse_str($response, $response_params);
    if($this->debug) {
      echo $response . "\n";
    }
    $this->access_token = new OAuthConsumer($response_params['oauth_token'], $response_params['oauth_token_secret'], 1);
  }
  function setToken($token){
      $this->access_token = new OAuthConsumer($token['oauth_token'], $token['oauth_token_secret'], 1);
  }
  function getProfile($resource = "~") {
    $profile_url = $this->base_url . "/v1/people/" . $resource;
    $request = OAuthRequest::from_consumer_and_token($this->consumer, $this->access_token, "GET", $profile_url);
    $request->sign_request($this->signature_method, $this->consumer, $this->access_token);
    $auth_header = $request->to_header("https://api.linkedin.com"); # this is the realm
 
    if ($this->debug) {
      echo $auth_header;
    }
    $response = $this->httpRequest($profile_url, $auth_header, "GET");
    return $response;
  }
  
  function setStatus($status) {
    $status_url = $this->base_url . "/v1/people/~/current-status";
    $xml = "<current-status>" . htmlspecialchars($status, ENT_NOQUOTES, "UTF-8") . "</current-status>";
    $request = OAuthRequest::from_consumer_and_token($this->consumer, $this->access_token, "PUT", $status_url);
    $request->sign_request($this->signature_method, $this->consumer, $this->access_token);
    $auth_header = $request->to_header("https://api.linkedin.com");
    if ($this->debug) {
       $auth_header . "\n";
    }
    $response = $this->httpRequest($status_url, $auth_header, "PUT", $xml);
    return $response;
  }
  function feed($args) {
    $status_url = $this->base_url . "/v1/people/~/shares";
    $xml='<?xml version="1.0" encoding="UTF-8"?>';
    $xml .="<share>";
    if(array_key_exists('message', $args)) $xml.="<comment>".$args['comment']."</comment>";
    $xml .="<content>";
    $xml .="<title>".$args['title']."</title>";
    $xml .="<submitted-url>".$args['link']."</submitted-url>";
    if(array_key_exists('content', $args))$xml .="<description>".$args['content']."</description>";
    $xml .="</content>";
    $xml .="<visibility><code>anyone</code></visibility></share>";
    $request = OAuthRequest::from_consumer_and_token($this->consumer, $this->access_token, "PUT", $status_url);
    $request->sign_request($this->signature_method, $this->consumer, $this->access_token);
    $auth_header = $request->to_header("https://api.linkedin.com");
    if ($this->debug) {
       $auth_header . "\n";
    }
    $response = $this->httpRequest($status_url, $auth_header, "POST", $xml);
    return $response;
  }    
  
  
  function httpRequest($url, $auth_header, $method, $body = NULL) {
    if (!$method) {
      $method = "GET";
    };

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, (is_array($auth_header))? $auth_header : array($auth_header));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

    if ($body) {
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array($auth_header, "Content-Type: text/xml;charset=utf-8"));   
    }

    $data = curl_exec($curl);
    if ($this->debug) {
      echo $data . "\n";
    }
    curl_close($curl);
    return  $data; 
  }

}