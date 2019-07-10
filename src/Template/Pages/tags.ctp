<?php
echo $this->Html->css('destinos');

$titulo = $page['titulo'].$this->request->getParam('tag');
?>
<style>
    section#destinos p.title {
        background-color: var(--shade1);
        color:var(--shade3);
        text-shadow:none;
    }
</style>
<section id="destinos" class='padrao'>
     
    <p class='title clearfix'>
        <i class='fas fa-tag'></i>  <?= $titulo;?>

    </p>
    <?= $this->Flash->render() ?>
   <div class='row'>
        <?php if(count($data)==0) {?>
        <div class="col-12"> <br><br> <p class='text-center lead text-muted'><i class='fas fa-times-circle'></i> Nenhum registro encontrado!</p> <br><br> </div>
        <?php } ?>
        <?php $i=0; foreach ($data as $item){ ?>
        <div class="col-6 col-sm-6 col-lg-3" >
            <div class="card ">      
                <a href="/p/<?= h($item['id']);?>/<?= h($item['slug']);?>">
                    <img src="/img/posts/thumb/<?= h($item['thumb']);?>" class="card-img-top" alt="img/posts/thumb/<?= h($item['thumb']);?>">
                    <div class="card-body p-0">
                        <h6 class="card-title"><?= h($item['titulo']);?></h6>
                        <p class="card-text"><?= h($item['subtitulo']);?></p>
                    </div>  
                </a>
            </div>

        </div>
        <?php $i++; } ?>

    </div>
    <div class="paginator clearfix">
        <ul class="pagination  justify-content-center">
            <?= $this->Paginator->first('<i class="far fa-arrow-alt-circle-left"></i>',['escape'=>false]) ?>
            <?= $this->Paginator->numbers() ?>    
            <?= $this->Paginator->last('<i class="far fa-arrow-alt-circle-right"></i>',['escape'=>false]) ?>
        </ul>
        
    </div>

</section>
    

    