<?php
function dohvatiKategorije(){
return izvrsiUpit("SELECT * FROM kategorija");
}
function dohvatiProizvod($idProizvoda){
    global $konekcija;
    $priprema=$konekcija->prepare("SELECT * FROM proizvod WHERE idProizvod=:idProizvod");
    $priprema->bindParam(":idProizvod",$idProizvoda);
    $priprema->execute();
    return $priprema->fetch();
}
function dohvatiProizvode(){
    return izvrsiUpit("SELECT p.*,k.naziv AS nazivKategorija FROM proizvod p INNER JOIN kategorija k ON p.idKategorija=k.idKategorija");
}
function ukupnoProizvoda(){
    global $konekcija;
    return $konekcija->query("SELECT COUNT(*) AS brojProizvoda FROM proizvod")->fetch();
}
function brojPoKategorijama($idKat){
global $konekcija;
$priprema=$konekcija->prepare("SELECT COUNT(*) AS brojProizvoda FROM proizvod WHERE idKategorija=:idKategorija");
$priprema->bindParam(":idKategorija",$idKat);
$priprema->execute();
return $priprema->fetch();
}
function search($naziv){
global $konekcija;
$priprema=$konekcija->prepare("SELECT * FROM proizvod WHERE naziv LIKE UPPER(?)");
//? brzi nacin bez bindParam
$priprema->execute([$naziv]);
return $priprema->fetchAll();
}
function unosProizvoda($naziv,$sastav,$cena,$slikaOrg,$slikaNap,$idKategorija){
    global $konekcija;
    $upit="INSERT INTO proizvod(naziv,sastav,cena,slikaOrg,slikaNap,idKategorija) VALUES (:naziv,:sastav,:cena,:slikaOrg,:slikaNap,:idKategorija)";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":naziv",$naziv);
    $priprema->bindParam(":sastav",$sastav);
    $priprema->bindParam(":cena",$cena);
    $priprema->bindParam(":slikaOrg",$slikaOrg);
    $priprema->bindParam(":slikaNap",$slikaNap);
    $priprema->bindParam(":idKategorija",$idKategorija);
    return $priprema->execute();

}
?>