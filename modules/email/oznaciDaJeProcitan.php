<?php
session_start();
ob_start();
if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge==="admin"){
    if(isset($_POST["idEmail"])){
        require_once("../../config/connection.php");
        require_once("functions.php");
        $idEmail=$_POST["idEmail"];
        $kod=404;
        $podaci=null;
        try{
            if(procitan($idEmail)){
                $kod=201;
            }else{
                $kod=500;
                $podaci=["greska"=>"Došlo je do greške!"];
            }
        }catch(PDOException $ex){
            $kod=500;
            $podaci=["greska"=>$ex->getMessage()];
            upisGresaka($ex->getMessage());
        }
        http_response_code($kod);
        echo json_encode($podaci);
    }
}
?>