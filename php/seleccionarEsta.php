<?php
session_start(); 
 
$_SESSION['establecimiento']=$_GET['selectEsta'];
echo json_encode("okey");



?>