<?php
session_start();
ob_start();
if(isset($_SESSION["korisnik"])&& $_SESSION["korisnik"]->nazivUloge==="admin"):
    if(isset($_POST["btnUnos"])):
        require_once("../../config/connection.php");
        require_once("functions.php");

        $dozvoljeniFormatiSlike=["image/jpeg","image/jpg","image/png","image/gif"];
        $file=$_FILES["slika"];
        $size=$file["size"];
        $type=$file["type"];
        $tmpName=$file["tmp_name"];

        $fileName=$file["name"];
        $novo=time()."-".$fileName;
        $putanja="../../assets/images/".$novo;
        $putanjaZaBazu="assets/images/".$novo;
        $putanjaZaBazuNova=$putanjaZaBazu."-nova";
        $novaPutanja="../../".$putanjaZaBazuNova;


        $nazivProizvoda=$_POST["tbNaziv"];
        $cena=$_POST["tbCena"];
        $sastav=$_POST["tbSastav"];
        $kategorija=$_POST["ddlKategorija"];

        $greske=[];

        $regNaziv="/^[\wŠĐČĆŽšđčćž\d\/\-\s]{5,50}$/";
        $regCena="/^[\d\,]{2,20}$/";
        $regSastav="/^[\d\wšđčćžŠĐČĆŽ\/\,\-\s\.]{5,40}$/";

        if(!preg_match($regNaziv,$nazivProizvoda)){
            array_push($greske,"Naziv proizvoda nije u dobrom formatu.Minimalan broj karaktera je 5 može početi bilo kojim slovom.");
        }
        if(!preg_match($regCena,$cena)){
            array_push($greske,"Cena nije u dobrom formatu.");
        }
        if(!preg_match($regSastav,$sastav)){
            array_push($greske,"Sastav nije u dobrom formatu.Minimalan broj karaktera je 5,maksimalan 40");
        }
        if($kategorija=="0"){
            array_push($greske,"Izaberite kategoriju.");
        }
        if(!in_array($type,$dozvoljeniFormatiSlike)){
            array_push($greske,"Tip fajla nije odgovarajući");
        }
        if($size>4000000){
            array_push($greske,"Veličina fajla prelazi ograničenje.");
        }
        if(count($greske)){
            $_SESSION["greskeUnos"]=$greske;
            header("Location:".URL."/index.php?page=unos-proizvoda");
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
            // $novaSirina=$sirina*$poY;

            $image=imagecreatetruecolor($novaSirina,$novaVisina);

            imagecopyresampled($image,$postojecaSlika,0,0,0,0,$novaSirina,$novaVisina,$sirina,$visina);

            if($novaSirina>$poX){
                $postojecaSlikaPomeranje=($novaSirina-$poX)/2;
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

            $upisUBazu=unosProizvoda($nazivProizvoda,$sastav,$cena,$putanjaZaBazu,$putanjaZaBazuNova,$kategorija);

            if($upisUBazu){
                imagedestroy($postojecaSlika);
                imagedestroy($slikaNova);
                $poruka="Uspešan unos!";
                header("Location:".URL."/index.php?page=unos-proizvoda&obaveštenje=$poruka");
            }
        }
    endif;
endif;
?>