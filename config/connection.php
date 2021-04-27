<?php
require_once("config.php");

try{
    $konekcija=new PDO("mysql:host=".SERVER.";dbname=".DATABASE,USERNAME,PASSWORD);
    $konekcija->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
}catch(PDOException $e){
    echo $e->getMessage();
}


function izvrsiUpit($upit){
    global $konekcija;
    $priprema=$konekcija->query($upit)->fetchAll();
    return $priprema;
}

function pristupStranici(){
    @$open=fopen(LOG_FAJL,"a");
    if($open){
        $date=date("d-m-Y H:i:s");
        @fwrite($open,"{$_SERVER['REQUEST_URI']}\t{$date}\t{$_SERVER['REMOTE_ADDR']}\t\n");
        @fclose($open);
    }
}
function upisGresaka($greska){
    @$open=fopen(GRESKE_FAJL,"a");
    $upis=$greska."\t".date("d-m-Y H:i:s")."\n";
    @fwrite($open,$upis);
    @fclose($open);
}
// function provera(){
//     echo "Vidi funkciju iz konekcije";
// }
?>