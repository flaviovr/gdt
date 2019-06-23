<style>
    section#descontos { background-color: var(--shade1);}
    section#descontos p.title{ background-color: var(--shade2); }
</style>

<?php
//debug($descontos);
?>
<section id='descontos' class='padrao'>
    <p class='title '>
        <i class="fas fa-percentage"></i> Descontos Imperdíveis
        <a href="/descontos" class="btn btn-secondary btn-sm float-right">Ver Todos</a>
    </p>
    <div class='row'>
    
        <?php $i=0; foreach ($descontos as $desconto){ ?>
        <div class="col-6 col-md-3 " >
            <div class="card">
            
         
                <a href="<?= h($desconto['link']);?>" target="_blank" >
                    <img src="/img/descontos/<?= h($desconto['imagem']);?>" class="card-img" alt="img/descontos/<?= h($desconto['imagem']);?>">     
                    <div class="card-body p-top-5">
                        <h6 class="card-title"><?= h($desconto['nome']);?></h6>
                    </div>
                </a>
                
            </div>
        </div>
        <?php  $i++; if($i==4) break;  } ?>
        
    </div>

</section>


