<style>
    section#descontos { background-color: var(--shade1);}
    section#descontos p.title{ background-color: var(--shade2); }
</style>

<?php
//debug($descontos);
?>
<section id='descontos' class='padrao'>
    <p class='title '><i class="fas fa-percentage"></i> Descontos Imperdíveis</p>
    
    <div class='row'>
    
        <?php for ($i=0;$i<4;$i++){ ?>
        <div class="col-lg-3 col-md-6" >
            <div class="card">
            
         
                <a href="<?= h($descontos[$i]['link']);?>" target="_blank" >
                    <img src="/img/descontos/<?= h($descontos[$i]['imagem']);?>" class="card-img" alt="img/descontos/<?= h($descontos[$i]['imagem']);?>">     
                    <div class="card-body p-top-5">
                        <h6 class="card-title"><?= h($descontos[$i]['nome']);?></h6>
                    </div>
                </a>
                
            </div>
        </div>
        <?php } ?>
        
    </div>

</section>


