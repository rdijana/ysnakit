<?php
session_start();
ob_start();
if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge==="admin"){
if(isset($_POST["btnAzurirajProizvod"])):
    require_once("../../config/connection.php");
    $idProizvoda=$_POST["idProizvoda"];
    $naziv=$_POST["tbNaziv"];
    $cena=$_POST["tbCena"];
    $sastav=$_POST["tbSastav"];
    $kategorija=$_POST["ddlKategorija"];
    $datum=$_POST["azDatum"];
    $datumRastavljen=explode("-",$datum);
    $timestamp=mktime(0,0,0,$datumRastavljen[1],$datumRastavljen[2],$datumRastavljen[0]);
    $datumBaza=date("Y-m-d H:i:s",$timestamp);

    $file=$_FILES["slikaProizvoda"];
    
    $greske=[];

        $regNaziv="/^[\wšđčćžŠĐČĆŽ\d\/\-\s]{5,50}$/";
        $regCena="/^[\d\,]{2,20}$/";
        $regSastav="/^[\w\dšđčćžŠĐČĆŽ\/\,\-\s\.]{5,40}$/";

    if(!preg_match($regNaziv,$naziv)){
        array_push($greske,"Naziv proizvoda nije u dobrom formatu.Ne mora početi velikim slovom minimalan broj karaktera je 6.");
    }
    if(!preg_match($regCena,$cena)){
        array_push($greske,"Cena nije u dobrom formatu.");
    }
    if(!preg_match($regSastav,$sastav)){
        array_push($greske,"Sastav nije u dobrom formatu.Minimalan broj karaktera je 5,a maksimalan 40.");
    }
    if(empty($kategorija)){
        array_push($greske,"Izaberite kategoriju.");
    }

    if($file["name"]==""){
        if(count($greske)){
            $_SESSION["greskeA"]=$greske;
            header("Location:../../index.php?page=admin-proizvodi");
        }else{
            $upit="UPDATE proizvod SET naziv=:naziv,sastav=:sastav,cena=:cena,datum=:datum,idKategorija=:idKategorija WHERE idProizvod=:idProizvod";
            $priprema=$konekcija->prepare($upit);
            $priprema->bindParam(":idProizvod",$idProizvoda);
            $priprema->bindParam(":naziv",$naziv);
            $priprema->bindParam(":sastav",$sastav);
            $priprema->bindParam(":cena",$cena);
            $priprema->bindParam(":datum",$datumBaza);
            $priprema->bindParam(":idKategorija",$kategorija);

            if($priprema->execute()){
                $_SESSION["azuriranjePoruke"]="Proizvod je ažuriran,bez slike.";
            }else{
                $_SESSION["azuriranjePoruke"]="Greška.";
            }
            header("Location:../../index.php?page=admin-proizvodi");
        }

    }else{
        $dozvoljeniFormatiSlike=["image/jpeg","image/jpg","image/png","image/gif"];
        $size=$file["size"];
        $type=$file["type"];
        $tmpName=$file["tmp_name"];

        $fileName=$file["name"];
        $novo=time()."-".$fileName;
        $putanja="../../assets/images/".$novo;
        $putanjaZaBazu="assets/images/".$novo;
        $putanjaZaBazuNova=$putanjaZaBazu."-nova";
        $novaPutanja="../../".$putanjaZaBazuNova;

       unlink("../../".$_POST["putanjaOriginal"]);
       unlink("../../".$_POST["putanjaNova"]);
       

       if(!in_array($type,$dozvoljeniFormatiSlike)){
        array_push($greske,"Tip fajla nije odgovarajući");
    }
    if($size>2000000){
        array_push($greske,"Veličina fajla prelazi ograničenje.");
    }
    if(count($greske)){
        $_SESSION["azuriranjePoruke"]=$greske;
        header("Location:../../index.php?page=admin-proizvodi");
    }elseif(move_uploaded_file($tmpName,$putanja)){
        $poX=350;
        $poY=350;

        list($sirina,$visina)=getimagesize($putanja);
        if($type=="image/jpeg"){
            $postojecaSlika=imagecreatefromjpeg($putanja);
        }elseif($type=="image/jpg"){
            $postojecaSlika=imagecreatefromjpeg($putanja);
        }elseif($type=="image/png"){
            $postojecaSlika=imagecreatefrompng($putanja);
        }

        $novaVisina=$poY;
        $novaSirina=$sirina*$poY/$visina;

        $image=imagecreatetruecolor($novaSirina,$novaVisina);

        imagecopyresampled($image,$postojecaSlika,0,0,0,0,$novaSirina,$novaVisina,$sirina,$visina);

        if($novaSirina>$poX){
            $postojecaSlikaPomeranje=($novaSirina-$pX)/2;
            $novaSlikaPomeranje=0;
        }elseif($novaSirina<$poX){
            $postojecaSlikaPomeranje=0;
            $novaSlikaPomeranje=($poX-$novaSirina)/2;
        }else{
            $postojecaSlikaPomeranje=0;
            $novaSlikaPomeranje=0;
        }
        $slikaNova=imagecreatetruecolor($poX,$poY);
        imagecopyresampled($slikaNova,$image,$novaSlikaPomeranje,0,$postojecaSlikaPomeranje,0,$poX,$poY,$poX,$poY);
        if($type=="image/jpeg"){
            imagejpeg($slikaNova,$novaPutanja);
        }elseif($type=="image/jpg"){
            imagejpeg($slikaNova,$novaPutanja);
        }elseif($type=="image/png"){
            imagepng($slikaNova,$novaPutanja);
        }

        $upit="UPDATE proizvod SET naziv=:naziv,sastav=:sastav,cena=:cena,slikaOrg=:slikaOrg,slikaNap=:slikaNap,datum=:datum,idKategorija=:idKategorija WHERE idProizvod=:idProizvod";
        $priprema=$konekcija->prepare($upit);
        $priprema->bindParam(":idProizvod",$idProizvoda);
        $priprema->bindParam(":naziv",$naziv);
        $priprema->bindParam(":sastav",$sastav);
        $priprema->bindParam(":cena",$cena);
        $priprema->bindParam(":slikaOrg",$putanjaZaBazu);
        $priprema->bindParam(":slikaNap",$putanjaZaBazuNova);
        $priprema->bindParam(":datum",$datumBaza);
        $priprema->bindParam(":idKategorija",$kategorija);

        if($priprema->execute()){
            $_SESSION["azuriranjePoruke"]="Proizvod je ažuriran,sa slikom.";
            imagedestroy($postojecaSlika);
            imagedestroy($slikaNova);
        }else{
            $_SESSION["azuriranjePoruke"]="Greška.";
        }
        header("Location:../../index.php?page=admin-proizvodi");
    }
    
    }
endif;
}

?>
