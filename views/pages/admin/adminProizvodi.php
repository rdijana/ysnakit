<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->nazivUloge==='admin'):
 require_once("modules/proizvodi/functions.php");
?>
 <div class="container" >
 <div class="row mt-5 pt-5" id="tabelaSaProizvodima">
 
 </div>

 </div>
 <div class="row mx-0 px-0">
 <div class="col-md-4 mx-auto" id="azurirajProizvod">
 <form method="POST" action="modules/proizvodi/azurirajProizvod.php" enctype='multipart/form-data'>
 <div class="form-group">
 <input type="text" name="tbNaziv" id="tbNaziv" placeholder='Naziv proizvoda' class='form-control'>
 </div>
 <img src="" style="width:30%" alt="" id="prikazSlike">
 <div class="form-group">
 <label>Slika proizvoda : &nbsp;</label> <input type="file" name="slikaProizvoda" id="slikaProizovda">
 </div>
 <input type="hidden" name="putanjaOriginal" id="putanjaOriginal" class=form-control>
 <input type="hidden" name="putanjaNova" id="putanjaNova" class=formcontrol>
 <div class="form-group">
 <input type="text" name="tbCena" id="tbCena" placeholder='Cena proizvoda' class='form-control'>
 </div>
 <div class="form-group">
 <input type="text" name="tbSastav" id="tbSastav" placeholder='Sastav proizvoda' class='form-control'>
 </div>
 <div class="form-group">
 <input type="date" name="azDatum" id="azDatum" class=form-control>
 <input type="hidden" name="idProizvoda" id="idProizvoda" class=form-control>
 </div>
 <label>Kategorija proizvoda : </label>
 <div class="form-group">
 <select name='ddlKategorija' id='ddlKategorija' class=form-control>
 <option value='0'>Izaberite</option>
 <?php
 $kategorije=dohvatiKategorije();
 foreach ($kategorije as $kategorija):?>
 <option value="<?=$kategorija->idKategorija?>"><?=$kategorija->naziv?></option>
 <?php endforeach;

 ?>
 </select>
 </div>

 <input type="submit" value="Ažuriraj" name='btnAzurirajProizvod'id='btnAzuriraj' class="btn btn-outline-secondary">
 <input type="button" value="Ukloni" id='ukloni' class="btn btn-outline-secondary">

 </form>

 </div>
 <div class="container col-12 azuriranjeOdg">
 <?php

 if(isset($_SESSION['azuriranjePoruke'])){
 $azuriranjePoruke=$_SESSION['azuriranjePoruke'];
 echo "<p>$azuriranjePoruke</p>";
 unset($_SESSION['azuriranjePoruke']);
 }
 ?>
 <?php
 if(isset($_SESSION['greskeA'])){
 $greskeUnos=$_SESSION['greskeA'];

 foreach($greskeUnos as $jednaGreska){
 echo "<p>$jednaGreska</p>";
 }
 unset($_SESSION['greskeA']);
 }
 ?>
 </div>
 </div>

<?php endif;?>