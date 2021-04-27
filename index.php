<?php
session_start();
ob_start();

require_once("config/connection.php");
require_once("modules/functions.php");
require_once("views/fixed/head.php");
require_once("views/fixed/meni.php");
if(isset($_GET["page"])){
//    echo "Ima str";
    $strana=$_GET["page"];
    switch($strana){
        case "pocetna":
            require_once("views/fixed/slajder.php");
            require_once("views/fixed/pocetna.php");
            break;
        case "proizvodi":
            require_once("views/pages/proizvodi.php");
            break;
        case "kontakt":
            require_once("views/pages/kontakt.php");
            break;
        case "registracija":
            require_once("views/pages/registracija.php");
            break;
        case "login":
            require_once("views/pages/login.php");
            break;
        case "admin-proizvodi":
            require_once("views/pages/admin/adminProizvodi.php");
            break;
        case "unos-proizvoda":
            require_once("views/pages/admin/unosProizvoda.php");
            break;
        case "korisnici":
            require_once("views/pages/admin/korisnici.php");
            break;
        case "unos-korisnika":
            require_once("views/pages/admin/unosKorisnika.php");
            break;
        case "email":
            require_once("views/pages/admin/email.php");
            break;
        case "pristup-stranicama":
            require_once("views/pages/admin/pristup.php");
            break;
        case "proizvod":
            require_once("views/pages/proizvod.php");
            break;
        case "autor":
            require_once("views/fixed/autor.php");
            break;
        default:
            require_once("views/fixed/pocetna.php");
            break;
    }
}else{
    require_once("views/fixed/slajder.php");
    require_once("views/fixed/pocetna.php");
}
require_once("views/fixed/futer.php");
?>