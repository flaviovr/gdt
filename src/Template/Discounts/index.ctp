<style>
    section#descontos { background-color: var(--shade1);}
    section#descontos p.title{ background-color: var(--shade2); }
</style>

<section id='descontos' class='padrao'>

<p class='title'><i class="fas fa-percentage"></i> Descontos</p>
<div class='row'>
    
    <?php foreach ($config['topbar']['descontos'] as $desconto){ ?>
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
    <?php  ;   } ?>
    
</div>

    
</section>

