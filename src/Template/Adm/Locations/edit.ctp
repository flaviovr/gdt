<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
    </p>
    <?= $this->Flash->render() ;?>
    <?= $this->Form->create($data['data'],['enctype'=>'multipart/form-data']); ?>

    <div class='row'>
        
        <?php if($page['action']=='edit') {?>
        <div class="col-md-12">
            <div class="form-group">
                <?= $this->Html->image('headers/'.$data['data']->imagem,['width'=>'100%', 'height'=>'auto']) ?>
            </div>
        </div>
        <?php }?>

        <div class='col-md-6'>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control <?php if(@$error['nome']) echo 'is-invalid'; ?>" value='<?=$data['data']['nome']?>' id="nome" name="nome" placeholder="Nome descritivo...">
            </div>
        </div>

        <div class='col-md-3'>
            <div class="form-group">
                <label for="slug">Slug :</label>
                <input type="string"  class="form-control " name='slug' id="slug" value='<?=$data['data']['slug']?>'  placeholder="titulo-do-item...">
                <small>Texto Utilizado para criação da URL</small>
            </div>
        </div>

        <div class='col-md-3'>
            <div class="form-group">
                <?= $this->Form->control('region_id',['options' => $data['regions'], 'empty' => true, 'class'=>'form-control'.(@$error['region_ig'] ? 'in-invalid':'') , 'label'=>['text'=>'Região:']]);?>
            </div>
        </div>

        <div class='col-md-12'>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value='<?=$data['data']['descricao']?>'  placeholder="Descrição...">
            </div>
        </div>

        <div class='col-md-12'>            
            <div class="form-group">
                <label class="form-check-label" for="imagem">Escolha a Imagem:</label>
                <div class="custom-file ">
                    <input type="file" class="custom-file-input  <?php if(@$error['imagem']) echo 'is-invalid'; ?>" name='imagem' id="imagem">
                    <label class="custom-file-label" for="imagem">Escolha a Imagem</label>
                </div>
                <small>1230x410px | png-jpg-jpeg </small>
            </div>    
        </div>

        <div class='col-md-2'>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            
        </div>
             
        
    </div>
    
  
    <?= $this->Form->end() ?>


  

</section>
