<?php
session_start();
ob_start();
if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge==="admin"){
    if(isset($_POST["idProizvoda"])){
        require("../../config/connection.php");
        $idProizvoda=$_POST["idProizvoda"];
        $kod=404;
        $upit="DELETE FROM proizvod WHERE idProizvod=:idProizvod";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":idProizvod",$idProizvoda);

        $postojeca="../../".$_POST["postojeca"];
        $nova="../../".$_POST["nova"];

        try{
            $izvrsenUpit=$priprema->execute();
            $kod=$izvrsenUpit?204:500;
            unlink($postojeca);
            unlink($nova);
        }catch(PDOException $ex){
            $kod=409;
            upisGresaka($ex->getMessage());
        }
        http_response_code($kod);
    }
}
?>