<?php 
$c = count($banners);
?>

<div id="mainMenu" class="carousel slide h-md-50" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php for($i=0; $i<$c; $i++) {?>
        <li data-target="#mainMenu" data-slide-to="<?= $i ;?>" class="<?= $i==0 ? 'active' :''; ?>"></li>
        <?php } ?>
    </ol>
    <div class="carousel-inner">
        <?php  for($i=0; $i<$c; $i++) {?>
        <div class="carousel-item <?= $i==0 ? 'active' :''; ?>" data-interval="<?=$banners[$i]['tempo']?>000">
            <a href="<?=$banners[$i]['link']?>" target='<?=$banners[$i]['externo'] ? "_blank" : "";?>'>
                <img alt='<?=$banners[$i]['nome']?>' src="/img/banners/<?=$banners[$i]['imagem']?>" >
            </a> 
        </div>
        <?php } ?>
       
    </div>
    <a class="carousel-control-prev" href="#mainMenu" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#mainMenu" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>