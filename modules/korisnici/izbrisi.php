<?php
session_start();
ob_start();
if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge==="admin"):
if(isset($_POST["idKorisnika"])){
    $idKorisnika=$_POST["idKorisnika"];
    $kod=404;
    require_once("../../config/connection.php");
    require_once("functions.php");
    try{
        if(izbrisiKorisnika($idKorisnika)){
            $kod=201;
        }else{
            $kod=500;
        }
    }catch(PDOException $ex){
        $kod=409;
        upisGresaka($ex->getMessage());
    }
    http_response_code($kod);
}
endif;
?>