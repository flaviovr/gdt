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
        <div class="col-md-8">
            <div class="form-group">
                <?php echo $this->Html->image('posts/'.$data['imagem'],['width'=>'100%', 'height'=>'auto']) ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo $this->Html->image('posts/thumb/'.$data['thumb'],['width'=>'100%', 'height'=>'auto']) ?>
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
        <div class='col-md-9'>
            <div class="form-group">
                <label for="subtitulo">Sub-Título:</label>
                <input type="text" class="form-control <?=@$error['subtitulo'] ? 'is-invalid':'';?>" id="subtitulo" name="subtitulo" value='<?=$data['subtitulo']?>' placeholder="Título do Post...">
            </div>
        </div>

        <div class='col-md-1 col-4'>
            <div class="form-group">
                <p>Ativo</p>
                <input type="checkbox" name="ativo" id="ativo" <?=$data['ativo'] ? 'checked="checked"' :'' ?> value='1' >
                <label for="ativo">Sim</label>
            </div>
        </div>

        <div class='col-md-1 col-4'>
            <div class="form-group">
                <p>Destaque</p>
                <input type="checkbox" name="destaque" id="destaque" <?=$data['destaque'] ? 'checked="checked"' :'' ?> value='1' >
                <label for="destaque">Sim</label>
            </div>
        </div>

        <div class='col-md-1 col-4'>
            <div class="form-group">
                <p>Contato?</p>
                <input type="checkbox" name="contato" id="contato" <?=$data['contato'] ? 'checked="checked"' :'' ?> value='1' >
                <label for="contato">Sim</label>
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

        <div class='col-md-3 col-sm-6'>
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
                        
      
        
        <div class="form-group col-md-6 col-sm-8">
            <?= $this->Form->control('discount_id',['options' => $discounts, 'empty' => true,'class'=>'form-control', 'label'=>['text'=>'Desconto:']]);?>
        </div>
    

        <div class="form-group col-md-3 col-sm-4">
            <label for="publicado_em">Publicar em:</label>
            <input type="date" class="form-control <?=@$error['publicado_em'] ? 'is-invalid':'';?>" id="publicado_em" name="publicado_em" value='<?php if($data->publicado_em!='') echo $data->publicado_em->i18nFormat('yyyy-MM-dd');?>'>
        </div>
        
        <div class='col-md-12'>
            <div class="form-group">
                <p>Destaque</p>
                <?php 
                $ids = [];
                foreach ($data['tags'] as $t) $ids[]=$t['id'];
                
                foreach ($tags as $id=>$tag) { 
                ?>
                <input type="checkbox" name="tags[_ids][]" <?= in_array($id,$ids) ? 'checked="checked"': ""; ?> value='<?=$id?>' >
                <label for="destaque"><?=$tag?>&nbsp;&nbsp;</label>
                <?php } ?>
                
            </div>
        </div>
        

        <div class='col-md-12'>
            <div class="form-group">
                <?= $this->Form->control('texto',['class'=>'form-control ', 'label'=>['text'=>'Texto do Post:']]);?>
            </div>
        </div>
       
        <div class='col-md-6'>            
            <div class="form-group">
                <label class="form-check-label " for="imagem">Escolha a Imagem:</label>
                <div class="custom-file ">
                    <input type="file" class="custom-file-input <?=@$error['imagem'] ? 'is-invalid':'';?>" name='imagem' id="imagem">
                    <label class="custom-file-label" for="imagem">Escolha a Imagem</label>
                </div>
                <small>1230x410px | png-jpg-jpeg </small>
            </div>    
        </div>
        
        <div class='col-md-6'>            
            <div class="form-group">
                <label class="form-check-label " for="thumb">Escolha a Thumb:</label>
                <div class="custom-file ">
                    <input type="file" class="custom-file-input <?=@$error['thumb'] ? 'is-invalid':'';?>" name='thumb' id="thumb">
                    <label class="custom-file-label" for="thumb">Escolha a Thumb</label>
                </div>
                <small>622x350px | png-jpg-jpeg </small>
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
