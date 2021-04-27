<?php
ob_start();
session_start();

if(isset($_POST["btnLogin"])){
    $email=$_POST["tbEmail"];
    $lozinka=$_POST["tbLozinka"];

    
    $reEmail="/^[a-z][a-z\d\.\-\_]+\@[a-z\d]+(\.[a-z]{2,4})+$/";
    $reLozinka="/^[\d\w\.\_\-\*\/]{6,40}$/";

    $greske=[];

    if(!preg_match($reEmail,$email)){
        array_push($greska,"Email nije u dobrom formatu");
    }
    if(!preg_match($reLozinka,$lozinka)){
        array_push($greska,"Lozinka nije u dobrom formatu");
    }

    if(count($greske)>0){
        $_SESSION["greskeLog"]=$greska;
        header("Location:../index.php?page=login");
    }else{
        require_once("../config/connection.php");
        require_once("functions.php");
        $lozinka=md5($lozinka);
        $upit="SELECT k.*,u.naziv AS nazivUloge FROM korisnik k INNER JOIN uloga u ON k.idUloga=u.idUloga WHERE k.email=:email AND k.lozinka=:lozinka AND k.aktivan=1";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":email",$email);
        $priprema->bindParam(":lozinka",$lozinka);
        $priprema->execute();
        if($priprema->rowCount()==1){
            $korisnik=$priprema->fetch();
            $_SESSION["korisnik"]=$korisnik;
            ulogovani($korisnik->idKorisnik);
            header("Location:../index.php?page=login"); 
        }else{
            $upit2="SELECT * FROM korisnik WHERE email=:email AND aktivan=1";
            $pripremi=$konekcija->prepare($upit2);
            $pripremi->bindParam(":email",$email);
            $pripremi->execute();
            if($pripremi->rowCount()==1){
                

                try{
                    $email=$email;
                    $naslov="Poruka sa sajta YS nakit";
 $poruka="Poštovani neko je pokušao da se uloguje na naš sajt sa vašim email-om.";
 $zaglavlje="From: https://ysnakit.000webhostapp.com";
 mail($email, $naslov, $poruka, $zaglavlje);


                }catch(Exception $ex){
                    echo $ex->getMessage();
                    upisGresaka($ex->getMessage());
                }
                $_SESSION["greske"]="Lozinka nije u dobrom formatu";
                header("Location:../index.php?page=login");
            }
         else{
             $_SESSION["greske"]="Prvo se registrujte.";
             header("Location:../index.php?page=login");
         }

        }
    }

}

?>