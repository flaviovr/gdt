<?php
$menus=$data['menus'];
$regions=$data['regions'];
$locations=$data['locations'];
$categories=$data['categories'];
$discounts=$data['discounts'];
$tags=$data['tags'];
$data = $data['data'];
?>
<script src="/js/ckeditor/ckeditor.js"></script>
<script src="/js/ckeditor/config.js"></script>

<section class="padrao">
    <p class='title'>
        <i class="fas fa-home"></i> <?= $page['titulo'] ?>
    </p>
    <?= $this->Flash->render() ; ?>
    <?= $this->Form->create($data,['enctype'=>'multipart/form-data']) ?>
    
    <div class='row'>
    
        
        <?php if($page['action']=='edit') { ?>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo $this->Html->image('posts/'.$data['imagem'],['width'=>'100%', 'height'=>'auto']) ?>
            </div>
        </div>
        <?php } ?>

        <div class='col-md-8'>
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control <?=@$error['titulo'] ? 'is-invalid':'';?>" id="titulo" name="titulo" value='<?=$data['titulo']?>' placeholder="Título do Post...">
            </div>
        </div>

        <div class='col-md-4'>
            <div class="form-group">
                <label for="slug">Slug :</label>
                <input type="string"  class="form-control <?=@$error['slug'] ? 'is-invalid':'';?>" name='slug' id="slug" value='<?=$data['slug']?>' placeholder="titulo-do-item...">
                <small>Texto Utilizado para criação da URL</small>
            </div>
        </div>
        <div class='col-md-10'>
            <div class="form-group">
                <label for="subtitulo">Sub-Título:</label>
                <input type="text" class="form-control <?=@$error['subtitulo'] ? 'is-invalid':'';?>" id="subtitulo" name="subtitulo" value='<?=$data['titulo']?>' placeholder="Título do Post...">
            </div>
        </div>

        <div class='col-md-1 col-6'>
            <div class="form-group">
                <p>Ativo</p>
                <input type="checkbox" name="ativo" id="ativo" <?=$data['ativo'] ? 'checked="checked"' :'' ?> value='1' >
                <label for="ativo">Sim</label>
            </div>
        </div>

        <div class='col-md-1 col-6'>
            <div class="form-group">
                <p>Destaque</p>
                <input type="checkbox" name="destaque" id="destaque" <?=$data['destaque'] ? 'checked="checked"' :'' ?> value='1' >
                <label for="destaque">Sim</label>
            </div>
        </div>

        <div class='col-md-4 col-sm-6'>
            <div class="form-group">
                <label for="menu_id">Menu:</label>
                <select name="menu_id" class="form-control <?=@$error['menu_id'] ? 'is-invalid':'';?>" id="menu_id" >
                    <option value="">---</option>
                    <?php foreach($menus as $k=>$menu)  {?> 
                    <option value='<?=$k?>' <?=$k==$data['menu_id'] ? 'selected' : '' ?>><?=$menu?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
      
        <div class='col-md-4 col-sm-6'>
            <div class="form-group">
                <label for="region_id">Região</label>
                <select name="region_id" class="form-control <?=@$error['region_id'] ? 'is-invalid':'';?>" id="region_id" >
                    <option value="">---</option>
                    <?php foreach($regions as $region)  {?> 
                    <option value='<?=$region['id']?>' data-chained='<?=$region['menu_id']?>' <?=$region['id']==$data['region_id'] ? 'selected' : '' ?> ><?=$region['nome']?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class='col-md-4 col-sm-6'>
            <div class="form-group">
                <label for="location_id">Local:</label>
                <select name="location_id" class="form-control <?=@$error['location_id'] ? 'is-invalid':'';?>" id="location_id" >
                    <option value="">---</option>
                    <?php foreach($locations as $local)  {?> 
                    <option value='<?=$local['id']?>' data-chained='<?=$local['region_id']?>' <?=$local['id']==$data['location_id'] ? 'selected' : '' ?> ><?=$local['nome']?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class='col-md-4 col-sm-6'>
            <div class="form-group">
                <label for="category_id">Categoria:</label>
                <select name="category_id" class="form-control <?=@$error['category_id'] ? 'is-invalid':'';?>" id="category_id" >
                    <option value="">---</option>
                    <?php foreach($categories as $cat)  {?> 
                    <option value='<?=$cat['id']?>' data-chained='<?=$cat['menu_id']?>' <?=$cat['id']==$data['category_id'] ? 'selected' : '' ?> ><?=$cat['nome']?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class='col-md-8'>
            <div class="form-group">
                <?= $this->Form->control('discount_id',['options' => $discounts, 'empty' => true,'class'=>'form-control', 'label'=>['text'=>'Desconto:']]);?>
            </div>
        </div>
        <div class='col-md-12'>
            <div class="form-group">
                <?= $this->Form->control('tags._ids', ['options' => $tags,'class'=>'form-control'])?>
            </div>
        </div>
        

        <div class='col-md-12'>
            <div class="form-group">
                <?= $this->Form->control('texto',['class'=>'form-control ', 'label'=>['text'=>'Texto do Post:']]);?>
            </div>
        </div>
       
        <div class='col-md-12'>            
            <div class="form-group">
                <label class="form-check-label <?=@$error['imagem'] ? 'is-invalid':'';?>" for="imagem">Escolha a Imagem:</label>
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
    
    //$("#series").chained("#region_id");
	CKEDITOR.replace( 'texto' ,{
	filebrowserBrowseUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
	filebrowserUploadUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
    filebrowserImageBrowseUrl : '/filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
    height: 500
} );
</script>
