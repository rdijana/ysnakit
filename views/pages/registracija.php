<?php
pristupStranici();

?>
<div class="container">
 <div class="row mt-5 pt-5 align-items-center">
 <div class="col-md-6 mx-auto ">
 <h2 class="text-center mb-5">Registracija</h2>
 <form class='form-horizontal' action="" method="POST">
 
 <div class="control-group">
 <label class='control-label' for='tbIme'>Ime</label>
 <div class="form-group">
 <input type="text"class="form-control" id="tbIme">
 <p class='uputstvo'></p>
 </div>
 </div>
 <div class="control-group">
 <label class='control-label' for='tbPrezime'>Prezime</label>
 <div class="form-group">
 <input type="text"class="form-control" id="tbPrezime">
 <p class='uputstvo'></p>
 </div>
 </div>
 <div class="control-group">
 <label class='control-label' for='tbKorisnickoIme'>Korisničko ime</label>
 <div class="form-group">
 <input type="text"class="form-control" id="tbKorisnickoIme">
 <p class='uputstvo'></p>
 </div>
 </div>
 <div class="control-group">
 <label class='control-label' for='tbEmail'>Email</label>
 <div class="form-group">
 <input type="text"class="form-control" id="tbEmail">
 <p class='uputstvo'></p>
 </div>
 </div>
 <div class="control-group">
 <label class='control-label' for='tbLozinka'>Lozinka</label>
 <div class="form-group">
 <input type="password"class="form-control" id="tbLozinka">
 <p class='uputstvo'></p>
 </div>
 </div>
 <div id="tbPolGreska">
 <div class="radio">
 <label><input type="radio" name="pol" value="M">Muški</label>
 </div>
 <div class="radio">
 <label><input type="radio" name="pol" value="Z">Ženski</label>
 </div><br>
 </div>
 <p class="uputstvo"></p>
 <div class="control-group">
 <div class="controls">
 <button class="btn btn-outline-secondary" type='button' id="btnRegistracija">Registruj se</button>
 </div>
 <div id="poruka"></div>
 </div>
 </form>

 </div>
 </div>
</div>