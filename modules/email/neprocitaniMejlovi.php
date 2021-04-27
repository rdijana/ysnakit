<?php
session_start();
ob_start();
if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge==="admin"){
        require_once("../../config/connection.php");
        require_once("functions.php");
        $kod=404;
        $podaci=null;
        try{
            $podaci=neprocitani();
            $kod=201;
        }catch(PDOException $ex){
            $kod=500;
            $podaci=["greska"=>$ex->getMessage()];
            upisGresaka($ex->getMessage());
        }
        http_response_code($kod);
        echo json_encode($podaci);
    }
?>