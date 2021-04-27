<?php
session_start();
ob_start();
header("Content-type:application/json");
if(isset($_SESSION["korisnik"])){
    require_once("../../config/connection.php");
    require_once("functions.php");
    $podaci=null;
    $kod=404;
    try{
        $podaci=dohvatiProizvode();
        $kod=201;
    }catch(PDOException $ex){
        $kod=500;
        $podaci=["greske"=>$ex->getMessage()];
        upisGresaka($e->getMessage());
    }
    http_response_code($kod);
    echo json_encode($podaci);
}
?>