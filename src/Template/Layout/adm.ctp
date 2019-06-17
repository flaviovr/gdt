<?php 
    $title = "Gerenciar > " . $page['titulo'];
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>  
    <?= $this->Html->meta('icon', '/favicon.png'); ?>
    <?= $this->fetch('meta') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <?= $this->Html->css('adm.css') ?>
    <?= $this->fetch('css') ?>
</head>

<body >
    <div class="container  p-0  p-lg-15">
        <?= $this->element('Adm/navbar');?>
        <div class="content">
            <?= $this->fetch('content') ?>
        </div>
    </div>
 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="/js/jquery-chained/jquery.chained.js"></script>

    
    
    <script>
        $("#region_id").chained("#menu_id");
        $("#location_id").chained("#region_id");
       $("#category_id").chained("#menu_id");

       $("#region_id2").chained("#menu_id2");
        $("#location_id2").chained("#region_id2");
        $("#category_id2").chained("#menu_id2");
    </script>

    <?= $this->fetch('script') ?>

</body>
</html>
