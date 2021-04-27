<?php
function mejlovi(){
    return izvrsiUpit("SELECT * FROM email");
}
function email($idEmail){
    global $konekcija;
    $priprema=$konekcija->prepare("SELECT * FROM email WHERE idEmail=:idEmail");
    $priprema->bindParam(":idEmail",$idEmail);
    $priprema->execute();
    return $priprema->fetch();
}
function procitaniMejlovi(){
    return izvrsiUpit("SELECT * FROM email WHERE procitan=1");
}
function neprocitani(){
    return izvrsiUpit("SELECT * FROM email WHERE procitan=0");
}
function procitan($idEmail){
    global $konekcija;
    $pripremi=$konekcija->prepare("UPDATE email SET procitan=1 WHERE idEmail=:idEmail");
    $pripremi->bindParam(":idEmail",$idEmail);
    return $pripremi->execute();
}
function unosPoruke($email,$svrha,$poruka){
    global $konekcija;
    $datum=date("Y-m-d H:i:s");
    $pripremi=$konekcija->prepare("INSERT INTO email (email,poruka,svrha,datum,procitan) VALUES(:email,:poruka,:svrha,:datum,0)");
    $pripremi->bindParam(":email",$email);
    $pripremi->bindParam(":svrha",$svrha);
    $pripremi->bindParam(":poruka",$poruka);
    $pripremi->bindParam(":datum",$datum);
    return $pripremi->execute();
}
function izbrisi($idEmail){
    global $konekcija;
    $pripremi=$konekcija->prepare("DELETE FROM email WHERE idEmail=:idEmail");
    $pripremi->bindParam(":idEmail",$idEmail);
    return $pripremi->execute();
}
?>