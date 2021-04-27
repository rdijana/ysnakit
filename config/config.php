<?php
define("ABSOLUTE_PATH",$_SERVER["DOCUMENT_ROOT"]."/");
define("URL","https://ysnakit.000webhostapp.com");

define("ENV_FAJL",ABSOLUTE_PATH."config/.env");
define("LOG_FAJL",ABSOLUTE_PATH."data/log.txt");
define("LOGIN_FAJL",ABSOLUTE_PATH."data/login.txt");
define("GRESKE_FAJL",ABSOLUTE_PATH."data/greske.txt");

define("SERVER",env("SERVER"));
define("DATABASE",env("DBNAME"));
define("USERNAME",env("USERNAME"));
define("PASSWORD",env("PASSWORD"));

define("EMAIL",env("EMAIL"));
define("SIFRA",env("SIFRA"));

function env($naziv){
    $podaci=file(ENV_FAJL);
    $vred="";
    foreach($podaci as $key=>$value){
        $konfig=explode("=",$value);
        if($konfig[0]==$naziv){
            $vred=trim($konfig[1]);
        }
    }
    return $vred;
}
?>