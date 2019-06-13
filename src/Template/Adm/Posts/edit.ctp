<script src="/js/ckeditor/config.js"></script>
<script src="/js/ckeditor/ckeditor.js"></script>

<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
    </p>
    <?= $this->Flash->render() ; ?>
    <?= $this->Form->create($data['data'],['enctype'=>'multipart/form-data']) ?>
    
    <div class='row'>
    
        
        <?php if($page['action']=='edit') { ?>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo $this->Html->image('posts/'.$data['data']['imagem'],['width'=>'100%', 'height'=>'auto']) ?>
            </div>
        </div>
        <?php } ?>

        <div class='col-md-8'>
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value='<?=$data['data']['titulo']?>' placeholder="Título do Post...">
            </div>
        </div>

        <div class='col-md-4'>
            <div class="form-group">
                <label for="slug">Slug :</label>
                <input type="string"  class="form-control" name='slug' id="slug" value='<?=$data['data']['slug']?>' placeholder="titulo-do-item...">
                <small>Texto Utilizado para criação da URL</small>
            </div>
        </div>
        <div class='col-md-10'>
            <div class="form-group">
                <label for="subtitulo">Sub-Título:</label>
                <input type="text" class="form-control" id="subtitulo" name="subtitulo" value='<?=$data['data']['titulo']?>' placeholder="Título do Post...">
            </div>
        </div>

        <div class='col-md-1'>
            <div class="form-group">
                <p>Ativo</p>
                <input type="checkbox" name="ativo" id="ativo" <?=$data['data']['ativo'] ? 'checked="checked"' :'' ?> value='1' >
                <label for="ativo">Sim</label>
            </div>
        </div>

        <div class='col-md-1'>
            <div class="form-group">
                <p>Destaque</p>
                <input type="checkbox" name="destaque" id="destaque" <?=$data['data']['destaque'] ? 'checked="checked"' :'' ?> value='1' >
                <label for="destaque">Sim</label>
            </div>
        </div>

      
        <div class='col-md-3'>
            <div class="form-group">
                <?= $this->Form->control('region_id',['options' => $data['regions'], 'empty' => true, 'class'=>'form-control', 'label'=>['text'=>'Região:']]);?>
            </div>
        </div>

        <div class='col-md-3'>
            <div class="form-group">
                <?= $this->Form->control('location_id',['options' => $data['locations'], 'empty' => true, 'class'=>'form-control', 'label'=>['text'=>'Local:']]);?>
            </div>
        </div>

        <div class='col-md-3'>
            <div class="form-group">
                <?= $this->Form->control('category_id',['options' => $data['categories'], 'empty' => true, 'class'=>'form-control', 'label'=>['text'=>'Categoria:']]);?>
            </div>
        </div>

        <div class='col-md-3'>
            <div class="form-group">
                <?= $this->Form->control('discount_id',['options' => $data['discounts'], 'empty' => true,'class'=>'form-control', 'label'=>['text'=>'Desconto:']]);?>
            </div>
        </div>

        <div class='col-md-12'>
            <div class="form-group">
                <?= $this->Form->control('texto',['class'=>'form-control', 'label'=>['text'=>'Texto do Post:']]);?>
            </div>
        </div>
       
        <div class='col-md-12'>            
            <div class="form-group">
                <label class="form-check-label" for="imagem">Escolha a Imagem:</label>
                <div class="custom-file ">
                    <input type="file" class="custom-file-input" name='imagem' id="imagem">
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
<script>
	CKEDITOR.replace( 'texto' ,{
	filebrowserBrowseUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
	filebrowserUploadUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
    filebrowserImageBrowseUrl : '/filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
    height: 500
} );
</script>
