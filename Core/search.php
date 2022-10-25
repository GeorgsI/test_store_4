<?php
include_once('settings.php');
include_once('ConnectDB.php');

$expressions = explode(" ", $_POST['searchField']);
$countWords = count($expressions);
$arr = [];

$expCount = 0;


$sqlSearch = "SELECT * FROM `goods` WHERE".implode(" ", $arr) ;

$sqlSearch .= "SELECT * FROM `goods` WHERE";

foreach($expressions as $value){
    
    $expCount++;
    if($expCount < $countWords){ 
        $sqlSearch .= "CONCAT(`title_goods`,`YN`) LIKE '#".$value."#' OR ";
    }
    else{
         $sqlSearch .= "CONCAT(`title_goods`,`YN`) LIKE '#".$value."#'";
    }
    
}



echo $sqlSearch;


$con = new ConnectDB(HOST, USER, PASSWORD ,DATABASE, CHARSET);
$tr = $con->read($sqlSearch);
var_dump($tr);

