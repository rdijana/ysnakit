<?php
session_start();
ob_start();
header("Content-type:application/json");
if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge==="admin"){
    if(isset($_POST["idEmail"])){
        require_once("../../config/connection.php");
        require_once("functions.php");

        $idEmail=$_POST["idEmail"];
        $podaci=null;
        $kod=404;

        try{
            $podaci=email($idEmail);
            $kod=201;
        }catch(PDOException $ex){
            $kod=500;
            $podaci=["greska"=>$ex->getMessage()];
            upisGresaka($ex->getMessage());
        }
    }
    http_response_code($kod);
    echo json_encode($podaci);
}
?>