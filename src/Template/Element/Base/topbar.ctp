<?php 
$c = count($descontos);
?>
<section id='topbar'>
    
   
  
        <p class=' float-left d-none d-md-block'>DESCONTOS</p>

        <div id='SocialMedia' class='text-center d-inline-block float-right'>
            <?php if($socialMedia['twitter']) { ?> <a href="<?=$socialMedia['twitter']?>" target="_blank" ><i class="fab fa-twitter"></i></a><?php } ?>
            <?php if($socialMedia['facebook']) { ?><a href="<?=$socialMedia['facebook']?>" target="_blank" ><i class="fab fa-facebook"></i></a><?php } ?>
            <?php if($socialMedia['instagram']) { ?><a href="<?=$socialMedia['instagram']?>" target="_blank" ><i class="fab fa-instagram"></i></a><?php } ?>
            <?php if($socialMedia['youtube']) { ?><a href="<?=$socialMedia['youtube']?>" target="_blank" ><i class="fab fa-youtube"></i></a><?php } ?>
        </div>
        
        <div id="descontos-carousel" class="carousel w-70 carousel-slide slide d-none d-block" data-ride="carousel">
        
            <div class="carousel-inner">
                <?php  for($i=0; $i<$c; $i++) {?>
                <div class="carousel-item <?= $i==0 ? 'active' :''; ?>" data-interval="3000">
                    <a href="<?=$descontos[$i]['link']?>" target='_blank'> <?=$descontos[$i]['nome']?> </a> 
                </div>
                <?php } ?>
            
            </div>
            <a class="carousel-control-prev" href="#descontos-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#descontos-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

  
    
</section>