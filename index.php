<?php
include("inc/config.php"); 
if(isset($_SESSION['token']) && $_SESSION['token'] != ""){
	accFunctions($_SESSION['token']);
} 
$user = new user(); 
$dashboard = new dashboard(); 
if(!$user->status()){ 
	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(18));
	include("login.php");
}
else {
	include("home.php");
}
?>