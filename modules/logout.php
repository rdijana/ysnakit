<?php
session_start();
ob_start();
require_once("../config/config.php");
require_once("functions.php");
brisiUlogovane($_SESSION["korisnik"]->idKorisnik);
unset($_SESSION["korisnik"]);
// session_destroy();
header("Location:../index.php?page=login");
?>
