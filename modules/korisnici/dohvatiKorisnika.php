<?php
session_start();
ob_start();
header("Content-type:application/json");
if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge==="admin"):
    header("Content-type:application/json");
    if(isset($_POST["idKorisnika"])){
        $idKorisnika=$_POST["idKorisnika"];
        require_once("../../config/connection.php");
        require_once("functions.php");
        $podaci=null;
        $kod=404;
        try{
            $podaci=korisnik($idKorisnika);
            $kod=201;
        }catch(PDOException $ex){
            $kod=500;
            $data=["greska"=>$e->getMessage()];
            upisGresaka($ex->getMessage());
        }
        echo json_encode($podaci);
        http_response_code($kod);
    }
endif;
?>