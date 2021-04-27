<?php
session_start();
ob_start();
if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge==="admin"):
        require_once("../../config/connection.php");
        $idKorisnik=$_POST["idKorisnika"];
        $ime=$_POST["tbIme"];
        $prezime=$_POST["tbPrezime"];
        $korisnickoIme=$_POST["tbKorisnickoIme"];
        $email=$_POST["tbEmail"];
        $lozinka=$_POST["tbLozinka"];
        $pol=isset($_POST["pol"])?$_POST["pol"]:null;
        $aktivan=isset($_POST["chbAktivan"])?$_POST["chbAktivan"]:0;
        $datum=$_POST["datum"];
        $idUloga=$_POST["ddlUloga"];

        $greske=[];

        $reIme="/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,19}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,19})*$/";
        $rePrezime="/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,29}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,29})*$/";
        $reKorisnickoIme="/^[\d\wšđčćž\.\-\_\&]{5,60}$/";
        $reLozinka="/^[\d\w\.\_\-\*\/]{6,40}$/";
        $reEmail="/^[a-z][a-z\d\.\-\_]+\@[a-z\d]+(\.[a-z]{2,4})+$/";


        //DATUM FORMAT KAO U BAZI
        $datumEx=explode("-",$datum);
        $timestamp=mktime(0,0,0,$datumEx[1],$datumEx[2],$datumEx[0]);
        $datumBaza=date("Y-m-d H:i:s",$timestamp);

        if(!preg_match($reIme,$ime)){
            array_push($greske,"Ime nije u dobrom formatu.Ime mora početi velikim slovom minimalan broj karaktera je 3 a maksimalan 20 po imenu.");
        }
        if(!preg_match($rePrezime,$prezime)){
            array_push($greske,"Prezime nije u dobrom formatu.Prezime mora početi velikim slovom minimalan broj karaktera je 3 a maksimalan 20 po prezimenu.");
        }
        if(!preg_match($reKorisnickoIme,$korisnickoIme)){
            array_push($greske,"Korisničko ime nije u dobrom formatu.Mininalan broj karaktera je 5 a maksimalan 60.Može sadržati samo mala slova");
        }
        if(!preg_match($reEmail,$email)){
            array_push($greske,"Email nije u dobrom formatu.Primer dijana.radovanovic.10.18@ict.edu.rs");
        }
        if(empty($pol)){
            array_push($greske,"Izaberite pol");
        }
        if(empty($idUloga)){
            array_push($greske,"Izaberite ulogu korisnika");
        }
        if(!preg_match($reLozinka,$lozinka)){
            array_push($greske,"Lozinka nije u dobrom formatu.Minimalan broj karaktera je 6.");
        }
        if(count($greske)){
            $_SESSION["greske"]=$greske;
        }else{
        
                $lozinkaS=md5($lozinka);
                $upit="UPDATE korisnik SET idKorisnik=:idKorisnik,ime=:ime,prezime=:prezime,email=:email,korisnicko_ime=:korisnickoIme,lozinka=:lozinka,pol=:pol,datum_registracije=:datum,aktivan=:aktivan,idUloga=:idUloga WHERE idKorisnik=:idKorisnik";
                $pripremi=$konekcija->prepare($upit);
                $pripremi->bindParam(":idKorisnik",$idKorisnik);
                $pripremi->bindParam(":ime",$ime);
                $pripremi->bindParam(":prezime",$prezime);
                $pripremi->bindParam(":email",$email);
                $pripremi->bindParam(":lozinka",$lozinkaS);
                $pripremi->bindParam(":korisnickoIme",$korisnickoIme);
                $pripremi->bindParam(":pol",$pol);
                $pripremi->bindParam(":aktivan",$aktivan);
                $pripremi->bindParam(":datum",$datumBaza);
                $pripremi->bindParam(":idUloga",$idUloga); 
                if($pripremi->execute()){
                    $_SESSION["poruka"]="Korisnik je ažuriran.";
                }else{
                    $_SESSION["poruka"]="Greška!";
                }             
                }
                header("Location:../../index.php?page=korisnici");
            
    
endif;

?>