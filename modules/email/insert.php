<?php
session_start();
ob_start();
if(isset($_POST["dugme"])){
    $email=$_POST["email"];
    $svrha=$_POST["svrha"];
    $poruka=$_POST["poruka"];
    require_once("../../config/connection.php");
    require_once("functions.php");
    $kod=404;
    $podaci=null;
    $ispisGresaka="";
    $greske=[];

    $reEmail="/^[a-z][a-z\d\.\-\_]+\@[a-z\d]+(\.[a-z]{2,4})+$/";
    $reSvrha="/^[\d\w\-\.]{5,50}$/";

    if(!preg_match($reEmail,$email)){
        array_push($greske,"Email nije u dobrom formatu");
    }
    if(!preg_match($reSvrha,$svrha)){
        array_push($greske,$svrha);
    }
    if($poruka==""){
        array_push($greske,"Unesite poruku!");
    }
    if(count($greske)){
        foreach($greske as $greska){
            $ispisGresaka+=$greska."<br/>";
        }
        $kod=422;
        $podaci=["greska"=>$ispisGresaka];
    }else{
        try{
            if(unosPoruke($email,$svrha,$poruka)){
                $kod=200;
            }else{
                $kod=500;
            }
        }catch(PDOException $ex){
            $kod=409;
            $podaci=["greska"=>$ex->getMessage()];
            upisGresaka($ex->getMessage());
        }
    }
    http_response_code($kod);
    echo json_encode($podaci);
}
?>