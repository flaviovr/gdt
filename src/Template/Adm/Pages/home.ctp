<script src="/js/ckeditor/ckeditor.js"></script>
<script src="/js/ckeditor/config.js"></script>
<section class='padrao'>
    <p class='title'><i class="fas fa-home"></i> Gerenciar Site</p>
    <?= $this->Flash->render();?>
    <?= $this->Form->create(null,['enctype'=>'multipart/form-data']) ?>
 
        <div class='row'>
            
            <div class='col-md-6 '>
                <div class="row">
                    <h6 class="col-md-12"><b>Configs do Site</b></h6>
                    <div class="form-group col-md-12">
                        <label for="titulo">Título do Site:</label>
                        <input type="text" class="form-control" value='<?=$config['site']['titulo']?>' name="site[titulo]">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="site.userInstagram">User Instagram :</label>
                        <input type="string"  class="form-control" name='site[userInstagram]' id="userInstagram" value='<?=$config['site']['userInstagram']?>' >
                    </div>
                    <h6 class="col-md-12"><b>Mídias Sociais</b></h6>
                    <div class="form-group  col-md-6">
                        <label for="facebook">Facebook:</label>
                        <input type="text" class="form-control" value='<?=$config['topbar']['socialMedia']['facebook']?>' id="facebook" name="socialMedia[facebook]">
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="twitter">Twitter:</label>
                        <input type="text" class="form-control" value='<?=$config['topbar']['socialMedia']['twitter']?>' id="twitter" name="socialMedia[twitter]">
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="instagram">Instagram:</label>
                        <input type="text" class="form-control" value='<?=$config['topbar']['socialMedia']['instagram']?>' id="instagram" name="socialMedia[instagram]">
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="youtube">Youtube:</label>
                        <input type="text" class="form-control" value='<?=$config['topbar']['socialMedia']['facebook']?>' id="youtube" name="socialMedia[youtube]">
                    </div>
                </div>
                
            </div>  

          
            <div class='col-md-6'>
               
                <div class="row">
                    <h6 class="col-md-12"><b>Destaques da Home</b></h6>
                    <div class="form-group col-md-12">
                        <label for="titulo">Primeiro Bloco:</label>
                        <input type="text" class="form-control" value='<?=$config['home']['destaques'][0]['item']['titulo']?>'  name="destaques[0][titulo]">
                    </div>
                    <div class="form-group col-md-3 ">
                        <label for="titulo">Região:</label>
                        <input type="text" class="form-control" value='<?=$config['home']['destaques'][0]['item']['region_id']?>' id="titulo" name="destaques[0][region_id]">
                    </div>
                    <div class="form-group col-md-3 ">
                        <label for="titulo">Local:</label>
                        <input type="text" class="form-control" value='<?=$config['home']['destaques'][0]['item']['location_id']?>' id="titulo" name="destaques[0][location_id]">
                    </div>
                    <div class="form-group col-md-3 ">
                        <label for="titulo">Categoria:</label>
                        <input type="text" class="form-control" value='<?=$config['home']['destaques'][0]['item']['category_id']?>' id="titulo" name="destaques[0][category_id]">
                    </div>
                    <div class="form-group col-md-3 ">      
                        <p>Destaques</p>
                        <input type="checkbox" name="destaques[0][destaques]"  <?=$config['home']['destaques'][0]['item']['destaques'] ? 'checked="checked"':''?> value='1' >
                        <label for="destaques">Sim</label>
                    </div>
                    <hr class='col-md-10'/>
                    
                    <div class="form-group col-md-12">
                        <label for="titulo">Primeiro Bloco:</label>
                        <input type="text" class="form-control" value='<?=$config['home']['destaques'][1]['item']['titulo']?>'  name="destaques[1][titulo]">
                    </div>
                    <div class="form-group col-md-3 ">
                        <label for="titulo">Região:</label>
                        <input type="text" class="form-control" value='<?=$config['home']['destaques'][1]['item']['region_id']?>' name="destaques[1][region_id]">
                    </div>
                    <div class="form-group col-md-3 ">
                        <label for="titulo">Local:</label>
                        <input type="text" class="form-control" value='<?=$config['home']['destaques'][1]['item']['location_id']?>'  name="destaques[1][location_id]">
                    </div>
                    <div class="form-group col-md-3 ">
                        <label for="titulo">Categoria:</label>
                        <input type="text" class="form-control" value='<?=$config['home']['destaques'][1]['item']['category_id']?>'  name="destaques[1][category_id]">
                    </div>
                    <div class="form-group col-md-3 ">      
                        <p>Destaques</p>
                        <input type="checkbox" name="destaques[1][destaques]"  <?=$config['home']['destaques'][1]['item']['destaques'] ? 'checked="checked"':''?> value='1' >
                        <label for="destaques">Sim</label>
                    </div>
                </div>
                 
               
                
               
            </div> 
         
            <div class='col-md-12'>
                <h6>Página SOBRE</h6>
                <div class="form-group ">
                    <textarea class="form-control" id="paginaSobre" name="site[paginaSobre]"><?=$config['site']['paginaSobre']?></textarea>
                </div>
            </div> 
         
        
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo $this->Html->image('site/'.$config['site']['siteBg'],['width'=>'100%', 'height'=>'auto']) ?>
                </div>
            </div>

            <div class='col-md-12'>
                <div class="form-group">
                    
                    <label for="imagem">Alterar a Imagem:</label>
                    <div class="custom-file ">
                        <input type="file" class="custom-file-input" name='imagem' id="imagem" >
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
	CKEDITOR.replace( 'site[paginaSobre]' ,{
	filebrowserBrowseUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
	filebrowserUploadUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
    filebrowserImageBrowseUrl : '/filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
    height: 200
} );
</script>
