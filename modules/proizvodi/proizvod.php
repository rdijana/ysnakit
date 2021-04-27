<?php
session_start();
ob_start();
header("Content-type:application/json");
if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge==="admin"){
    if(isset($_POST["idProizvoda"])){
        $idProizvoda=$_POST["idProizvoda"];
        require_once("../../config/connection.php");
        require_once("functions.php");
        $kod=404;
        $podaci=null;
        try{
            $podaci=dohvatiProizvod($idProizvoda);
            $kod=201;
        }catch(PDOException $ex){
            $kod=500;
            $podaci=["greska"=>$e->getMessage()];
            upisGresaka($ex->getMessage());
        }
        http_response_code($kod);
        echo json_encode($podaci);
    }
}
?>