<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->nazivUloge==='admin'):?>
<div class="container mt-5 pt-5">

 <table class="table table-bordered mb-5 ">
 <?php
 $stranice=stranice();
 $brStranica=count($stranice);
 ?>
 <thead>
 <tr>
 <td colspan="<?=$brStranica;?>" class="zaglavlje">
 <p class="text-center">Statistika pristupa stranicama u poslednja 24 sata</p>
 </td>
 </tr>
 <tr>
 <?php foreach($stranice as $i):?>
 <td><?=$i;?></td>
 <?php endforeach;?>
 </tr>
 <tr>
 <?php foreach(procenatPristupa() as $x):?>
 <td><?=$x;?>%</td>
 <?php endforeach;?>
 </tr>
 </thead>
 </table>
 <table class="table table-bordered mb-5">
 <thead>
 <tr>
 <td><p class="text-center">Broj ulogovanih korisnika</p></td>
 <td><?=brUlogovanih();?></td>
 </tr>
 </thead>
 </table>
</div>
<?php endif;?>