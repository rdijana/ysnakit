<?php
ob_start();
header("Content-type:application/json");
$podaci=null;
$kod=404;
if(isset($_POST["dugme"])){
    require_once("../../config/connection.php");
    require_once("functions.php");
    $unos=trim($_POST["unos"]);
    $unos="%$unos%";
    try{
        $kod=201;
        $podaci=search($unos);
    }catch(PDOException $ex){
        $kod=500;
        $podaci=["greske"=>$ex->getMessage()];
        upisGresaka($ex->getMessage());
    }
}
http_response_code($kod);
echo json_encode($podaci);
?>