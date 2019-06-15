<style>
    section#youtube { background-color: rgb(192, 69, 69);}
    section#youtube  p.title{ background-color: rgba(28,28,28,.5); }
    section#youtube .card-title {color: var(--black);}
</style>

<?php //debug($config['youtube']);?>
<section id='youtube' class='padrao'>
    
    <p class='title'><i class="fab fa-youtube"></i> Vídeos do Youtube</p>
    
    <div class='row'>
    
    <?php foreach ($config['youtube'] as $video){ ?>
        <div class="col-6 col-md-3" >
            <div class="card">
                <a href="https://www.youtube.com/watch?v=<?=$video['video']?>&feature=guiadetrips.com.br" target="_blank" >
                    <img src="https://img.youtube.com/vi/<?=$video['video']?>/maxresdefault.jpg" class="card-img" >     
                    <div class="card-body">
                        <h6 class="card-title"><?=h($video['nome']);?></h6>
                    </div>
                </a>
                
            </div>
        </div>
        <?php } ?>


    </div>
    
</section>
