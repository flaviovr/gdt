<?php   

$title = $page['titulo'].' : '. $config['site']['titulo'];
?>
<!DOCTYPE html>
<html>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-141769715-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-141769715-1');
    </script>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="lomadee-verification" content="22803459" />
    <title><?= $title ?></title>
    
    <?= $this->Html->meta('icon', '/favicon.png'); ?>
    <?= $this->fetch('meta') ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('animate.css') ?>
    <?= $this->Html->css('bootnavbar.css') ?>

    <?= $this->fetch('css') ?>
   
</head>

<body style="background:url('/img/site/<?=$config['site']['siteBg']?>') center center fixed no-repeat ; background-size:cover;">
  

    <div class="container  p-0  p-lg-15">
        
        <?= $this->element('Base/topbar', $config['topbar']);?>

        <?= $this->element('Base/navbar', $config['navbar']);?>
        
        <?php if( !($page['pagina']=='destinos' or $page['pagina']=='artigo' ) ) echo $this->element('Base/banners', ['banners'=>$config['banners'] ] ) ;?>
       
        <div class="content">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
            <?= $this->element('Base/descontos', ['descontos'=>$config['topbar']['descontos']]);?>
            <?= $this->element('Base/destaques', ['destaques'=>$config['home']['destaques']]);?>
        </div> 

        
        <?= $this->element('Base/instagram');?>
        <?= $this->element('Base/youtube', ['youtbe'=>$config['youtube']]);?>
        <?= $this->element('Base/footer');?>


    
    </div>
 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <?= $this->Html->script('bootnavbar') ?> 
    <script>$(function () { $('#main-navbar').bootnavbar(); }) </script>
        
    <?= $this->fetch('script') ?>
  </body>
</body>
</html>
