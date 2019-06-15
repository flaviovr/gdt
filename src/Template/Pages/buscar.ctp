<?php
$this->set('title', 'Home');

$this->set('pg', 'home');

echo $this->Html->css('home');
$termo = h($this->request->getQuery('termo'));
?>
<section id="home" class='padrao'>
    <p class='title'><i class="fas fa-search-location"></i> Resultados da Busca:</p>
   
    <div class='row'>
     <?php foreach ($data as $item){ ?>
        <div class="col-lg-3 col-md-6" >
            <div class="card ">      
                <a href="/p/<?= h($item['id']);?>/<?= h($item['slug']);?>">
                    <img src="/img/destinos/<?= h($item['imagem']);?>" class="card-img-top" alt="img/destinos/<?= h($item['imagem']);?>">
                    <div class="card-body p-0">
                        <h6 class="card-title"><?= h($item['titulo']);?></h6>
                        <p class="card-text"><?= h($item['subtitulo']);?></p>
                    </div>  
                </a>
            </div>

        </div>
        <?php } ?>
    </div>
    
</section>

