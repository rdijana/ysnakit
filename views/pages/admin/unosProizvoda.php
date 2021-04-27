<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->nazivUloge==='admin'):
 require_once("modules/proizvodi/functions.php");
?>
<div class="container col-12 mt-5">
 <div class="row">
 <div class="col-md-4 mx-auto unos">
 <h2 class="text-center mt-5 mb-5" >Unos proizvoda</h2>
 <form method="POST" action="modules/proizvodi/unosProizvoda.php" enctype='multipart/form-data'>
 <div class="form-group">
 <input type="text" name="tbNaziv" id="tbNaziv" placeholder='Naziv proizvoda' class='form-control'>
 </div>
 <div class="form-group">
 <label>Slika proizvoda : &nbsp;</label> <input type="file"name="slika" id="slika">
 </div>
 <div class="form-group">
 <input type="text" name="tbCena" id="tbCena" placeholder='Cena proizvoda' class='form-control'>
 </div>
 <div class="form-group">
 <input type="text" name="tbSastav" id="tbSastav" placeholder='Sastav proizvoda' class='form-control'>
 </div>
 <label>Kategorija proizvoda : </label>
 <div class="form-group">
 <select name='ddlKategorija' id='ddlKategorija' class='form-control'>
 <option value='0'>Izaberite</option>
 <?php
 $kategorije=dohvatiKategorije();
 foreach ($kategorije as $kategorija):?>
 <option value="<?=$kategorija->idKategorija?>"><?=$kategorija->naziv?></option>
 <?php endforeach;
 ?>
 </select>
 </div>

 <input type="submit" value="Unesi" name='btnUnos' id='btnUnos' class="btn btn-outline-secondary">&nbsp;

 <?php
 if(isset($_GET['poruka'])){
 echo $_GET['poruka'];
 }
 if(isset($_SESSION['greskeUnos'])){
 $greskeUnos=$_SESSION['greskeUnos'];

 foreach($greskeUnos as $jednaGreska){
 echo "<p>$jednaGreska</p>";
 }
 unset($_SESSION['greskeUnos']);
 }
 ?>
 </form>

 </div>
 </div>
</div>

<?php endif;?>