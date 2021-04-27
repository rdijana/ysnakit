<?php
pristupStranici();
require_once("modules/proizvodi/functions.php");
?>
<div class="container col-12 mt-5 pt-5" id="proizvodi">
    <div class="row d-flex justify-content-center mt-3 pt-4">
        <div class="col-12 mb-5">
            <h2 class="text-center">Naša ponuda</h2>
        </div>
        <div class="col-10 d-flex justify-content-around flex-wrap mt-5" id="pretraga">
              <div class="col-md-3 col-sm-6 col-12">
              <select id="filterKat" name='filterKat' class="btn btn-outline-secondary dropdown-toggle m-4">
 <option value="0">Filtriraj po kategoriji</option>
 <?php $kategorije=dohvatiKategorije(); 
 foreach($kategorije as $kategorija):?>
 <option value="<?=$kategorija->idKategorija?>"><?=$kategorija->naziv?></option>
 <?php endforeach;?>
 </select>
              </div>
              <div class="col-md-3 col-sm-6 col-12 col-8">
              </select>
 <select name="sortiranje" id="sortiranje" class="btn btn-outline-secondary dropdown-toggle m-4">
 <option value="0">Sortiraj po ceni</option>
 <option value="1">Rastuće</option>
 <option value="2">Opadajuce</option>
 </select>
              </div>
              <div class="col-md-3 col-sm-6 col-12 m-4">
              <div id="search" class="search-container">
              <div class="input-group flex-nowrap">
              <div class="input-group-prepend">
    <span><button type="button" class="btn btn-outline-secondary" id="btnSearch"><i class="fa fa-search" ></i></button></span>
  </div>
  <input type="text" class="form-control" placeholder="Search"  name="search" id="tbSearch" aria-label="Search" aria-describedby="addon-wrapping">
 </div>
              </div>
 </div>

        </div>
    </div>
    <div class="row d-flex justify-content-around" id="sviProizvodi">



    </div>
    <div class="col-12 d-flex justify-content-around mt-5">
    <div id="stranicenje">
 <ul id="stranicenje2">
 </ul>
 </div>
    </div>
</div>