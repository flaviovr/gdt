<?php
echo $this->Html->css('home');
echo $this->Html->css('artigo');
?>

<img src="/img/posts/<?=$data['imagem']?>" style='width:100%' alt="">
<section class="padrao">
    <p class='title'><i class="fa fa-map-marker-alt"></i> <?= $page['titulo'] ?></p>
    <h1>
        <?= $data['titulo'] ?><br>
        <small><?= $data['subtitulo'] ?></small>
    </h1>
    <hr/>
    <div class='clearfix'>
        <span class='small'>Postado_em: <?= $data['criado_em']->i18nformat('d/m/Y') ?></span> 
        <div class='float-right'>
            <span class='small'>Tags: </span> <a class="badge badge-info">Disney</a> 
            <span class='small'>Categoria: </span> <a class="badge badge-success">Disney</a> 
        </div>
    </div>
    <div class='texto'><?=$data['texto']?></div>
    
</section>