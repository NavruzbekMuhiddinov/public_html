<?php 

/* 
mysqli method syntax 

mysqli_connect(host, username, password, dbname)
------------------------------------------------
*/

$host = "localhost";
$username = "interpub_ilmiysmartbot";
$password = "ilmiysmartbot" ;
$dbname = "interpub_ilmiysmartbot";

global $dbConnect;

$dbConnect = mysqli_connect($host, $username, $password, $dbname);

// if(!$dbConnect){
//     echo 'Connection error: ' . mysqli_connect_error();
// } else {
//     echo 'Database Connection Successful !!';
// }

?>