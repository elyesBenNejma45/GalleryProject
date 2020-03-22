<?php 
require_once("includes/init.php");
 ?>

 <?php 
	$session->logout();
	redirect("login.php");
  ?>