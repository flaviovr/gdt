<?php
$this->set('title', '');

echo $this->Html->css('destinos');
?>
<style>
    section#destinos p.title {
        background-color: var(--shade1);
        color:var(--shade3);
        text-shadow:none;
    }
</style>

<div class='header'  style="background:url('/img/headers/<?=$page['imagem']?>') no-repeat center center; background-size:cover;"></div>

<section id="destinos" class='padrao'>
     
    <p class='title clearfix'>
        <i class='fas fa-map-marker-alt'></i>  <?= $page['titulo'];?>
        <span class="btn-group float-right" aria-label="Basic example">
            <a href='' class="btn btn-sm btn-success active">Tudo</a></form>
            <a href='atracoes' class=" btn btn-sm btn-secondary" >Atrações</a>
            <a href='atracoes' class="btn btn-sm btn-secondary">Right</a>
        </span>
    </p>
   
   <div class='row'>
      <?php $i=0; foreach ($data as $item){ ?>
      <div class="col-lg-3 col-md-6" >
          <div class="card ">      
              <a href="/p<?= h($item['id']);?>/<?= h($item['slug']);?>">
                  <img src="/img/destinos/<?= h($item['imagem']);?>" class="card-img-top" alt="img/destinos/<?= h($item['imagem']);?>">
                  <div class="card-body p-0">
                      <h6 class="card-title"><?= h($item['titulo']);?></h6>
                      <p class="card-text"><?= h($item['subtitulo']);?></p>
                  </div>  
              </a>
          </div>

      </div>
      <?php $i++; } ?>

    </div>

    <div class='row'>
      
            <nav aria-label="Page navigation example" class='mx-auto'>
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
      
   </div>

</section>
    

    