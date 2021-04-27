<?php
session_start();
ob_start();
if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge==="admin"){
    if(isset($_POST["idEmail"])){
        require_once("../../config/connection.php");
        require_once("functions.php");
        $idEmail=$_POST["idEmail"];
        $kod=404;
        try{
            if(izbrisi($idEmail)){
                $kod=201;
                header("Location:".URL."/index.php?page=email&obaveštenje=Izbrisan");
            }else{
                $kod=500;
                header("Location:".URL."/index.php?page=email");
            }
        }catch(PDOException $ex){
            $kod=500;
            $podaci=["greska"=>$ex->getMessage()];
            upisGresaka($ex->getMessage());
        }
        http_response_code($kod);
    }
}
?>