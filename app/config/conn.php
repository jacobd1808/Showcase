<?php
// Connection Details 

// CHANGE TO YOUR DATABASE DETAILS 


define( "DB_DATA_SOURCE", "mysql:host=localhost;dbname=ifitness_db" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "" );


/*
define( "DB_DATA_SOURCE", "mysql:host=localhost;dbname=u1153568" );
define( "DB_USERNAME", "u1153568" );
define( "DB_PASSWORD", "18aug93" );
*/
// Class Configure 

function __autoload($class) {
	$folder = '/showcase';
	//$folder = '/stud/u1153568/final/showcase';
	require_once($_SERVER['DOCUMENT_ROOT'].$folder."/app/models/$class.php");
}

include_once "functions.php";
$conn = ConnectionFactory::connect();

$imgFld = 'assets/img/';

?>