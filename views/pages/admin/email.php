<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->nazivUloge==='admin'):
 require_once("modules/email/functions.php");
?>
 <div class="container mt-5 pt-5" id="mejlovi">
 </div>
 <div class="row mx-0 px-0">
 <div class="col-md-4 mx-auto mb-5" id="detaljiMejla">

 </div>
 </div>
<?php endif;?>