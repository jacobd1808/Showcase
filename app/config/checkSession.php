<?php session_start();

if(!isset($_SESSION['ifitness_id'])) { 
	header("Location: login.php");
}

?>