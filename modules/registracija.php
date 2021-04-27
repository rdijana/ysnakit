<?php
ob_start();
if(isset($_POST["dugme"])){
    require_once("../config/connection.php");
    header("Content-type:application/json");
    require_once("functions.php");
    $ime=$_POST["ime"];
    $prezime=$_POST["prezime"];
    $korisnickoIme=$_POST["korisnickoIme"];
    $email=$_POST["email"];
    $lozinka=$_POST["lozinka"];
    $pol=isset($_POST["pol"])?$_POST["pol"]:null;

    $greske=[];
    $kod=404;
    $poruka="";
    //regularni poklapanje sa bazom
    $reIme="/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,19}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,19})*$/";
    $rePrezime="/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,29}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,29})*$/";
    $reKorisnickoIme="/^[\w\d\.\-\_\&]{5,60}$/";
    $reLozinka="/^[\d\w\.\_\-\*\/]{6,40}$/";
    $reEmail="/^[a-z][a-z\d\.\-\_]+\@[a-z\d]+(\.[a-z]{2,4})+$/";

    if(!preg_match($reIme,$ime)){
        array_push($greske,"Ime nije u dobrom formatu");
    }
    if(!preg_match($rePrezime,$prezime)){
        array_push($greske,"Prezime nije u dobrom formatu");
    }
    if(!preg_match($reKorisnickoIme,$korisnickoIme)){
        array_push($greske,"Korisnicko ime nije u dobrom formatu");
    }
    if(!preg_match($reEmail,$email)){
        array_push($greske,"Email nije u dobrom formatu");
    }
    if(!preg_match($reLozinka,$lozinka)){
        array_push($greske,"Lozinka nije u dobrom formatu");
    }
    if(empty($pol)){
        array_push($greske,"Izaberite pol");
    }
    if(count($greske)){
        $poruka=$greske;
        $kod=422;
    }else{
        $lozinka=md5($lozinka);
        try{
            if(unosKorisnika($ime,$prezime,$email,$korisnickoIme,$lozinka,$pol)){
                //upisalo se u bazu
                $kod=201;
            }else{
                $kod=500;
            }
        }catch(PDOException $ex){
            $kod=409;
            upisGresaka($ex->getMessage());
        }
    }
    http_response_code($kod);
    echo json_encode($poruka);
}
?>