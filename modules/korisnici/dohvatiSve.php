<?php
session_start();
ob_start();
header("Content-type:application/json");
if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge==="admin"):
    require_once("../../config/connection.php");
    require_once("functions.php");
    $podaci=null;
    $kod=404;
    try{
        $podaci=korisnici();
        $kod=201;
    }catch(PDOException $ex){
$podaci=["greska"=>$ex->getMessage()];
$kod=500;
upisGresaka($e->getMessage());
    }
    echo json_encode($podaci);
    http_response_code($kod);
endif;
?>