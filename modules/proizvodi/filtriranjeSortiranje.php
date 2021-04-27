<?php
ob_start();
header("Content-type:application/json");

$podaci=null;
$kod=404;


if(isset($_POST["dugme"])){
    require_once("../../config/connection.php");

    $idKategorije=$_POST["idKategorije"];
    $idZaSort=$_POST["idZaSort"];
    $strana=($_POST["id"]-1)*4;

    $upit="SELECT * FROM proizvod ";

    if($idKategorije!="0"){
        $upit.="WHERE idKategorija=:idKategorija ORDER BY ";
    }else{
        $upit.=" ORDER BY ";
    }

    if($idZaSort=='1'){
        $upit.=" cena, ";
    }elseif($idZaSort=='2'){
        $upit.=" cena DESC, ";
    }
    $upit.="datum ASC LIMIT 4 OFFSET $strana";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":idKategorija",$idKategorije);

    try{
        if($priprema->execute()){
            //vracamo nakit obradjen
            $podaci=$priprema->fetchAll();
            $kod=201;
        }else{
            $kod=500;
        }
    }catch(PDOException $ex){
        $kod=500;
        $podaci=["greske"=>$ex->getMessage()];
        upisGresaka($upit);
    }
}
http_response_code($kod);
echo json_encode($podaci);
    
?>