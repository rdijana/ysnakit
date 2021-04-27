<?php
pristupStranici();
?>
<div class="container col-12 mb-5 pb-5">
 <div class="row mb-5 pb-5 mt-5 d-flex justify-content-center">
 <div class="col-lg-4 forma" id="login">
 <?php if(isset($_SESSION['korisnik'])):
 if($_SESSION['korisnik']->nazivUloge==='admin'):
 header("Location:index.php?page=admin-proizvodi");
 else:
 header("Location:index.php?page=pocetna");
 endif;
 else:?>
 <h2 class="text-center pb-5 mt-5">Logovanje</h2>
 <form method='POST' action='modules/login.php'>
 <div class="form-group">
 <input type="text" name="tbEmail" placeholder='Email' class='form-control'>
 </div>
 <div class="form-group">
 <input type="password" name="tbLozinka" placeholder='Lozinka' class='form-control'>
 </div>
 <input type="submit" value="Ulogujte se" name='btnLogin' class="btn btn-outline-secondary">

 </form>
 <?php endif;?>
 <?php
 if(isset($_SESSION['greske'])){
 echo($_SESSION['greske']);
 unset($_SESSION['greske']);
 }
 if(isset($_SESSION['greskeLog'])){
    $greskeUnos=$_SESSION['greskeLog'];
   
    foreach($greskeUnos as $jednaGreska){
    echo "<p>$jednaGreska</p>";
    }
    unset($_SESSION['greskeLog']);
    }
 ?>
 <?php
 
 ?>
 </div>
 </div>
</div>
