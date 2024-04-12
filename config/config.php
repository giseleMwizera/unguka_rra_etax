<?php

$color1 = "#D3D3D3";
$color2 = "#ffffff";

$c1 = "table_row_one";
$c2 = "table_row_two";

include("db_inc.php");

$theswift = 'AFRICDKSXXX';

$now = date("Y-m-d");
$date = date("Y-m-d");
$stime = 10;

$themotto = "Thank you for banking with us";
$dlimit = 5000000;
$tlimit = 2000000;
$inactive = 1800;
$rowsPerPage = 50;


$servicemail = "digital@waiwai.digital";



$pwday = 30;

$myid = "WAI".time();

//$to = uniqid(rand(), false);
//$myid = substr($to, 0, 10);



$ip = getenv("REMOTE_ADDR");
$today = date("l j F Y");



$stime = 10;
$dlimit = 300000;
$tlimit = 100000;
$inactive = 1800;
$rowsPerPage = 40;

$local_lenght = "8";
$inlt_lengt = "11";
$c_iso = "257";

$thismonth  = date("Y-m");
$ip = getenv("REMOTE_ADDR");
$today = date("l j F Y");


$db_mysql = mysqli_connect($db_server, $db_user, $db_pass, $db_database);

if(!$db_mysql )
{
  echo "Could not connect 1 ".  mysqli_connect_error();
 
}

// $db = $db_mysql;

// @mysqli_select_db($db,$db_database);

// function pass_gen($len) {
//     $len = $len/5;
//     $pass = '';
//     srand((float) microtime() * 10000000);
//     for ($i = 0; $i < $len; $i++) {
//         $pass .= chr(rand(48, 57)); // 0-9
//         $pass .= chr(rand(65, 90)); // A-Z
//         $pass .= chr(rand(97, 122)); // a-z
//         $pass .= chr(rand(97, 122)); // a-z
//         $pass .= chr(rand(48, 57)); // 0-9
//         $pass .= chr(rand(97, 122)); // a-z
//     }
//     return $pass;
// }

// $query= "select * from sysconnect";
// $result = mysqli_query($db, $query);

// $rw = mysqli_fetch_array($result);

//  $orauser = $rw['dbuser'];
//  $orapass = $rw['dbpass'];
//  $orasrv = $rw['dbserver'];
//  $oradb = $rw['dbname'];
//  $authtoken = $rw['endpoint'];
//  $defaultlang = $rw['defaultlang'];
//  $shortname = $rw['shortname'];
//  $basic = $rw['basic'];
// $shortnumber = $rw['ussdsc'];
// $appname = $rw['appname'];
// $thebankname = $thebank =  $rw['shortname'];
// $momotoken = $rw['momotoken'];
?>
