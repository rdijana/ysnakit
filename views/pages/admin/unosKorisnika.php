<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->nazivUloge==='admin'):?>
<div class="container">
 <div class="row align-items-center">
 <div class="col-md-6 mx-auto">
 <form class='form-horizontal' action="" method="POST">
 <div class="control-group">
 <h2 class="text-center mt-5 mb-5">Unos korisnika</h2>
 </div>
 <div class="control-group">
 <label class='control-label' for='tbIme'>Ime</label>
 <div class="form-group">
 <input type="text"class="form-control" id="tbIme">
 <p class='obavestenje'></p>
 </div>
 </div>
 <div class="control-group">
 <label class='control-label' for='tbPrezime'>Prezime</label>
 <div class="form-group">
 <input type="text"class="form-control" id="tbPrezime">
 <p class='obavestenje'></p>
 </div>
 </div>
 <div class="control-group">
 <label class='control-label' for='tbKorisnickoIme'>Korisničko ime</label>
 <div class="form-group">
 <input type="text"class="form-control" id="tbKorisnickoIme">
 <p class='obavestenje'></p>
 </div>
 </div>
 <div class="control-group">
 <label class='control-label' for='tbEmail'>E-mail</label>
 <div class="form-group">
 <input type="text"class="form-control" id="tbEmail">
 <p class='obavestenje'></p>
 </div>
 </div>
 <div class="control-group">
 <label class='control-label' for='tbLozinka'>Lozinka</label>
 <div class="form-group">
 <input type="password"class="form-control" id="tbLozinka">
 <p class='obavestenje'></p>
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
 <p class="obavestenje"></p>
 <div class="control-group">
 <div class="controls">
 <button class="btn btn-outline-secondary" type='button' id="btnUnos">Upiši</button>
 </div>
 <div id="poruka"></div>
 </div>
 </form>

 </div>
 </div>
</div>
<?php endif;?>