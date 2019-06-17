<?php
$menus=$data['menus'];
$regions=$data['regions'];
$locations=$data['locations'];
$categories=$data['categories'];
$discounts=$data['discounts'];
$data = $data['data'];
echo $this->Html->css('lity',['block' => true]);
?>

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
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo $this->Html->image('site/'.$config['site']['siteBg'],['width'=>'100%', 'height'=>'auto']) ?>
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class="form-group">
                            <label for="site[siteBg]">Selecionar Fundo do Site</label> 
                            <input type="text" class='form-control' name='site' value='<?=$config['site']['siteBg']?>' id='site' >  
                            <a class='btn btn-success' data-lity  href="//localhost/filemanager/dialog.php?type=1&field_id=site&editor=mce_0" >Selecionar</a>

                           
                       </div>
                        
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <a data-lity href='//localhost/filemanager/dialog.php?type=0' target='_blank' class="btn btn-success mr-auto" >Abrir Gerenciador de Arquivos</a>
                          
                        </div>
                   
                    </div>
                
                    
                </div>
                
            </div>  

          


            <div class='col-md-6'>
               
                <div class="row">
                    <h6 class="col-md-12"><b>Destaques da Home</b></h6>


                    <div class="form-group col-md-12">
                        <label for="titulo">Primeiro Bloco:</label>
                        <input type="text" class="form-control" value='<?=$config['home']['destaques'][0]['item']['titulo']?>' name="destaques[0][titulo]">
                    </div>
                
                    <div class="form-group col-md-6">
                        <label for="menu_id">Menu:</label>
                        <select name="destaques[0][menu_id]" class="form-control <?=@$error['menu_id'] ? 'in-invalid':'';?>" id="menu_id" >
                            <option value="">---</option>
                            <?php foreach($menus as $k=>$menu)  {?> 
                            <option value='<?=$k?>' <?=$k==$config['home']['destaques'][0]['item']['menu_id'] ? 'selected' : '' ?>><?=$menu?></option>
                            <?php } ?>
                        </select>
                    </div>
                
                    <div class="form-group col-md-6">
                        <label for="category_id">Categoria:</label>
                        <select name="destaques[0][category_id]" class="form-control <?=@$error['category_id'] ? 'in-invalid':'';?>" id="category_id" >
                            <option value="">---</option>
                            <?php foreach($categories as $cat)  {?> 
                            <option value='<?=$cat['id']?>' data-chained='<?=$cat['menu_id']?>' <?=$cat['id']==$config['home']['destaques'][0]['item']['category_id'] ? 'selected' : '' ?> ><?=$cat['nome']?></option>
                            <?php } ?>
                        </select>
                    </div>
            
                    <div class="form-group col-md-5 ">
                        <label for="region_id">Região</label>
                        <select name="destaques[0][region_id]" class="form-control <?=@$error['region_id'] ? 'in-invalid':'';?>" id="region_id" >
                            <option value="">---</option>
                            <?php foreach($regions as $region)  {?> 
                            <option value='<?=$region['id']?>' data-chained='<?=$region['menu_id']?>' <?=$region['id']==$config['home']['destaques'][0]['item']['region_id'] ? 'selected' : '' ?> ><?=$region['nome']?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-5 ">
                        <label for="location_id">Local:</label>
                        <select name="destaques[0][location_id]" class="form-control <?=@$error['location_id'] ? 'in-invalid':'';?>" id="location_id" >
                            <option value="">---</option>
                            <?php foreach($locations as $local)  {?> 
                            <option value='<?=$local['id']?>' data-chained='<?=$local['region_id']?>' <?=$local['id']==$config['home']['destaques'][0]['item']['location_id'] ? 'selected' : '' ?> ><?=$local['nome']?></option>
                            <?php } ?>
                        </select>
                    </div>
         
                    <div class="form-group col-md-2 ">      
                        <p>Destaques</p>
                        <input type="checkbox" name="destaques[0][destaques]"  <?=$config['home']['destaques'][0]['item']['destaques'] ? 'checked="checked"':''?> value='1' >
                        <label for="destaques">Sim</label>
                    </div>



                    <hr class='col-md-12'/>
                    
                    <div class="form-group col-md-12">
                        <label for="titulo">Segundo Bloco:</label>
                        <input type="text" class="form-control" value='<?=$config['home']['destaques'][1]['item']['titulo']?>'  name="destaques[1][titulo]">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="menu_id">Menu:</label>
                        <select name="destaques[1][menu_id]" class="form-control <?=@$error['menu_id'] ? 'in-invalid':'';?>" id="menu_id2" >
                            <option value="">---</option>
                            <?php foreach($menus as $k=>$menu)  {?> 
                            <option value='<?=$k?>' <?=$k==$config['home']['destaques'][1]['item']['menu_id'] ? 'selected' : '' ?>><?=$menu?></option>
                            <?php } ?>
                        </select>
                    </div>
                
                    <div class="form-group col-md-6">
                        <label for="category_id">Categoria:</label>
                        <select name="destaques[1][category_id]" class="form-control <?=@$error['category_id'] ? 'in-invalid':'';?>" id="category_id2" >
                            <option value="">---</option>
                            <?php foreach($categories as $cat)  {?> 
                            <option value='<?=$cat['id']?>' data-chained='<?=$cat['menu_id']?>' <?=$cat['id']==$config['home']['destaques'][1]['item']['category_id'] ? 'selected' : '' ?> ><?=$cat['nome']?></option>
                            <?php } ?>
                        </select>
                    </div>
            
                    <div class="form-group col-md-5 ">
                        <label for="region_id">Região</label>
                        <select name="destaques[1][region_id]" class="form-control <?=@$error['region_id'] ? 'in-invalid':'';?>" id="region_id2" >
                            <option value="">---</option>
                            <?php foreach($regions as $region)  {?> 
                            <option value='<?=$region['id']?>' data-chained='<?=$region['menu_id']?>' <?=$region['id']==$config['home']['destaques'][1]['item']['region_id'] ? 'selected' : '' ?> ><?=$region['nome']?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-5 ">
                        <label for="location_id">Local:</label>
                        <select name="destaques[1][location_id]" class="form-control <?=@$error['location_id'] ? 'in-invalid':'';?>" id="location_id2" >
                            <option value="">---</option>
                            <?php foreach($locations as $local)  {?> 
                            <option value='<?=$local['id']?>' data-chained='<?=$local['region_id']?>' <?=$local['id']==$config['home']['destaques'][1]['item']['location_id'] ? 'selected' : '' ?> ><?=$local['nome']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2 ">      
                        <p>Destaques</p>
                        <input type="checkbox" name="destaques[1][destaques]"  <?=$config['home']['destaques'][1]['item']['destaques'] ? 'checked="checked"':''?> value='1' >
                        <label for="destaques">Sim</label>
                    </div>
                </div>
                 
               
                
               
            </div> 

            <hr class='col-md-12'>
            <div class="col-md-12">
                
                <div class="row">
                    
                    <h6 class="col-md-12"><b>Mídias Sociais</b></h6>
                    <div class="form-group  col-md-3">
                        <label for="facebook">Facebook:</label>
                        <input type="text" class="form-control" value='<?=$config['topbar']['socialMedia']['facebook']?>' id="facebook" name="socialMedia[facebook]">
                    </div>
                    <div class="form-group  col-md-3">
                        <label for="twitter">Twitter:</label>
                        <input type="text" class="form-control" value='<?=$config['topbar']['socialMedia']['twitter']?>' id="twitter" name="socialMedia[twitter]">
                    </div>
                    <div class="form-group  col-md-3">
                        <label for="instagram">Instagram:</label>
                        <input type="text" class="form-control" value='<?=$config['topbar']['socialMedia']['instagram']?>' id="instagram" name="socialMedia[instagram]">
                    </div>
                    <div class="form-group  col-md-3">
                        <label for="youtube">Youtube:</label>
                        <input type="text" class="form-control" value='<?=$config['topbar']['socialMedia']['facebook']?>' id="youtube" name="socialMedia[youtube]">
                    </div>

                </div>
               
            </div>


            <div class='col-md-12'>
                <h6> <b>Página Sobre</b>     </h6>
                <div class="form-group ">
                    <textarea class="form-control" id="paginaSobre" name="site[paginaSobre]"><?=$config['site']['paginaSobre']?></textarea>
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
<?php 
    echo $this->Html->script('ckeditor/ckeditor',['block' => true]);
    echo $this->Html->script('ckeditor/config',['block' => true]);
    echo $this->Html->script('lity.min',['block' => true]);
    echo $this->Html->script('homeadm',['block' => true]);
?>

