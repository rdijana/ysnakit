<footer>
<div class="container col-12 mt-5" id="stil">
    <div class="row d-flex justify-content-center mx-0 px-0">
        <div class="col-7">
        <p class="text-center mt-3 text-muted">Linkovi</p>
    <ul id="futer">
    <?php 
    $linkovi=ikoniceFuter();
    foreach($linkovi as $link):
    ?>
    <li class="text-decoration-none p-2"><a href="<?=$link->putanja?>" class="text-decoration-none"><?=$link->tekst?></a></li>
    <?php endforeach; ?>    
</ul>
        <p class="text-center text-muted">Copyright ©<?=date("Y");?> All rights reserved</p>
    </div>
    </div>
</div>
</footer>
<script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/main.min.js"></script>
<script  src="assets/js/lightbox.min.js" type="text/javascript"></script>