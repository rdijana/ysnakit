<?php
ob_start();
header("Content-type:application/json");
if(isset($_POST["id"])){
require_once("../../config/connection.php");
require_once("functions.php");
$podaci=null;
$kod=404;
$idProizvoda=$_POST["id"];
try{
if($idProizvoda!=0){
    $podaci=brojPoKategorijama($idProizvoda);
}else{
    $podaci=ukupnoProizvoda();
}
$kod=201;
}catch(PDOException $ex){
    $podaci=["greske"=>$ex->getMessage()];
    upisGresaka($ex->getMessage());
    $kod=500;
}
}
echo json_encode($podaci);
http_response_code($kod);
?>