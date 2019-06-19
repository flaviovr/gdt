<?php
echo $this->Html->css('home');

?>
<style>
    section#youtube { background-color: rgb(192, 69, 69);}
    section#youtube  p.title{ background-color: rgba(28,28,28,.5); }
    section#youtube .card {height:250px;}
    section#youtube .card-title {color: var(--black);}
</style>
<section id='youtube' class='padrao'>

<p class='title'><i class="fab fa-youtube"></i> Vídeos do Youtube</p>

   
    <div class='row'>
     <?php foreach ($data as $item){ ?>
        <div class="col-lg-3 col-md-6" >
            <div class="card">
                <a href="https://www.youtube.com/watch?v=<?=$item['video']?>&feature=guiadetrips.com.br" target="_blank" >
                    <img src="https://img.youtube.com/vi/<?=$item['video']?>/maxresdefault.jpg" class="card-img" >     
                    <div class="card-body">
                        <h6 class="card-title"><?=h($item['nome']);?></h6>
                    </div>
                </a>
                
            </div>

        </div>
        <?php } ?>
    </div>
    
</section>

