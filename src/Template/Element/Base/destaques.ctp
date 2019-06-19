<?php 
//debug($destaques);
?>
<section class='padrao'>

    <?php 
    foreach ($destaques as $destaque){
    ?>
    <p class='title'><i class="fas fa-map-marker-alt"></i> <?= h($destaque['item']['titulo']);?></p>
    
    <div class='row'>

        <?php foreach ($destaque['posts'] as $post){ ?>
        <div class="col-6 col-md-3 " >
            
            <div class="card ">      
                <a href="/p<?= h($post['id']);?>/<?= h($post['slug']);?>">
                    <img src="/img/destinos/<?= h($post['imagem']);?>" class="card-img-top" alt="img/destinos/<?= h($post['imagem']);?>"> 
                    <div class="card-body p-0">
                        <h6 class="card-title"><?= h($post['titulo']);?></h6>
                        <p class="card-text"><?= h($post['subtitulo']);?></p>
                    </div>  
                </a>
            </div>

            
        </div>
        <?php } ?>
        

    </div>
    <?php } ?>
    
</section>