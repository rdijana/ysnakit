<?php
function meni(){
    global $konekcija;
    $upit="SELECT * FROM meni WHERE idRoditelja IS NULL ";
    $podaci=$konekcija->query($upit)->fetchAll();
    $ispis="<ul  class=\"navbar-nav\" id=\"meni\">";
    foreach($podaci as $podatak){
      if($podatak->naziv=="Registracija"){
          if(isset($_SESSION["korisnik"])){
              continue;
          }
      }
      if($podatak->naziv=="Login"){
          if(isset($_SESSION["korisnik"])){
              continue;
          }
      }
      if($podatak->naziv=="Logout"){
          if(!isset($_SESSION["korisnik"])){
              continue;
          }
      }
      if($podatak->naziv=="Admin"){
          if(!isset($_SESSION["korisnik"])){
              continue;
          }elseif($_SESSION["korisnik"]->nazivUloge==="korisnik"){
              continue;
          }
      } 
    if($podatak->naziv=="Kontakt"){
        if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge==="admin"){
            continue;
    }
    } 
      $ispis.="<li class='nav-item'><a href=\"$podatak->putanja\" class=\"nav-link\">$podatak->naziv</a>";
      $ispis.=podmeni($podatak->idMeni,$konekcija);
      $ispis.="</li>";
    }
$ispis.="</ul>";
return $ispis;
}
function podmeni($idRoditelja,$konekcija){
    $html="";
    $upit="SELECT * FROM meni WHERE idRoditelja=:idRoditelja";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":idRoditelja",$idRoditelja);
    $priprema->execute();
    if($priprema->rowCount()>0){
        $podaci=$priprema->fetchAll();
        $html.="<ul class='podMeni'>";
        foreach($podaci as $podatak){
            $html.="<li class='nav-item'><a href='$podatak->putanja' class=\"nav-link\">$podatak->naziv</a></li>";
        }
        $html.="</li>";
        $html.="</ul>";
    }
    return $html;
}
function autor(){
    return izvrsiUpit("SELECT * FROM autor WHERE idAutor=1");
}
function ikoniceFuter(){
    return izvrsiUpit("SELECT * FROM futer");
}
function stranice(){
    return ["Početna","Kontakt","Autor","Registracija","Login","Proizvodi","Proizvod"];
}
function procenatPristupa(){
    $koliko=[];
    $ukupno=0;
    $pocetna=0;
    $kontakt=0;
    $autor=0;
    $registracija=0;
    $login=0;
    $proizvodi=0;
    $proizvod=0;

    $dayAgo=strtotime("1 day ago");

    $fajl=file(LOG_FAJL);
    if(count($fajl)){
     foreach($fajl as $f){
         $delovif=explode("\t",$f);
         $url=explode(".php",$delovif[0]);
         $url[1] = isset($url[1]) ? $url[1] : null;
         $strana=explode("&",$url[1]);
         
        //  echo $url[1];
        //echo $strana[0];
    //var_dump($delovif);
        //  var_dump($url);
        //   var_dump($strana);
         if(strtotime($delovif[1])>=$dayAgo){
             switch($strana[0]){
                 case "":
                    $pocetna++;
                    $ukupno++;
                    break;
                case "?page=pocetna":
                    $pocetna++;
                    $ukupno++;
                break;
                case "?page=kontakt":
                    $kontakt++;
                    $ukupno++;
                break;
                case "?page=autor":
                    $autor++;
                    $ukupno++;
                break;
                case "?page=registracija":
                    $registracija++;
                    $ukupno++;
                break;
                case "?page=login":
                    $login++;
                    $ukupno++;
                break;
                case "?page=proizvodi":
                    $proizvodi++;
                    $ukupno++;
                break;
                case "?page=proizvod":
                    $proizvod++;
                    $ukupno++;
                break;
                default:
                $pocetna++;
                $ukupno++;
            break;

             }
         }
     }
     if($ukupno>0){
         $koliko[]=round($pocetna*100/$ukupno,2);
         $koliko[]=round($kontakt*100/$ukupno,2);
         $koliko[]=round($autor*100/$ukupno,2);
         $koliko[]=round($registracija*100/$ukupno,2);
         $koliko[]=round($login*100/$ukupno,2);
         $koliko[]=round($proizvodi*100/$ukupno,2);
         $koliko[]=round($proizvod*100/$ukupno,2);
     }
    }
    return $koliko;
}
function ulogovani($idKorisnika){
    @$open=fopen(LOGIN_FAJL,"a");
    $ulogovan=$idKorisnika."\n";
    @fwrite($open,$ulogovan);
    @fclose($open);
}
function brUlogovanih(){
    return count(file(LOGIN_FAJL));
}
function brisiUlogovane($idKorisnika){
    $idKorisnika=(int)$idKorisnika;
    $upisi="";
    @$fajl=file(LOGIN_FAJL);
    if(count($fajl)){
        foreach($fajl as $f){
            $id=trim((int)$f);
            if($id!=$idKorisnika){
                $upisi.=$iId."\n";
            }
        }
    }
    @$open=fopen(LOGIN_FAJL,"w");
    @fwrite($open,$upisi);
    @fclose($open);
}
function unosKorisnika($ime,$prezime,$email,$korisnickoIme,$lozinka,$pol){
    global $konekcija;
    $upit="INSERT INTO korisnik (ime,prezime,email,korisnicko_ime,lozinka,pol,aktivan,idUloga) VALUES (:ime,:prezime,:email,:korisnickoIme,:lozinka,:pol,1,2)";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":ime",$ime);
    $priprema->bindParam(":prezime",$prezime);
    $priprema->bindParam(":email",$email);
    $priprema->bindParam("korisnickoIme",$korisnickoIme);
    $priprema->bindParam(":lozinka",$lozinka);
    $priprema->bindParam(":pol",$pol);
    return $priprema->execute();
}
?>