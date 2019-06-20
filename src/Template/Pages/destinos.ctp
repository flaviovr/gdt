<?php
$this->set('title', '');

echo $this->Html->css('destinos');
$categorias = $data['categorias'];
$data =$data['posts']; 

$slug = $page['menu'] ? '/'.$page['menu'] : '';
$slug .= $page['regiao'] ? '/'.$page['regiao'] : '';
$slug .= $page['local'] ? '/'.$page['local'] : '';
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
        <span class="btn-group float-right" aria-label="Filtrar">
            <a href='<?=$slug?>' class="btn btn-sm btn-success <?=empty($page['categoria']) ? 'active' :'';?>">Tudo</a>
            <?php foreach($categorias as $cat) echo "<a href='$slug?category=$cat[slug]' class='btn btn-sm btn-".($cat['slug']==$page['categoria'] ?'success active':'success ')."'>$cat[nome]</a>"; ?>    
        </span>
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
                    <img src="/img/posts/<?= h($item['imagem']);?>" class="card-img-top" alt="img/posts/<?= h($item['imagem']);?>">
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
    

    