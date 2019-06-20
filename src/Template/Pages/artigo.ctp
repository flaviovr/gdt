<?php
echo $this->Html->css('home');
echo $this->Html->css('artigo');

$titulo = $data['menu'] ? $data['menu']['nome'] : '';
$titulo .= $data['region'] ? ' / '.$data['region']['nome'] : '';
$titulo .= $data['location'] ? ' / '.$data['location']['nome'] : '';
?>
<style>
    section#artigo p.title {
        background-color: var(--shade1);
        color:var(--shade3);
        text-shadow:none;
    }
</style>

<img src="/img/posts/<?=$data['imagem']?>" style='width:100%' alt="">
<section id='artigo' class="padrao">
    <p class='title'><i class="fa fa-map-marker-alt"></i> <?= $titulo ?></p>
    <h1>
        
        <?= $data['titulo'] ?><br>
        <small><?= $data['subtitulo'] ?></small>
    </h1>

    <hr/>
    <div class='clearfix'>
        <span class='small'>Postado_em: <?= $data['publicado_em']->i18nformat('d/m/Y') ?></span> 
        <div class='float-right'>
            <span class='small'>Tags: </span> <a class="badge badge-info">Disney</a> 
            <div class="sharethis-inline-share-buttons float-right"></div>
            <?php if($data['category']){ ?><span class='small'>Categoria: </span> <a class="badge badge-success"><?=$data['category']['nome']?></a> <?php } ?>
            
						
        </div>
    </div>
    <div class='texto clearfix'>
        
        <?php if($data->has('discount')) echo "<a href='".$data['discount']['link']."' class='float-right' target='_blank'>".$this->Html->image('descontos/'.$data['discount']['imagem'],['width'=>'100%', 'height'=>'auto','style'=>'padding:0 0 20px 20px;']). "</a>" ?>
        
        <?=$data['texto']?>

    </div>
    
</section>