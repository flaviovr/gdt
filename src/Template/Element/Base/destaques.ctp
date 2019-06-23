<?php 
?>
<section class='padrao'>

    <?php 
    foreach ($destaques as $destaque){
       //debug($destaque);
        $slug = $destaque['posts'][0]['menu']['slug'] ? '/'.$destaque['posts'][0]['menu']['slug'] : '';
        $slug .= $destaque['posts'][0]['region']['slug'] ? '/'.$destaque['posts'][0]['region']['slug'] : '';
        $slug .= $destaque['posts'][0]['location']['slug'] ? '/'.$destaque['posts'][0]['location']['slug'] : '';
        $slug .= $destaque['posts'][0]['category']['slug'] ? '?category='.$destaque['posts'][0]['category']['slug'] : '';

    ?>
    <p class='title'>
        <i class="fas fa-map-marker-alt"></i> <?= h($destaque['item']['titulo']);?>
        <a href="<?=$slug?>" class="btn btn-success btn-sm float-right">Ver Mais</a>
    </p>
    
    <div class='row'>

        <?php foreach ($destaque['posts'] as $post){ ?>
        <div class="col-6 col-md-3 " >
            
            <div class="card ">      
                <a href="/p<?= h($post['id']);?>/<?= h($post['slug']);?>">
                    <img src="/img/posts/thumb/<?= h($post['thumb']);?>" class="card-img-top" alt="img/posts/thumb/<?= h($post['thumb']);?>"> 
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