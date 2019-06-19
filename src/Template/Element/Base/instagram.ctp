<style>
    section#instagram { background-color: var(--shade3); color: var(--shade2); padding-bottom:40px; }
    section#instagram .row {margin:0px;}
    section#instagram p.title { background-color: rgba(0,0,0,.8); }

    .square:before{
    content: "";
    display: block;
    padding-top: 100%;  /* initial ratio of 1:1*/
    }

    .finsta {
        position:relative;
    }

    .tinsta {
        background: rgba(0,0,0,.7);
        width:90%;
        height:90%;
        position:absolute;
        top:5%;
        left:5%;
        display:none;
        color: #fff;
        font-weight:700;
        font-size:12px;
        padding:10%;
    }
    .finsta:hover .tinsta{display:table; }
}
</style>

<section id='instagram' class='padrao clearfix'>
    <p class='title align-middle'>
        <i class="fab fa-instagram "></i> Instagram
        <a href="<?=$config['topbar']['socialMedia']['instagram']?>" target='_blank' class="btn btn-success btn-sm float-right">Visitar Instagram</a>
    </p>
  
   
    <div class='row'>
        
        <?php
        // title => 'O Seaworld anunciou uma Nova montanha russa pra 2020. 
        // Em seu teaser eles prometem uma sexta montanh...'
        //         description => 'O Seaworld anunciou uma Nova montanha russa pra 2020. 
        // Em seu teaser eles prometem uma sexta montanha russa com alturas dignas de um predador, grandes mergulhos e uma tematica glacial. 
        // Ao que tudo indica teremos algo parecido com a Sheikra do Busch Gardens, alguns rumores dizem que ela chegará a 55 mph(88 km/h). Em breve traremos maiores novidades.. #seaworld #coaster #rollercoaster #montanharussa #orlando #florida #orlandoflorida #newcoaster #disney #disneyworld #universalstudios #novamontanharussa #usa #tampa #disneybrasil #brasileirosemorlando<br><img referrerpolicy="no-referrer" src="https://scontent-iad3-1.cdninstagram.com/vp/7121f5a2124159d79969f82636ee6240/5D9ABADD/t51.2885-15/e35/60583851_141269120267552_547630155943779834_n.jpg?_nc_ht=scontent-iad3-1.cdninstagram.com"><br>'
        //         pubDate => 'Mon, 03 Jun 2019 22:52:35 GMT'
        //         guid => 'https://www.instagram.com/p/ByQ9qHrFRz-/'
        //         link => 'https://www.instagram.com/p/ByQ9qHrFRz-/'
        foreach($config['instagram'] as $post){?>
        <a class="col-6 col-sm-3  p-0 square finsta" href="<?=$post->link?>" target='_blank' style='background:url("<?=$post->imagem?>") no-repeat center center; background-size:cover;'>
            <div class='tinsta align-middle '><p class='d-table-cell align-middle text-center'><?=$post->title?></p></div> 
        </a>
        <?php } ?>

       
        
    </div>
    
  
  
    

    
</section>