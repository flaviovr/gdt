<?php   

$title = $page['titulo'].' : '. $config['site']['titulo'];

$site = 'http://guiadetrips.com.br';

$fb_AppId = '2344972295775078';
if($page['pagina']=='artigo') {
    $fb_title = $data['data']['titulo'];
    $fb_desc = $data['data']['subtitulo'];
    $fb_imagem = $site.'/img/posts/thumb/'.$data['data']['thumb'];
    $fb_type = 'article';
    
} else if($page['pagina']=='destinos') {
    $fb_title = $config['site']['titulo'];
    $fb_desc = $page['titulo'];
    $fb_imagem = $site.'/img/headers/'.$page['imagem'];
    $fb_type = 'article';
    echo $this->Html->meta('robots', 'no-index'); 
} else {
    $fb_title = $config['site']['titulo'];
    $fb_desc = $page['titulo'];
    $fb_imagem = "";
    $fb_type = 'website';
}
$fb_url = $site.$this->request->getAttribute("here");

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
    <meta name="verification" content="d69b2100d8a35ea434297a6f5cccc71c" />
    <title><?= $title ?></title>
    
    <?= $this->Html->meta('icon', '/favicon.png'); ?>
    <?= $this->fetch('meta') ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- Metas do Facebook -->
	<meta property="og:title" content="<?=$fb_title;?>" />
	<meta property="og:description" content="<?=$fb_desc;?>" />
	<meta property="og:image" content="<?=$fb_imagem;?>"/>
	<meta property="og:url" content="<?=$fb_url;?>" />
    <meta property="fb:app_id" content="<?=$fb_AppId;?>" />
    
	<meta property="og:type" content="<?=$fb_type;?>"/>
	<!-- Fim Metas do Facebook -->




    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('animate.css') ?>
    <?= $this->Html->css('bootnavbar.css') ?>

    <?= $this->fetch('css') ?>
   
</head>

<body style="background:url('<?=$config['site']['siteBg']?>') center center fixed no-repeat ; background-size:cover;">
  

    <div class="container  p-0  p-lg-15">
        
        <?= $this->element('Base/topbar', $config['topbar']);?>

        <?= $this->element('Base/navbar', $config['navbar']);?>
        
        <?php if( !($page['pagina']=='destinos' or $page['pagina']=='artigo' ) ) echo $this->element('Base/banners', ['banners'=>$config['banners'] ] ) ;?>
        
        
        
        <div class="content">
            <?= $this->fetch('content') ?>
            <?= $this->element('Base/mailer');?>
            <?php if($page['controller']!=='Discounts') echo $this->element('Base/descontos', ['descontos'=>$config['topbar']['descontos']]);?>
            <?= $this->element('Base/destaques', ['destaques'=>$config['home']['destaques']]);?>
        </div> 
        
        <?= $this->element('Base/instagram');?>
        <?php if($page['controller']!== 'Videos' ) echo $this->element('Base/youtube', ['youtbe'=>$config['youtube']]);?>
        <?= $this->element('Base/footer');?>


    
    </div>
 
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.3&appId=491747104964043&autoLogAppEvents=1"></script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5d0b0a6f99fa3100120031c0&product='inline-share-buttons' async='async'></script>
    <?= $this->Html->script('bootnavbar') ?> 
    
    <script>
        $(function () { 
            
            $('#main-navbar').bootnavbar(); 
            
            $('#news_form').submit(function () {
                email = $('#news_email').val();
                if(email=='') {
                    alert('Preencha o E-mail');
                } else {
                    if(isEmail(email)){
                        $.post("/newsletter", $('#news_form').serialize() , function(data, textStatus, xhr ){
                           if(textStatus=='success'){
                               if(data.success) {
                                    $('#news_email').val('');
                                    alert('Email cadastrado com sucesso');
                               } else {
                                    $('#news_email').addClass('is-invalid');
                                    alert(data.erro);
                               }
                               
                           } else {
                                $('#news_email').val('');
                                alert('Erro ao cadastrar, tente novamente.');
                                console.log(xhr);
                           }
                        });
                    } else {
                        alert('E-mail inválido!');
                    }                    
                }
                return false;
            });   

          
            function isEmail(email) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
            }
            
        });
        
        
    </script>    
    
    <?= $this->fetch('script') ?>

  </body>
</body>
</html>
