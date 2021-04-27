<?php
if(isset($_SESSION["korisnik"]) && $_SESSION["korisnik"]->nazivUloge==="admin"):
    require_once("modules/korisnici/functions.php");
?>
<div class="container mt-5 pt-5 mb-5" id="tabelaSaKorisnicima">

</div>
<div class="row d-flex justify-content-center mx-0 px-0">
<div class="col-md-4 mx-0" id="podaciKorisnik">
<form method="POST" action="modules/korisnici/azuriraj.php">
<div class="form-group">
<input type="text" name="tbIme" id="tbIme" placeholder='Ime' class='form-control'>
</div>
<div class="form-group">
<input type="text" name="tbPrezime" id="tbPrezime" placeholder='Prezime' class='form-control'>
</div>
<div class="form-group">
<input type="text" name="tbKorisnickoIme" id="tbKorisnickoIme" placeholder='Korisničko ime' class='form-control'>
</div>
<div class="form-group">
<input type="text" name="tbEmail" id="tbEmail" placeholder='Email' class='form-control'>
</div>

<div class="form-group">
<select name='ddlUloga' id='ddlUloga' class=form-control>
<option value='0'>Izaberite</option>
<?php

$uloge=uloge();

foreach ($uloge as $uloga):?>
<option value="<?=$uloga->idUloga?>"><?=$uloga->naziv?></option>
<?php endforeach;

?>
</select>
</div>
<div class="form-group">
<input type="date" name="datum" id="datum" class=form-control>
</div>
<div class="form-group">
<input type="password" name="tbLozinka" id="tbLozinka" placeholder='Lozinka' class='form-control'>
</div>
<div class="radio">
<label><input type="radio" name="pol" value="M">Muski</label><br/>
</div>
<div class="radio">
<label><input type="radio" name="pol" value="Z">Zenski</label><br/>
</div>
<div class="form-group">
<input type="hidden" name="idKorisnika" id="idKorisnika" class=form-control>
<label>Aktivan korisnik da / ne </label>&nbsp;
<input type="checkbox" name="chbAktivan" id="chbAktivan" value='1'>
</div>
<input type="submit" value="Ažuriraj" name='btnAzuriraj' id='btnAzuriraj' class="btn btn-outline-secondary">
<input type="button" value="Skloni" id='skloni' class="btn btn-outline-secondary">
</form>

</div>
<!--<div class="container mx-auto mb-5 mt-3"><a href="modules/korisnici/exportToExcel.php" class="btn btn-outline-secondary">Export to excel</a></div>-->
</div>
<div class="container odgovorUpdate">
    <div class="row d-flex justify-content-center">
        <div class="col-5">
<?php if(isset($_SESSION['greske'])):
$greskeUnos=$_SESSION['greske'];
$broj=0;
foreach($greskeUnos as $jednaGreska){
    $broj++;
echo "$broj"."<p>$jednaGreska</p>";
}
unset($_SESSION['greske']);

endif; ?>
<?php
if(isset($_SESSION['poruka'])):
   echo $_SESSION['poruka'];
    
    unset($_SESSION['poruka']);
    
    endif;
?>
        </div>
</div>
</div>
<?php endif;?>
