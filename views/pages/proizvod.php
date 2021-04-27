
<?php
pristupStranici();
if(isset($_GET["id"])):
// require_once("../../config/config.php");
include(ABSOLUTE_PATH."modules/proizvodi/functions.php");
// require_once("../../modules/proizvodi/functions.php");
$proizvod=dohvatiProizvod($_GET["id"]);
// provera();
?>
<div class="col-12 mt-5 pt-5" id="proizvod">
<div class="row d-flex justify-content-around">
    <div class="col-md-5 col-8">
    <img src="<?=$proizvod->slikaOrg?>" class="img-fluid greska border" alt="<?=$proizvod->naziv?>"/>
    </div>
    <div class="col-md-5 col-8 pt-3 mt-5">
    <h5 class="pb-3"><?=$proizvod->naziv?></h5>
    <p><b>Cena: </b> <?=$proizvod->cena?> RSD</p>
    <?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->nazivUloge=="korisnik"): ?>
    <p><b>Sastav:</b> <?=$proizvod->sastav?></p>
    <p><b>Kontaktirajte nas:</b> <a href="index.php?page=kontakt" class="btn btn-outline-secondary">Kontakt</a></p>
<p>Proizvod se može pazariti samo u našoj YS radnji.</p>
 <?php elseif(!isset($_SESSION['korisnik'])):echo("<p>Ako zelite da vidite detalje registrujte se</p>"); endif;?>
    </div>
</div>
</div>
<?php
endif;
?>

