<?php
echo $this->Html->css('home');
echo $this->Html->css('artigo');

$message= $data['message'];
$data = $data['data'];

$titulo = $data['menu'] ? $data['menu']['nome'] : '';
$titulo .= $data['region'] ? ' / '.$data['region']['nome'] : '';
$titulo .= $data['location'] ? ' / '.$data['location']['nome'] : '';


?>

<div id="fb-root"></div>


<img src="/img/posts/<?=$data['imagem']?>" style='width:100%' height="auto">
<section id='artigo' class="padrao">
    
    <p class='title'>
        <i class="fa fa-map-marker-alt"></i> <?= $titulo ?>
    </p>
    <?= $this->Flash->render() ?>
    <h1>
        <?= $data['titulo'] ?>
        <small><?= $data['subtitulo'] ?></small>
    </h1>

    <hr/>
    <div class='clearfix'>
        <span class='small'>Postado_em: <?= $data['publicado_em']->i18nformat('dd/MM/yyyy') ?></span> 
        <div class="sharethis-inline-share-buttons float-right"></div>
    </div>
    <div class='texto clearfix'>
        
        <?php if($data->has('discount')) echo "<a href='".$data['discount']['link']."' class='float-right' target='_blank'>".$this->Html->image('descontos/'.$data['discount']['imagem'],['width'=>'100%', 'height'=>'auto','style'=>'padding:0 0 20px 20px;']). "</a>" ?>
        
        <?=$data['texto']?>

       

    </div>

    <p class='category'>
            <?php if($data['category']){ ?>Categoria <a class="badge badge-success" href='/<?=$data['menu']['slug'].'?cagegory='.$data['category']['slug']?>'><?=$data['category']['nome']?></a>&nbsp;&nbsp;<?php } ?>
            <?php if($data['tags']){ ?>Tags <?php foreach ($data['tags'] as $tag ) {?><a href='/tags/<?=$tag['slug']?>' class="badge badge-success"><i class="fas fa-tag"></i> <?=$tag['nome']?></a> <?php } ?><?php } ?>
        </p>

    <hr/>

    <?php if($data['contato']){ ?>
        <br>
        <?= $this->Form->create($message) ?>
        <h4>Ficou interessado?</h4>
        <p class=''>Mande sua mensagem pelo formulario abaixo:</p>
        <div class='row'>
            
        
            
            <div class="form-group col-md-4">
                <label for="nome">Nome</label>
                <input type="text" class="form-control <?php if(@$error['nome']) echo 'is-invalid'; ?>" value='<?=$message['nome']?>' id="nome" name="nome">
            </div>
            <div class="form-group col-md-4">
                <label for="email">E-mail</label>
                <input type="email"  class="form-control <?=@$error['email'] ? 'is-invalid':'';?>" name='email' id="email" value='<?=$message['email']?>'>
            </div>
            <div class="form-group col-md-4">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control <?php if(@$error['telefone']) echo 'is-invalid'; ?>" value='<?=$message['telefone']?>' id="telefone" name="telefone" >
            </div>
            
            <input type="hidden"  class="hidden form-control <?=@$error['assunto'] ? 'is-invalid':'';?>" disabled name='assunto' id="assunto" value='<?=$titulo.' '.$data['titulo'];?>'>
            
            <div class="form-group col-md-12">
                <label for="message">Message:</label>
                <?= $this->Form->textarea('message',['class'=>'form-control'.(@$error['message'] ? ' is-invalid':''),'value'=>$message['message'] , 'label'=>['text'=>'Mensagem']]);?>
            </div>
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            
        </div>
        <?= $this->Form->end() ?><br><br>
        

    <?php } ?>
    <div class="fb-comments" data-href="http:///guiadetrips.com.br/<?=$this->Url->build(['controller'=>'Pages','action'=>'artigo', 'id'=> $data['id'], 'slug'=>$data['slug']]);?>" data-width='100' data-mobile="1" data-numposts="7"></div>
    
</section>