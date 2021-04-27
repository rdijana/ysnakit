<?php
function uloge(){
    return izvrsiUpit("SELECT * FROM uloga");
}
function korisnici(){
    return izvrsiUpit("SELECT k.*,u.naziv AS nazivUloge FROM korisnik k INNER JOIN uloga u ON k.idUloga=u.idUloga");
}
function korisnik($idKorisnik){
    global $konekcija;
    $pripremi=$konekcija->prepare("SELECT * FROM korisnik k INNER JOIN uloga u ON k.idUloga=u.idUloga WHERE idKorisnik=:idKorisnik");
    $pripremi->bindParam(":idKorisnik",$idKorisnik);
    $pripremi->execute();
    return $pripremi->fetch();
}
function izbrisiKorisnika($idKorisnik){
    global $konekcija;
    $pripremi=$konekcija->prepare("DELETE FROM korisnik WHERE idKorisnik=:idKorisnik");
    $pripremi->bindParam(":idKorisnik",$idKorisnik);
    return $pripremi->execute();
}
?>